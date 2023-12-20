<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $guarded = [];

    /**
    *@ Method: getLanguage
    *@ Description: getLanguage
    *@ Author: Partha
    *@ Date: 2020-SEP-2
    */
    public function getLanguage(){
        return $this->hasMany('App\Models\UserToLanguages','user_id','id')->with('getLanguageName');
    }

    public function getTimeZone(){
        return $this->hasOne('App\Models\TimeZone','id','time_zone');
    }

    /**
    *@ Method: getCountry
    *@ Description: getCountry
    *@ Author: Pankaj
    *@ Date: 2020-SEP-10
    */
    public function getCountry(){
        return $this->hasOne('App\Models\Country','id','country');
    }

    public function getPhonecode(){
        return $this->hasOne('App\Models\Country','id','phonecode');
    }
    public function getNationality(){
        return $this->hasOne('App\Models\Nationality','id','nationality');
    }

    public function getState(){
        return $this->hasOne('App\Models\State','id','state');
    }

    public function getBasicInfo(){
        return $this->hasOne('App\Models\UserBasicInfo','user_id','id');
    }
    public function getUserSkill(){
        return $this->hasMany('App\Models\UserSkill','user_id','id');
    }

    public function getUserDignitySkill(){
        return $this->hasMany('App\Models\UserDignitySkill','user_id','id');
    }

    public function getUserExam(){
        return $this->hasMany('App\Models\UserExam','user_id','id');
    }

    public function getUserEducation(){
        return $this->hasMany('App\Models\UserEducation','user_id','id');
    }
    public function getUserEmploymentHistory(){
        return $this->hasMany('App\Models\UserEmploymentHistory','user_id','id');
    }
    public function getUserPortfolio(){
        return $this->hasMany('App\Models\UserPortfolio','user_id','id');
    }
    public function getUserReward(){
        return $this->hasMany('App\Models\UserReward','user_id','id');
    }

    public function getUserLastExam(){
        return $this->hasOne('App\Models\UserExam','user_id','id')->orderBy('created_at','desc');
    }

    public function getBillingCountry(){
        return $this->hasOne('App\Models\Country','id','billing_country_id');
    }

    public function getBillingState(){
        return $this->hasOne('App\Models\State','id','billing_state_id');
    }

    public function getBillingData(){
        return $this->hasOne('App\Models\UserFinanceSetting','user_id','id');
    }

    public function getProject(){
        return $this->hasMany('App\Models\Project','user_id','id')->whereIn('status',[5,7]);
    }
}
