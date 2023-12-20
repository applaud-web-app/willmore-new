<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherAssets extends Model
{
    protected $table = 'other_assets';
    protected $guarded = [];

    public function getBeneficiar(){
        return $this->hasOne('App\Models\Beneficiaries','id','beneficiar_id');
    }

}
