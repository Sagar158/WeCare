<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\ContactUs;
use App\Models\HealthCare;
use App\Models\MedicalPosts;
use App\Models\TrafficPosts;
use Illuminate\Http\Request;
use App\Models\Specializations;

class MainController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('specialization')->orderBy('created_at','desc')->limit(4)->get();
        $specializations = Specializations::get();
        $trafficPosts = TrafficPosts::orderBy('created_at','desc')->limit(4)->get();
        $medicalPosts = MedicalPosts::orderBy('created_at','desc')->limit(4)->get();

        return view('frontend.index',compact('doctors','specializations','trafficPosts','medicalPosts'));
    }

    public function center($centerId)
    {
        $center = HealthCare::with(['specializations', 'doctors'])->findOrFail($centerId);
        $fetchOpenDays = $this->getDaysInRange($center->from_day, $center->to_day, $center->opening_hours, $center->closing_hours);
        return view('frontend.center', compact('center','fetchOpenDays'));
    }

    public function contactus()
    {
        return view('frontend.contact');
    }

    public function doctor()
    {
        $specializations = Specializations::with(['doctors'])->get();

        return view('frontend.doctors',compact('specializations'));
    }

    public function contactStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'subject' => 'required|max:255',
            'message' => 'required'
        ]);

        $contact = new ContactUs();
        $contact->name = $validatedData['name'];
        $contact->email = $validatedData['email'];
        $contact->subject = $validatedData['subject'];
        $contact->message = $validatedData['message'];
        $contact->save();
        return response('OK', 200)->header('Content-Type', 'text/plain');

    }


    function getDaysInRange($from_day, $to_day, $opening_hours, $closing_hours)
    {
        // Array of all weekdays in order
        $weekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        // Find the indexes for the start and end days
        $startIndex = array_search($from_day, $weekdays);
        $endIndex = array_search($to_day, $weekdays);

        $daysInRange = [];

        // If start day comes after end day in the week, it implies the range wraps around to the next week
        if ($startIndex <= $endIndex) {
            // Range does not wrap around to the next week
            for ($i = $startIndex; $i <= $endIndex; $i++) {
                $daysInRange[] = ucfirst($weekdays[$i]) .' ('.date('h:i a',strtotime($opening_hours)).'-'. date('h:i a', strtotime($closing_hours)).')';
            }
        } else {
            // Range wraps around to the next week
            for ($i = $startIndex; $i < count($weekdays); $i++) {
                $daysInRange[] = ucfirst($weekdays[$i]) .' ('.date('h:i a',strtotime($opening_hours)).'-'. date('h:i a', strtotime($closing_hours)).')';
            }
            for ($i = 0; $i <= $endIndex; $i++) {
                $daysInRange[] = ucfirst($weekdays[$i]) .' ('.date('h:i a',strtotime($opening_hours)).'-'. date('h:i a', strtotime($closing_hours)).')';
            }
        }

        return $daysInRange;
    }

    public function trafficPost($trafficId)
    {
        $traffic = TrafficPosts::findOrFail($trafficId);
        return view('frontend.traffic-post', compact('traffic'));
    }
    public function medicalPost($medicalId)
    {
        $medical = MedicalPosts::findOrFail($medicalId);
        return view('frontend.medical-post', compact('medical'));
    }

    public function medicalPosts()
    {
        $posts = MedicalPosts::orderBy('created_at','desc')->get();
        return view('frontend.medical-posts', compact('posts'));
    }
    public function trafficPosts()
    {
        $posts = TrafficPosts::orderBy('created_at','desc')->get();
        return view('frontend.traffic-posts', compact('posts'));
    }


}
