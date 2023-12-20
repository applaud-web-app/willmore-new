<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    protected $table = 'cash';
    protected $guarded = [];

    public function beneficiars(){
        return $this->hasMany('App\Models\CashBeneficiaries','asset_id','id')->where('type','C');
    }
}
