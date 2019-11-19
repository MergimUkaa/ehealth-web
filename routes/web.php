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
    return response()->json(\auth()->guard('web')->user());
 $users = DB::connection('cassandra')->table('processed_data')->get();
 $usersArray = array();
 foreach ($users as $user){
     array_push($usersArray, $user);
 }
 return $usersArray;
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/patient', function () {
    return view('pages.patient-dashboard');
});
