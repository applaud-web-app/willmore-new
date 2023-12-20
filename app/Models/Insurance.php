<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $table = 'insurance';
    protected $guarded = [];

    public function beneficiars(){
        return $this->hasMany('App\Models\UserAssetsBeneficiaries','asset_id','id')->where('type','I');
    }

    public function getBeneficiar(){
        return $this->hasOne('App\Models\UserAssetsBeneficiaries','asset_id','id')->where('type','I');
    }

}
