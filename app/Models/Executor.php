<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Executor extends Model
{
    protected $table = 'executors';
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

    public function downAccessL(){
        return $this->hasOne('App\Models\WillDownloadAccess','exe_id','id')->where('access_type','L');
    }

    public function downAccessLI(){
        return $this->hasOne('App\Models\WillDownloadAccess','exe_id','id')->where('access_type','LI');
    }

    public function downAccessW(){
        return $this->hasOne('App\Models\WillDownloadAccess','exe_id','id')->where('access_type','W');
    }

}
