<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    protected $table = 'art';
    protected $guarded = [];

    public function beneficiars(){
        return $this->hasMany('App\Models\UserAssetsBeneficiaries','asset_id','id')->where('type','A');
    }
}
