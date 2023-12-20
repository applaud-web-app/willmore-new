<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    protected $table = 'vehicles';
    protected $guarded = [];

    public function beneficiars(){
        return $this->hasMany('App\Models\UserAssetsBeneficiaries','asset_id','id')->where('type','V');
    }
}
