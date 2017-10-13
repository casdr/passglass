<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyContact extends Model
{
    use SoftDeletes;

    protected $fillable = ['company_id', 'name', 'email', 'phone'];
    protected $table = 'companies_contacts';

    public function company() {
        return $this->belongsTo('App\Models\Company');
    }
}
