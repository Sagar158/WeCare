<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Doctors';
    public function index()
    {
        $this->authorize('viewAny', Doctor::class);
        $title = $this->title;
        return view('doctors.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Doctor::class);

        $title = $this->title;
        $doctor = new Doctor;
        return view('doctors.edit',compact('title','doctor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',Doctor::class);
        $validatedData = $request->validate([
            'name' => 'required',
            'experience' => 'required',
            'specialization_id' => 'required',
            'health_care_id' => 'required',
            'description' => 'nullable|string',
        ]);
        DB::beginTransaction();
        try{
                $doctor = new Doctor();
                $doctor->name = $validatedData['name'];
                $doctor->experience = $validatedData['experience'];
                $doctor->specialization_id = $validatedData['specialization_id'];
                $doctor->health_care_id = $validatedData['health_care_id'];
                $doctor->description = $validatedData['description'];
                if($request->has('image'))
                {
                    $doctor->image = Helper::imageUpload($request->file('image'));
                }
                $doctor->save();
                DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
            throw new \Exception("Error occurred: " . $e->getMessage());
        }
        return redirect()->route('doctors.index')->with('success', 'Doctor added successfully');
    }

    public function edit($doctorId)
    {
        $this->authorize('update',Doctor::class);
        $title = $this->title;
        $doctor = Doctor::findOrFail($doctorId);

        return view('doctors.edit',compact('title','doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $doctorId)
    {
        $this->authorize('update',Doctor::class);
        $validatedData = $request->validate([
            'name' => 'required',
            'experience' => 'required',
            'specialization_id' => 'required',
            'health_care_id' => 'required',
            'description' => 'nullable|string',

        ]);
        DB::beginTransaction();
        try
        {
            $doctor = Doctor::findOrFail($doctorId);
            $doctor->name = $validatedData['name'];
            $doctor->experience = $validatedData['experience'];
            $doctor->specialization_id = $validatedData['specialization_id'];
            $doctor->health_care_id = $validatedData['health_care_id'];
            $doctor->description = $validatedData['description'];
            if($request->has('image'))
            {
                $doctor->image = Helper::imageUpload($request->file('image'));
            }
            $doctor->save();

            DB::commit();

        }
        catch(\Exception $e)
        {
            DB::rollback();
            throw new \Exception("Error occurred: " . $e->getMessage());
        }

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($doctorId)
    {
        $this->authorize('delete',Doctor::class);
        $record = Doctor::destroy($doctorId);
        return response()->json(['success' => $record]);
    }

    public function getDoctorData(){
        $this->authorize('viewAny',Doctor::class);

        $query = Doctor::with(['specialization','healthcare'])->healthcare();

        return DataTables::of($query)
            ->addColumn('specialization',function($doctor){
                return $doctor->specialization->name;
            })
            ->addColumn('healthcare',function($doctor){
                return $doctor->healthcare->name;
            })
            ->addColumn('action', function ($doctor) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('doctors.edit', $doctor->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('doctors.destroy', $doctor->id).'" data-id="'.$doctor->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','specialization','healthcare'])
            ->make(true);
    }

    public function fetchDoctorWithSpecialization(Request $request)
    {
        $field1 = $request->field1;

        $doctors = Doctor::where('specialization_id', $field1)->get();

        return response()->json(['data' => $doctors]);
    }
}
