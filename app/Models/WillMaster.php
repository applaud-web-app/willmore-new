<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WillMaster extends Model
{
    protected $table = 'will_master';
    protected $guarded = [];

    public function getPackage(){
        return $this->hasOne('App\Models\WillMasterPackage','will_master_id','id');
    }

    public function userDetails(){
        return $this->hasOne('App\User','id','user_id');
    }

}
