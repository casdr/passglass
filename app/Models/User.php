<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'yubikey_identity', 'gpg_key',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'yubikey_identity',
    ];

    /**
     * Overrides the method to ignore the remember token.
     */
    public function getRememberToken()
    {
    }

    /**
     * Overrides the method to ignore the remember token.
     */
    public function setRememberToken($value)
    {
    }

    /**
     * Overrides the method to ignore the remember token.
     */
    public function getRememberTokenName()
    {
    }

    /**
     * Overrides the method to ignore the remember token.
     */
    public function setAttribute($key, $value)
    {
        if ($key != $this->getRememberTokenName()) {
            parent::setAttribute($key, $value);
        }
    }
}
