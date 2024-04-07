<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Appointments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Appointments';
    public function index()
    {
        $title = $this->title;
        $this->authorize('viewAny', Appointments::class);
        return view('appointments.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $this->authorize('create', Appointments::class);
        $appointment = new Appointments;
        return view('appointments.edit', compact('title','appointment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Appointments::class);
        $validatedData = $request->validate([
            'patient_id' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'healthcare_id' => 'required',
            'specialization_id' => 'required',
            'doctor_id' => 'required',
            'type' => 'required',
            'reason' => 'nullable|string',

        ]);
        DB::beginTransaction();
        try
        {
            $appointment = new Appointments();
            $appointment->appointment_number = Helper::generateUniqueKey($appointment);
            $appointment->patient_id = $validatedData['patient_id'];
            $appointment->appointment_date = $validatedData['appointment_date'];
            $appointment->appointment_time = $validatedData['appointment_time'];
            $appointment->type = $validatedData['type'];
            $appointment->healthcare_id = $validatedData['healthcare_id'];
            $appointment->specialization_id = $validatedData['specialization_id'];
            $appointment->doctor_id = $validatedData['doctor_id'];
            $appointment->reason = $validatedData['reason'];
            $appointment->save();
            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
            throw new \Exception("Error occurred: " . $e->getMessage());
        }

        return redirect()->route('appointments.index')->with('success', 'Appointment Booked successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($appointmentId)
    {
        $title = $this->title;
        $this->authorize('viewAny',Appointments::class);
        $appointment = Appointments::with(['doctor','healthcare','patient','specialization'])->findOrFail($appointmentId);
        return view('appointments.show', compact('title','appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($appointmentId)
    {
        $title = $this->title;
        $this->authorize('update',Appointments::class);
        $appointment = Appointments::findOrFail($appointmentId);
        return view('appointments.edit', compact('title','appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $appointmentId)
    {
        $this->authorize('update', Appointments::class);
        $validatedData = $request->validate([
            'patient_id' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'healthcare_id' => 'required',
            'specialization_id' => 'required',
            'doctor_id' => 'required',
            'type' => 'required',
            'reason' => 'nullable|string',

        ]);
        DB::beginTransaction();
        try
        {
            $appointment = Appointments::findOrFail($appointmentId);
            $appointment->patient_id = $validatedData['patient_id'];
            $appointment->appointment_date = $validatedData['appointment_date'];
            $appointment->appointment_time = $validatedData['appointment_time'];
            $appointment->type = $validatedData['type'];
            $appointment->healthcare_id = $validatedData['healthcare_id'];
            $appointment->specialization_id = $validatedData['specialization_id'];
            $appointment->doctor_id = $validatedData['doctor_id'];
            $appointment->reason = $validatedData['reason'];
            $appointment->save();
            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
            throw new \Exception("Error occurred: " . $e->getMessage());
        }

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($appointmentId)
    {
        $this->authorize('delete',Appointments::class);
        $record = Appointments::destroy($appointmentId);
        return response()->json(['success' => $record]);

    }

    public function getAppointmentsData()
    {
        $this->authorize('viewAny',Appointments::class);

        $query = Appointments::with(['doctor','healthcare','patient'])->user();

        return DataTables::of($query)
            ->addColumn('patient_name',function($appointment){
                return isset($appointment->patient->fullname) ? $appointment->patient->fullname : '';
            })
            ->addColumn('appointment_date_time', function($appointment){
                return date('F j, Y', strtotime($appointment->appointment_date)).' '. $appointment->appointment_time;
            })
            ->addColumn('doctor',function($appointment){
                return isset($appointment->doctor->name) ? $appointment->doctor->name : '';
            })
            ->addColumn('healthcare_center',function($appointment){
                return isset($appointment->healthcare->name) ? $appointment->healthcare->name : '';
            })
            ->addColumn('healthcare_address',function($appointment){
                return isset($appointment->healthcare->institute_address) ? $appointment->healthcare->institute_address : '';
            })
            ->editColumn('type',function($appointment){
                return ucfirst($appointment->type);
            })
            ->editColumn('status',function($appointment){
                return ucfirst($appointment->status);
            })
            ->addColumn('action', function ($appointment) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                <a class="dropdown-item" href="'.route('appointments.show', $appointment->id).'">Show</a>
                                <a class="dropdown-item" href="'.route('appointments.edit', $appointment->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('appointments.destroy', $appointment->id).'" data-id="'.$appointment->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','appointment_date_time','patient_name','doctor','healthcare_center','type'])
            ->make(true);
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;
        $appointmentId = $request->appointmentId;
        $appointmentStatus = Appointments::where('id', $appointmentId)->update([
            'status' => $status
        ]);

        return response()->json(['success' => $appointmentStatus]);

    }
}
