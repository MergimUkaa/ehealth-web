<?php

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Route::get('patients', function () {
    $patients = Patient::join('visits','visits.patient_id','=','patients.id')
        ->join('doctors', 'doctors.id', '=', 'visits.doctor_id')
        ->select('patients.*')
        ->where('doctors.id', \auth()->guard('web')->user()->id)
        ->get();
    return response()->json($patients);
});

Route::get('test', function () {
    return response()->json(\App\Models\Doctor::with('city')->first());
});
