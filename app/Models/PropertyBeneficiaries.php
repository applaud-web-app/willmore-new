<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyBeneficiaries extends Model
{
    protected $table = 'property_beneficiaries';
    protected $guarded = [];

    public function getBeneficiar(){
        return $this->hasOne('App\Models\Beneficiaries','id','beneficiar_id');
    }

    public function getCommercial(){
        return $this->hasOne('App\Models\Property','id','asset_id')->where('type','C');
    }
    
    public function getLand(){
        return $this->hasOne('App\Models\Property','id','asset_id')->where('type','L');
    }
    
    public function getResidential(){
        return $this->hasOne('App\Models\Property','id','asset_id')->where('type','R');
    }
}
