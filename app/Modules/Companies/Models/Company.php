<?php

namespace App\Modules\Companies\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function usesTimestamps(){
        return false;
    }

    public function employees(){
       return $this->hasMany('App\Modules\Companies\Models\Employee' ,'company', 'id');
    }
}
