<?php

namespace App\Http\Controllers;

use App\Models\Recordings;
use App\Models\Appointments;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class RecordingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Recordings';
    public function index()
    {
        $this->authorize('viewAny', Recordings::class);
        $title = $this->title;
        return view('recordings.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Recordings::class);
        $title = $this->title;

        $recording = new Recordings;
        return view('recordings.edit', compact('title','recording'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Recordings::class);

        $request->validate([
            'appointment_id' => 'required|integer',
            'recording' => 'required|file|mimes:mp4,mpeg', // Validate it's a file, specifically mp4 or mpeg
        ]);

        // Handle the video file upload
        if ($request->hasFile('recording'))
        {
            $file = $request->file('recording');
            $filename = time().'_'.$file->getClientOriginalName(); // Create a unique filename

            $path = $file->store('public/recordings');
            $filePath = Storage::url($path);

            // Create a new Recording entry
            $recording = new Recordings();
            $recording->appointment_id = $request->appointment_id;
            $recording->recording = $filePath; // Store the file path in the recording column
            $recording->save();

            return redirect()->route('recordings.index')->with('success', 'Recording uploaded successfully.');
        }

        return back()->with('error', 'Failed to upload recording.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recordings $recordings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recordings $recordings)
    {
        $this->authorize('update', Recordings::class);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recordings $recordings)
    {
        $this->authorize('update', Recordings::class);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recordings $recordings)
    {
        $this->authorize('delete', Recordings::class);
    }

    public function getRecordingData()
    {
        $this->authorize('viewAny',Recordings::class);
        $userType = auth()->user()->user_type_id;
        $userId = auth()->user()->id;


        $query = Recordings::with(['appointment'])->whereHas('appointment',function($query) use($userId, $userType){
            if($userType == 3)
            {
                return $query->where('patient_id', $userId);
            }
            else if($userType == 2)
            {
                return $query->where('healthcare_id', auth()->user()->health_care_id);
            }
        });

        return DataTables::of($query)
            ->addColumn('appointment_number', function($recording){
                return isset($recording->appointment->appointment_number) ? $recording->appointment->appointment_number : '';
            })
            ->editColumn('recording',function($recording){
                return isset($recording->recording) ? '<a target="_blank" href="'.asset($recording->recording).'">Video Link</a>' : '';
            })
            ->addColumn('action', function ($recording) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('recordings.edit', $recording->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('recordings.destroy', $recording->id).'" data-id="'.$recording->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','recording','appointment_number'])
            ->make(true);
    }

}
