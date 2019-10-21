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
        'keys' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function logEntries()
    {
        return $this->hasMany('App\Models\LogEntry');
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
}
