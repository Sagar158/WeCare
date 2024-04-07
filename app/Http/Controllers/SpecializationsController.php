<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specializations;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SpecializationsController extends Controller
{
    public $title = 'Specializations';
    public function index()
    {
        $this->authorize('viewAny', Specializations::class);
        $title = $this->title;
        return view('specialization.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Specializations::class);

        $title = $this->title;
        $specialization = new Specializations;
        return view('specialization.edit',compact('title','specialization'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',Specializations::class);
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('specializations', 'name'),
            ],
            'description' => 'string'
        ]);
        DB::beginTransaction();
        try{
                $specialization = new Specializations();
                $specialization->name = $validatedData['name'];
                $specialization->description = $validatedData['description'];
                $specialization->save();
                DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
            throw new \Exception("Error occurred: " . $e->getMessage());
        }
        return redirect()->route('specialization.index')->with('success', 'Specialization added successfully');
    }

    public function edit($specializationId)
    {
        $this->authorize('update',Specializations::class);
        $title = $this->title;
        $specialization = Specializations::findOrFail($specializationId);

        return view('specialization.edit',compact('title','specialization'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $specializationId)
    {
        $this->authorize('update',Specializations::class);
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('specializations', 'name')->ignore($specializationId),
            ],
            'description' => 'string'
        ]);
        DB::beginTransaction();
        try
        {
            $specialization = Specializations::findOrFail($specializationId);
            $specialization->name = $validatedData['name'];
            $specialization->description = $validatedData['description'];
            $specialization->save();

            DB::commit();

        }
        catch(\Exception $e)
        {
            DB::rollback();
            throw new \Exception("Error occurred: " . $e->getMessage());
        }

        return redirect()->route('specialization.index')->with('success', 'Specialization updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($specialtionId)
    {
        $this->authorize('delete',Specializations::class);
        $record = Specializations::destroy($specialtionId);
        return response()->json(['success' => $record]);
    }

    public function getSpecializationData(){
        $this->authorize('viewAny',Specializations::class);

        $query = Specializations::select('id','name')->get();

        return DataTables::of($query)
            ->addColumn('action', function ($specialization) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('specialization.edit', $specialization->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('specialization.destroy', $specialization->id).'" data-id="'.$specialization->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function fetchSpecializations(Request $request)
    {
        $specializations = Specializations::select('id', 'name')
        ->when($request->filled('search'), function ($query) use ($request) {
            return $query->where('name', 'LIKE', '%' . $request->search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->cursor();

        return response()->json(['data' => $specializations]);
    }
}
