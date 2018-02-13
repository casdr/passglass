<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogEntry extends Model
{
    protected $table = 'log_entries';
    protected $fillable = ['password_id', 'user_id', 'ip_address', 'description'];

    public function save(array $options = [])
    {
        if (empty($this->user_id)) {
            $this->user_id = \Auth::user()->id;
        }
        if (empty($this->ip_address)) {
            $this->ip_address = \Request::ip();
        }

        return parent::save($options);
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
