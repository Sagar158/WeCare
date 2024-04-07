<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\TrafficPosts;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class TrafficPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Traffic Posts';
    public function index()
    {
        $title = $this->title;
        $this->authorize('viewAny', TrafficPosts::class);
        return view('trafficpost.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $this->authorize('create', TrafficPosts::class);
        $trafficPost = new TrafficPosts();
        return view('trafficpost.edit', compact('trafficPost','title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', TrafficPosts::class);
        $validatedData = $request->validate([
            'title' => [
                'required',
                'string',
                Rule::unique('traffic_posts', 'title'),
            ],
            'description' => 'string'
        ]);
        DB::beginTransaction();
        try{
                $trafficPost = new TrafficPosts();
                $trafficPost->title = $validatedData['title'];
                $trafficPost->description = $validatedData['description'];
                $trafficPost->created_by = auth()->user()->id;
                if($request->has('image'))
                {
                    $trafficPost->image = Helper::imageUpload($request->file('image'));
                }
                $trafficPost->save();
                DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
            throw new \Exception("Error occurred: " . $e->getMessage());
        }
        return redirect()->route('traffic.posts.index')->with('success', 'Traffic Posts added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(TrafficPosts $trafficPosts)
    {
        $this->authorize('viewAny', TrafficPosts::class);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($trafficPostId)
    {
        $this->authorize('update', TrafficPosts::class);
        $title = $this->title;
        $trafficPost = TrafficPosts::findOrFail($trafficPostId);
        return view('trafficpost.edit', compact('trafficPost','title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $trafficPostId)
    {
        $this->authorize('update', TrafficPosts::class);
        $validatedData = $request->validate([
            'title' => [
                'required',
                'string',
                Rule::unique('traffic_posts', 'title')->ignore($trafficPostId),
            ],
            'description' => 'string'
        ]);
        DB::beginTransaction();
        try
        {
            $trafficPost = TrafficPosts::findOrFail($trafficPostId);
            $trafficPost->title = $validatedData['title'];
            $trafficPost->description = $validatedData['description'];
            $trafficPost->created_by = auth()->user()->id;
            if($request->has('image'))
            {
                $trafficPost->image = Helper::imageUpload($request->file('image'));
            }
            $trafficPost->save();

            DB::commit();

        }
        catch(\Exception $e)
        {
            DB::rollback();
            throw new \Exception("Error occurred: " . $e->getMessage());
        }
        return redirect()->route('traffic.posts.index')->with('success', 'Traffic Posts updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($trafficPostId)
    {
        $this->authorize('delete', TrafficPosts::class);
        $record = TrafficPosts::destroy($trafficPostId);
        return response()->json(['success' => $record]);
    }
    public function getTrafficPostsData()
    {
        $query = TrafficPosts::createdby();

        return DataTables::of($query)
            ->editColumn('image',function($post){
                return '<img src="'.asset($post->image).'">';
            })
            ->addColumn('action', function ($post) {
                return '
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="'.route('traffic.posts.edit', $post->id).'">Edit</a>
                                    <a class="dropdown-item delete-record" href="#" data-route="'.route('traffic.posts.destroy', $post->id).'" data-id="'.$post->id.'">Delete</a>
                                </div>
                            </div>
                        ';
            })
            ->rawColumns(['action','image'])
            ->make(true);

    }
}
