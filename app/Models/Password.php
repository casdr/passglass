<?php

namespace App\Models;

use App\Mail\PasswordUpdatedMail;
use App\Mail\PasswordViewedMail;
use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    protected $table = 'passwords';

    protected $hidden = ['password'];

    protected $fillable = ['company_id', 'name', 'username', 'password'];

    protected $casts = [
        'keys' => 'array'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function logEntries()
    {
        return $this->hasMany('App\Models\LogEntry');
    }

    public function keyList() {
        $keys = [];
        foreach($this->keys as $key) {
            $user = User::where('gpg_key', $key)->first();
            if($user) {
                $keys[$key] = $user;
            } else {
                $keys[$key] = null;
            }
        }
        return $keys;
    }

    public function getPasswordAttribute($value)
    {
        $this->sealed = 0;
        $this->save();
        $this->logEntries()->create([
            'description' => 'decrypted the password',
        ]);
        $ip = \Request::ip();
        foreach (User::all() as $user) {
            \Mail::to($user)
                ->queue(new PasswordViewedMail($this, \Auth::user(), $user, $ip));
        }

        return decrypt($value);
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($this->id)) {
            $this->logEntries()->create([
                'description' => 'updated the password',
            ]);
            $ip = \Request::ip();
            foreach (User::all() as $user) {
                \Mail::to($user)
                    ->queue(new PasswordUpdatedMail($this, \Auth::user(), $user, $ip));
            }
        }
        $this->attributes['password'] = encrypt($value);
        $this->attributes['sealed'] = 1;
    }

    public static function store($password)
    {
        $tmpfile = tmpfile();
        $tmp = stream_get_meta_data($tmpfile)['uri'];
        file_put_contents($tmp, decrypt($password->attributes['password']));
        $result = shell_exec("gpg --list-only -v -d $tmp 2>&1 1> /dev/null");
        preg_match_all("/.*public key is ([A-Z0-9]+).*/", $result, $out, PREG_PATTERN_ORDER);
        $password->keys = $out[1];
    }

    public static function boot() {
        parent::boot();

        self::updating(function ($password) { self::store($password); });
        self::saving(function ($password) { self::store($password); });
    }
}
