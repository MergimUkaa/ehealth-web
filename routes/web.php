<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Doctor as DoctorAlias;
use App\User;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});
Route::get('pw', function() {
return response()->json(DB::connection('cassandra')->table('processed_data')->where('patient_id', '<', 10)->first());
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/patient', function () {
    return view('pages.patient-dashboard');
});
