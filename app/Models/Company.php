<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $table = 'companies';

    public function contacts()
    {
        return $this->hasMany('App\Models\CompanyContact');
    }

    public function passwords()
    {
        return $this->hasMany('App\Models\Password');
    }
}
