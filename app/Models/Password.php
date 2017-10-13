<?php

namespace App\Models;

use App\Mail\PasswordViewedMail;
use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
    protected $table = 'passwords';

    protected $hidden = ['password'];

    public function company() {
        return $this->belongsTo('App\Models\Company');
    }

    public function getPasswordAttribute($value) {
        foreach(User::all() as $user) {
            \Mail::to($user)
                ->queue(new PasswordViewedMail($this, \Auth::user(), $user));
        }
        return decrypt($value);
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = encrypt($value);
    }
}
