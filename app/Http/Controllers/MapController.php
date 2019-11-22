<?php

namespace App\Http\Controllers;

use App\MapServices\MapService;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;

class MapController extends Controller
{
    public function __construct()
    {
        Date::setLocale('sq-al');
    }

    public function all() {
      return  response()->json(MapService::all_patients());
    }

    public function remote() {
      return  response()->json(MapService::remote_patients());
    }

    public function hospitalization() {
      return  response()->json(MapService::hospital_patients());
    }
}
