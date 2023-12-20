<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contingency extends Model
{
    protected $table = 'contingency';
    protected $guarded = [];

    public function getBeneficiar(){
        return $this->hasOne('App\Models\Beneficiaries','id','beneficiar_id');
    }

}
