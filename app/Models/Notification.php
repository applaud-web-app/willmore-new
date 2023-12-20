<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $guarded = [];

    public function getSender(){
        return $this->hasOne('App\User', 'id', 'sender_id');
    }
}