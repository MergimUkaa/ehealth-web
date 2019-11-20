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

Route::get('all-patients', function () {
    $patients = Patient::join('visits','visits.patient_id','=','patients.id')
        ->join('doctors', 'doctors.id', '=', 'visits.doctor_id')
        ->join('cities','cities.id','=','patients.city_id')
        ->select(
            'patients.name',
            'patients.surname',
            'patients.address',
            'patients.latitude',
            'patients.longitude',
            'cities.name as city'
            )
        ->where('doctors.id', \auth()->guard('web')->user()->id)
        ->get();
    status($patients);
   return response($patients);
});
Route::get('remote-patients', function () {
    $patients = Patient::join('visits','visits.patient_id','=','patients.id')
        ->join('doctors', 'doctors.id', '=', 'visits.doctor_id')
        ->join('remote_control', 'remote_control.visit_id','=','visits.id')
        ->join('cities','cities.id','=','patients.city_id')
        ->select(
            'patients.name',
            'patients.surname',
            'patients.address',
            'patients.latitude',
            'patients.longitude',
            'cities.name as city'
        )
        ->where('doctors.id', \auth()->guard('web')->user()->id)
        ->get();

        status($patients);

    return response()->json($patients);
});
Route::get('hospital-patients', function () {
    $patients = Patient::join('visits','visits.patient_id','=','patients.id')
        ->join('doctors', 'doctors.id', '=', 'visits.doctor_id')
        ->join('hospitalizations', 'hospitalizations.visit_id','=','visits.id')
        ->join('cities','cities.id','=','patients.city_id')
        ->select(
            'patients.name',
            'patients.surname',
            'patients.address',
            'patients.latitude',
            'patients.longitude',
            'cities.name as city'
        )
        ->where('doctors.id', \auth()->guard('web')->user()->id)
        ->get();
    status($patients);
    return response()->json($patients);
});

Route::get('test', function () {
    return response()->json(\App\Models\Doctor::with('city')->first());
});


function status($patients){
    foreach ($patients as $patient) {
        $number = rand(0,4);
        switch ($number){
            case 0: $patient->status = 'critical high'; break;
            case 1: $patient->status = 'critical low'; break;
            case 2: $patient->status = 'high'; break;
            case 3: $patient->status = 'low'; break;
            case 4: $patient->status = 'normal'; break;
        }
        $patient->initials = substr($patient->name, 0, 1). '' . substr($patient->surname, 0,1);
    }
}
