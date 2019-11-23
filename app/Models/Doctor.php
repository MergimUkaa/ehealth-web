<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table='doctors';


    public function city() {
        return $this->belongsTo('App\Models\City');
    }
}
