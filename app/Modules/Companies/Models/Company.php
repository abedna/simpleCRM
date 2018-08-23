<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function usesTimestamps(){
        return false;
    }

    public function employees(){
        return $this->hasMany('App\Employee' ,'company', 'id');
    }
}
