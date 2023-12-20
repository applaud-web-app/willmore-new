<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiaries extends Model
{
    protected $table = 'beneficiaries';
    protected $guarded = [];

    public function getCountry(){
        return $this->hasOne('App\Models\Country','id','country');
    }

    public function getPhonecode(){
        return $this->hasOne('App\Models\Country','id','phonecode');
    }

    public function getNationality(){
        return $this->hasOne('App\Models\Nationality','id','nationality');
    }

    public function cashBene(){
        return $this->hasMany('App\Models\CashBeneficiaries','beneficiar_id','id')->where('type','C');
    }

    public function bankBene(){
        return $this->hasMany('App\Models\CashBeneficiaries','beneficiar_id','id')->where('type','B');
    }

    public function jewelryBene(){
        return $this->hasMany('App\Models\CashBeneficiaries','beneficiar_id','id')->where('type','J');
    }

    public function lockerBene(){
        return $this->hasMany('App\Models\CashBeneficiaries','beneficiar_id','id')->where('type','L');
    }

    public function commercialBene(){
        return $this->hasMany('App\Models\PropertyBeneficiaries','beneficiar_id','id')->where('type','C');
    }

    public function landBene(){
        return $this->hasMany('App\Models\PropertyBeneficiaries','beneficiar_id','id')->where('type','L');
    }

    public function residentialBene(){
        return $this->hasMany('App\Models\PropertyBeneficiaries','beneficiar_id','id')->where('type','R');
    }

    public function dematBene(){
        return $this->hasMany('App\Models\UserAssetsBeneficiaries','beneficiar_id','id')->where('type','D');
    }

    public function downAccessL(){
        return $this->hasOne('App\Models\WillDownloadAccess','ben_id','id')->where('access_type','L');
    }

    public function downAccessLI(){
        return $this->hasOne('App\Models\WillDownloadAccess','ben_id','id')->where('access_type','LI');
    }

    public function downAccessW(){
        return $this->hasOne('App\Models\WillDownloadAccess','ben_id','id')->where('access_type','W');
    }

}
