<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WillMessages extends Model
{
    protected $table = 'will_messages';
    protected $guarded = [];

    public function getPackage(){
        return $this->hasOne('App\Models\WillMasterPackage','will_master_id','will_id');
    }

    public function userDetails(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function adminDetails(){
        return $this->hasOne('App\Admin','id','admin_id');
    }

}
