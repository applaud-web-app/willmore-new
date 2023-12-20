<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $guarded = [];

    public function getPackage(){
        return $this->hasOne('App\Models\Packages','id','package_id');
    }

    public function getUser(){
        return $this->hasOne('App\User','id','user_id');
    }
}
