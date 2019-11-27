<?php


namespace App\Services;


use App\Models\Patient;
use App\Models\SensorInUse;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

class MapService
{

    static function all_patients()
    {
        $patients = Patient::join('visits', 'visits.patient_id', '=', 'patients.id')
            ->join('doctors', 'doctors.id', '=', 'visits.doctor_id')
            ->join('cities', 'cities.id', '=', 'patients.city_id')
            ->leftJoin('remote_control', 'remote_control.visit_id', '=', 'visits.id')
            ->leftJoin('hospitalizations', 'hospitalizations.visit_id', '=', 'visits.id')
            ->select(
                'patients.id',
                'patients.name',
                'patients.surname',
                'patients.address',
                'patients.latitude',
                'patients.longitude',
                'cities.name as city',
                'remote_control.id as remoteId',
                'hospitalizations.id as hospitalId'
            //            'sensors_in_use.sensor_id as sensorId'
            )
            ->where('doctors.id', \auth()->guard('web')->user()->id)
            ->get();
        foreach ($patients as $patient) {
            $sensor = SensorInUse::when($patient->remoteId, function ($query) use ($patient) {
                $query->where('remote_control_id', $patient->remoteId);
            })->when($patient->hospitalId, function ($query) use ($patient) {
                $query->where('hospitalization_id', $patient->hospitalId);
            })->pluck('sensor_id')->first();
            $patient->sensorId = $sensor;
            unset($patient->remoteId);
            unset($patient->hospitalId);
        }
        addDataFromCassandra($patients);
        return $patients;
    }


    public static function remote_patients()
    {
        $patients = Patient::join('visits', 'visits.patient_id', '=', 'patients.id')
            ->join('doctors', 'doctors.id', '=', 'visits.doctor_id')
            ->join('remote_control', 'remote_control.visit_id', '=', 'visits.id')
            ->join('sensors_in_use', 'sensors_in_use.remote_control_id', '=', 'remote_control.id')
            ->join('cities', 'cities.id', '=', 'patients.city_id')
            ->select(
                'patients.id',
                'patients.name',
                'patients.surname',
                'patients.address',
                'patients.latitude',
                'patients.longitude',
                'cities.name as city',
                'sensors_in_use.sensor_id as sensorId'
            )
            ->where('doctors.id', \auth()->guard('web')->user()->id)
            ->get();
        addDataFromCassandra($patients);
        return $patients;
    }


    static function hospital_patients()
    {
        $patients = Patient::join('visits', 'visits.patient_id', '=', 'patients.id')
            ->join('doctors', 'doctors.id', '=', 'visits.doctor_id')
            ->join('hospitalizations', 'hospitalizations.visit_id', '=', 'visits.id')
            ->join('sensors_in_use', 'sensors_in_use.hospitalization_id', '=', 'hospitalizations.id')
            ->join('cities', 'cities.id', '=', 'patients.city_id')
            ->select(
                'patients.id',
                'patients.name',
                'patients.surname',
                'patients.address',
                'patients.latitude',
                'patients.longitude',
                'cities.name as city',
                'sensors_in_use.sensor_id as sensorId'
            )
            ->where('doctors.id', \auth()->guard('web')->user()->id)
            ->get();
        addDataFromCassandra($patients);
        return $patients;
    }
}
function addDataFromCassandra($patients)
{
    foreach ($patients as $patient) {
        if ($patient->sensorId) {
            $row = DB::connection('cassandra')
                ->table('processed_data')
                ->where('sensor_id', $patient->sensorId)
                ->orderBy('created_at', 'desc')
                ->first([
                    'sensor_id',
                    'max_value_measured',
                    'min_value_measured',
                    'status',
                    'created_at',
                    'parameter_unit'
                ]);
            if ($row['sensor_id'] === $patient->sensorId) {
                $patient->status = $row['status'];
                $date = new Date($row['created_at']->time());
                if ($date->diffInMinutes(\Carbon\Carbon::now()->subHour()) < 60) {
                    $patient->measuredTime = $date->addHour()->diffForHumans();
                } else {
                    $patient->measuredTime = $date->addHour()->format('d F Y H:i:s');
                }

                if ($row['parameter_unit'] == 'celsius' || $row['parameter_unit'] == 'minute') {
                    $patient->valuesMeasured = $row['min_value_measured'];
                    $patient->unit = $row['parameter_unit'];
                } else {
                    $patient->valuesMeasured = '(' . $row['min_value_measured'] . ', ' . $row['max_value_measured'] . ')';
                    $patient->unit = $row['parameter_unit'];
                }

            } else {
                $patient->status = false;
                $patient->measuredTime = null;

            }
        }
        $patient->icon = null;
        $patient->initials = substr($patient->name, 0, 1) . '' . substr($patient->surname, 0, 1);
    }
}
