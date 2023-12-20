<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jewelry extends Model
{
    protected $table = 'jewelry';
    protected $guarded = [];

    public function beneficiars(){
        return $this->hasMany('App\Models\CashBeneficiaries','asset_id','id')->where('type','J');
    }
}
