<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutualFunds extends Model
{
    protected $table = 'mutual_funds';
    protected $guarded = [];

    public function beneficiars(){
        return $this->hasMany('App\Models\UserAssetsBeneficiaries','asset_id','id')->where('type','M');
    }
}
