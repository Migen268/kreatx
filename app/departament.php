<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class departament extends Model

{
    protected $table = 'departaments';

    public function users(){
           
    return $this->hasMany('App\User','departID','id');
} 
}
  