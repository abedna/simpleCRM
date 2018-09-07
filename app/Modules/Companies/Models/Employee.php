<?php

namespace App\Modules\Companies\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function usesTimestamps(){
        return false;
    }

  public function companies(){
        return $this->belongsTo('App\Modules\Companies\Models\Company','company','id');
  }

}
