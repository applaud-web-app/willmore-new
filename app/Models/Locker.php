<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    protected $table = 'locker';
    protected $guarded = [];

    public function beneficiars(){
        return $this->hasMany('App\Models\CashBeneficiaries','asset_id','id')->where('type','L');
    }
}
