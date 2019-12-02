<?php

use App\Models\Patient;
use App\Models\SensorInUse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:web')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('all-patients','MapController@all');
Route::get('remote-patients', 'MapController@remote');
Route::get('hospital-patients', 'MapController@hospitalization');
Route::get('patient/{patientId}/data', 'PatientController@getSensorValues');
Route::get('test', function () {
    return response()->json(\App\Models\Doctor::with('city')->first());
});



