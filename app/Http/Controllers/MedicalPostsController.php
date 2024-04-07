<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\MedicalPosts;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class MedicalPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Medical Posts';
    public function index()
    {
        $title = $this->title;
        $this->authorize('viewAny', MedicalPosts::class);
        return view('medicalpost.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $this->authorize('create', MedicalPosts::class);
        $medicalPost = new MedicalPosts();
        return view('medicalpost.edit', compact('medicalPost','title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', MedicalPosts::class);
        $validatedData = $request->validate([
            'title' => [
                'required',
                'string',
                Rule::unique('medical_posts', 'title'),
            ],
            'description' => 'string'
        ]);
        DB::beginTransaction();
        try{
                $medicalPost = new MedicalPosts();
                $medicalPost->title = $validatedData['title'];
                $medicalPost->description = $validatedData['description'];
                $medicalPost->created_by = auth()->user()->id;
                if($request->has('image'))
                {
                    $medicalPost->image = Helper::imageUpload($request->file('image'));
                }
                $medicalPost->save();
                DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
            throw new \Exception("Error occurred: " . $e->getMessage());
        }
        return redirect()->route('medical.posts.index')->with('success', 'Medical Posts added successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($medicalPostsId)
    {
        $this->authorize('update', MedicalPosts::class);
        $title = $this->title;
        $medicalPost = MedicalPosts::findOrFail($medicalPostsId);
        return view('medicalpost.edit', compact('medicalPost','title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $medicalPostsId)
    {
        $this->authorize('update', MedicalPosts::class);
        $validatedData = $request->validate([
            'title' => [
                'required',
                'string',
                Rule::unique('medical_posts', 'title')->ignore($medicalPostsId),
            ],
            'description' => 'string'
        ]);
        DB::beginTransaction();
        try
        {
            $medicalPost = MedicalPosts::findOrFail($medicalPostsId);
            $medicalPost->title = $validatedData['title'];
            $medicalPost->description = $validatedData['description'];
            $medicalPost->created_by = auth()->user()->id;
            if($request->has('image'))
            {
                $medicalPost->image = Helper::imageUpload($request->file('image'));
            }
            $medicalPost->save();

            DB::commit();

        }
        catch(\Exception $e)
        {
            DB::rollback();
            throw new \Exception("Error occurred: " . $e->getMessage());
        }
        return redirect()->route('medical.posts.index')->with('success', 'Medical Posts updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($medicalPostId)
    {
        $this->authorize('delete', MedicalPosts::class);
        $record = MedicalPosts::destroy($medicalPostId);
        return response()->json(['success' => $record]);
    }
    public function getMedicalPostsData()
    {
        $query = MedicalPosts::createdby();

        return DataTables::of($query)
            ->editColumn('image',function($post){
                return '<img src="'.asset($post->image).'">';
            })
            ->addColumn('action', function ($post) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('medical.posts.edit', $post->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('medical.posts.destroy', $post->id).'" data-id="'.$post->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','image'])
            ->make(true);

    }
}
