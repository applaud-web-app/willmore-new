<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WillMasterPackage extends Model
{
    protected $table = 'will_master_package';
    protected $guarded = [];

    public function packageDetail(){
        return $this->hasOne('App\Models\Packages','id','package_id');
    }

}
