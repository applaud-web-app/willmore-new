<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';
    protected $guarded = [];

    public function beneficiars(){
        return $this->hasMany('App\Models\PropertyBeneficiaries','asset_id','id');
    }

}
