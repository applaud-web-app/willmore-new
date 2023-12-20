<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashBeneficiaries extends Model
{
    protected $table = 'cash_beneficiaries';
    protected $guarded = [];

    public function getBeneficiar(){
        return $this->hasOne('App\Models\Beneficiaries','id','beneficiar_id');
    }
    public function getCash(){
        return $this->hasOne('App\Models\Cash','id','asset_id');
    }
    
    public function getBank(){
        return $this->hasOne('App\Models\Bank','id','asset_id');
    }
    
    public function getJewelry(){
        return $this->hasOne('App\Models\Jewelry','id','asset_id');
    }
    
    public function getLocker(){
        return $this->hasOne('App\Models\Locker','id','asset_id');
    }
}
