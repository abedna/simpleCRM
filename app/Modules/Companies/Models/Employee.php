<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function usesTimestamps(){
        return false;
    }

    public function companies(){
        return $this->belongsTo('App\Company','company','id');
    }

}
