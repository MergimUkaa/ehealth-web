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
use Jenssegers\Date\Date;
Route::get('/', function () {
    return view('welcome');
});
Route::get('pw', function() {
    Date::setLocale('sq-al');

    $users = DB::connection('cassandra')->table('processed_data')->orderBy('created_at', 'desc')->first(['sensor_id',
        'max_value_measured',
        'min_value_measured',
        'status',
        'created_at',
        'parameter_unit']);
 $usersArray = array();
 foreach ($users as $user){
//     $date = new Jenssegers\Date\Date($user['created_at']->time());
//     return $date->addHours(11)->format('d F Y H:i:s');
//     format('d F Y H:i:s');
     array_push($usersArray, $user);
 }
 return $usersArray;
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/patient', function () {
    return view('pages.patient-dashboard');
});
function timestamp($data) {
    return $data;
}
