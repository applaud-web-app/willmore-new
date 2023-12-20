<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Witness extends Model
{
    protected $table = 'witness';
    protected $guarded = [];

    public function getBeneficiar(){
        return $this->hasOne('App\Models\Beneficiaries','id','beneficiar_id');
    }

    public function getCountry(){
        return $this->hasOne('App\Models\Country','id','country');
    }

}
