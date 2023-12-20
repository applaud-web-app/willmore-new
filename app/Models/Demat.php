<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demat extends Model
{
    protected $table = 'demat';
    protected $guarded = [];

    public function beneficiars(){
        return $this->hasMany('App\Models\UserAssetsBeneficiaries','asset_id','id')->where('type','D');
    }
}
