<?php

namespace App\Http\Controllers;

use App\Services\PatientService;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id) {
        $patient = PatientService::getPatientHospital($id);
        if (!$patient){
            $patient = PatientService::getPatientRemote($id);
        }
        return view('pages.patient-dashboard')->with('patient', $patient);
    }

    public function getSensorValues($patientId) {
        $sensorDataArr = array();
        $sensorData = PatientService::getSensorValues((int) $patientId);
        foreach ($sensorData as $data) {
            $date = new Date($data['created_at']->time());
            $data['created_at'] = $date->addHour()->format('H:i');
            array_push($sensorDataArr, $data);
        }
        return response()->json($sensorDataArr);
    }
}
