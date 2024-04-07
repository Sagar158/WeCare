<?php

namespace App\Http\Controllers;

use App\Models\HealthCare;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HealthCareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Health Care';
    public function index()
    {
        $this->authorize('viewAny',HealthCare::class);
        $title = $this->title;
        return view('healthcare.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $this->authorize('create',HealthCare::class);
        $healthcare = new HealthCare;
        return view('healthcare.edit', compact('title','healthcare'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',HealthCare::class);
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'institute_address' => 'required|max:255',
            'contact_number' => 'required',
            'opening_hours' => 'required',
            'closing_hours' => 'required',
            'history' => 'string|nullable',
            'map_link' => 'string|nullable',
            'from_day' => 'string|nullable',
            'to_day' => 'string|nullable',
        ]);

        $healthCare = HealthCare::create($validatedData);

        // Attach specializations to the HealthCare instance
        $healthCare->specializations()->attach($request->specialization_id);

        return redirect()->route('healthcare.index')->with('success','Health Care added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(HealthCare $healthCare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($healthCareId)
    {
        $this->authorize('update',HealthCare::class);
        $title = $this->title;
        $healthcare = HealthCare::with(['specializations'])->findOrFail($healthCareId);
        $selectedSpecializations = implode(',',$healthcare->specializations->pluck('id')->toArray());

        return view('healthcare.edit', compact('title','healthcare','selectedSpecializations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $healthCareId)
    {
        $this->authorize('update',HealthCare::class);
        $healthCare = HealthCare::findOrFail($healthCareId);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'institute_address' => 'required|max:255',
            'contact_number' => 'required',
            'opening_hours' => 'required',
            'closing_hours' => 'required',
            'history' => 'string|nullable',
            'map_link' => 'string|nullable',
            'from_day' => 'string|nullable',
            'to_day' => 'string|nullable',
        ]);

        $healthCare->update($validatedData);
        $healthCare->specializations()->sync($request->specialization_id);
        return redirect()->route('healthcare.index')->with('success','Health Care updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($healthCareId)
    {
        $this->authorize('delete',HealthCare::class);
        $record = HealthCare::destroy($healthCareId);
        return response()->json(['success' => $record]);

    }

    public function getHealthCareData()
    {
        $this->authorize('viewAny',HealthCare::class);

        $query = HealthCare::query();

        return DataTables::of($query)
            ->addColumn('action', function ($healthcare) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('healthcare.edit', $healthcare->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('healthcare.destroy', $healthcare->id).'" data-id="'.$healthcare->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function fetchDoctorUsingSpecialization(Request $request)
    {
        $field1 = $request->field1;
        $healthCare = HealthCare::with(['specializations'])->findOrFail($field1);
        $specializations = $healthCare->specializations;
        return response()->json(['data' => $specializations]);
    }

}
