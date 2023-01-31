<?php

namespace App\Http\Controllers;

use User;
use Doctor;
use Illuminate\Http\Request;
use App\Helpers\FormatUtility;

class PatientsController extends Controller
{   
    public function __construct()
    {
        $this->format = new FormatUtility();
    }
    //
    public function getPatients()
    {
        $user = auth()->user();

        // If user is not allowed to access patient data, then boot them out. 
        if (!$user->tokenCan('get-patients')) {
            abort(403, 'Unauthorized');
        }

        $doctor = $user->Doctor()->first();
        $patients = $doctor->Patients;

        $patientData = [];
        // Let's clean user data up a bit for patients.
        foreach($patients as $patient) {
            $userData = array(
                'patient_id' => $patient->id,
                'first_name' => $patient->user->first_name,
                'last_name' => $patient->user->last_name,
                'email' => $patient->user->email
            );

            array_push($patientData, $userData);
        }


        $data = [
            'id' => $user->id,
            'doctor' => "{$doctor->user->first_name} {$doctor->user->last_name}" ,
            'patients' => $patientData
        ];

        return response()->json($this->format->formatJsonResponse('data', $data), 200);
    }
}
