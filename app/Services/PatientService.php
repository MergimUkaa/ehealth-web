<?php


namespace App\Services;


use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class PatientService
{
    static function getPatientHospital($id) {
        $patient = Patient::with('city')
            ->join('visits', 'visits.patient_id', '=', 'patients.id')
            ->join('hospitalizations', 'hospitalizations.visit_id', '=', 'visits.id')
            ->join('beds', 'beds.id','=','hospitalizations.bed_id')
            ->join('rooms', 'rooms.id', '=', 'beds.room_id')
            ->join('reparts', 'reparts.id', '=', 'rooms.repart_id')
            ->join('hospitals', 'hospitals.id','=','reparts.hospital_id')
            ->join('cities', 'hospitals.city_id','=','cities.id')
                ->select(
                    'patients.*',
                    'visits.diagnosis', 'visits.date as visitDate',
                    'beds.number as bedNumber',
                    'rooms.number as roomNumber',
                    'reparts.name as repartName',
                    'hospitals.name as hospitalName',
                    'cities.name as hospitalCityName')
             ->find($id);
        return $patient;
    }
    static function getPatientRemote($id) {
        $patientRemote = Patient::with('city')
            ->join('visits', 'visits.patient_id', '=', 'patients.id')
                ->select(
                    'patients.*',
                    'visits.diagnosis', 'visits.date as visitDate')
             ->find($id);
        return $patientRemote;
    }

    static function getSensorValues($patientId) {
        return DB::connection('cassandra')
            ->table('processed_data')
            ->where('patient_id', $patientId)
//            ->orderBy('created_at','asc')
            ->ALLOWFILTERING()
            ->take(10)
            ->get();
    }
}
