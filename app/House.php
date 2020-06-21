<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    public $table="house";
    public function Location(){
        return $this->belongsTo('App\Location','id_Location','id');
    }
}
