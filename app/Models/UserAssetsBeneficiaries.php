<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAssetsBeneficiaries extends Model
{
    protected $table = 'user_assets_beneficiaries';
    protected $guarded = [];

    public function getBeneficiar(){
        return $this->hasOne('App\Models\Beneficiaries','id','beneficiar_id');
    }
    
    public function getDemat(){
        return $this->hasOne('App\Models\Demat','id','asset_id');
    }
}
