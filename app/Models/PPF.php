<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPF extends Model
{
    protected $table = 'ppf';
    protected $guarded = [];

    public function beneficiars(){
        return $this->hasMany('App\Models\UserAssetsBeneficiaries','asset_id','id')->where('type','P');
    }
}
