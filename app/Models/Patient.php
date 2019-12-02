<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function city() {
        return $this->belongsTo('App\Models\City');
    }
}
