<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WillDownloadAccess extends Model
{
    protected $table = 'will_download_access';
    protected $guarded = [];

    public function getBen(){
        return $this->hasOne('App\Models\Beneficiaries','id','ben_id');
    }

    public function getExe(){
        return $this->hasOne('App\Models\Executor','id','exe_id');
    }

    public function getWill(){
        return $this->hasOne('App\Models\WillMaster','id','will_id');
    }

}
