<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResidualAssets extends Model
{
    protected $table = 'residual_assets';
    protected $guarded = [];

    public function getBeneficiar(){
        return $this->hasOne('App\Models\Beneficiaries','id','beneficiar_id');
    }

}
