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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;
Route::get('/', function () {
    return redirect('login');
});
Route::get('pw', function() {
    DB::connection('cassandra')->table('processed_data')->index(['created_at']);
    return new \Cassandra\Timestamp(Carbon::now()->timestamp);
    return DB::connection('cassandra')->table('processed_data')->insert([
        'id' => 'e4eaaaf2-d142-11e1-b3e4-080027620cdd',
        'patient_id' => 4,
        'visit_id' => 5,
        'sensor_id'=> 7,
        'doctor_id'=>2,
        'min_value' => 45.55,
//        'max_value' => 76.6,
//        'normal_min_value' => 48.0,
//        'normal_max_value' => 80.5,
//        'latitude' => 42.890836,
//        'longitude' => 20.858424,
//        'status' => 'normal',
//        'parameter' => 'mmHg',
//        'min_value_measured' => 45.5,
//        'max_value_measured' => 80.6,
        'created_at' => new \Cassandra\Timestamp(Carbon::now()->timestamp),
        'updated_at' => new \Cassandra\Timestamp(Carbon::now()->timestamp)
    ])->toSql();
    return DB::connection('cassandra')
        ->table('processed_data')
        ->where('created_at','>=', new \Cassandra\Timestamp(Carbon::now()->subHours(11)->timestamp))
        ->allowFiltering()
        ->count();
    Date::setLocale('sq-al');

    $date = new \Cassandra\Timestamp(Carbon::now()->subMinute()->timestamp);
//    DB::connection('cassandra')->table('processed_data')->insert([
//        'id' => 'e4eaaaf2-d142-11e1-b3e4-080027620cdd',
//        'patient_id' => 4,
//        'visit_id' => 5,
//        'sensor_id'=> 7,
//        'doctor_id'=>2,
//        'min_value' => 45.55,
////        'max_value' => 76.6,
////        'normal_min_value' => 48.0,
////        'normal_max_value' => 80.5,
////        'latitude' => 42.890836,
////        'longitude' => 20.858424,
////        'status' => 'normal',
////        'parameter' => 'mmHg',
////        'min_value_measured' => 45.5,
////        'max_value_measured' => 80.6,
//        'created_at' => new \Cassandra\Timestamp(Carbon::now()->timestamp),
//        'updated_at' => new \Cassandra\Timestamp(Carbon::now()->timestamp)
//    ]);
//   return DB::connection('cassandra')->table('processed_data')->where('sensor_id',14)->first();
    return DB::connection('cassandra')
        ->table('processed_data')
        ->where('created_at','>=', new \Cassandra\Timestamp(Carbon::now()->subMinutes(10)->timestamp))->ALLOWFILTERING()->first();
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

Route::get('patient/{id}', 'PatientController@index')->name('index');
function timestamp($data) {
    return $data;
}
