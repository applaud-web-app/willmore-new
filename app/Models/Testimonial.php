<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'success_stories';
    protected $guarded = [];

    public function getCategory(){
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    public function getSubategory(){
        return $this->hasOne('App\Models\Category', 'id', 'subcategory_id');
    }
}
