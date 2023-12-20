<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank';
    protected $guarded = [];

    public function beneficiars(){
        return $this->hasMany('App\Models\CashBeneficiaries','asset_id','id')->where('type','B');
    }
}
