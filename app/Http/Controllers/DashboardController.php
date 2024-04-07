<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\HealthCare;
use App\Models\Appointments;
use App\Models\MedicalPosts;
use App\Models\TrafficPosts;
use Illuminate\Http\Request;
use App\Models\Specializations;

class DashboardController extends Controller
{
    public function index()
    {

        if(auth()->user()->user_type_id == '3')
        {
            return redirect()->route('appointments.index');
        }
        $title = 'Dashboard';
        $specializations = Specializations::count();
        $doctors = Doctor::user()->count();
        $healthCare = HealthCare::healthcare()->count();
        $appointments = Appointments::user()->count();
        $trafficPosts = TrafficPosts::createdby()->count();
        $medicalPosts = MedicalPosts::createdby()->count();
        return view('dashboard', compact('title','specializations','doctors','healthCare','appointments','trafficPosts','medicalPosts'));
    }
}
