<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';
    protected $guarded = [];

    public function getBlogCata(){
        return $this->hasOne('App\Models\BlogCategory','id','category_id');
    }

}
