<?php

namespace App\Http\Controllers\Admin;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->isAdminOrEditor()){
            $slides=Gallery::where('title', 'LIKE', "%{$request->search}%")->paginate();
            }
            else{
                return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
            }
            return view('admin.gallery.index',['model'=>$slides]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user_id=Auth::user()->user_id;
        // dd($user_id);
        if(Auth::user()->isAdminOrEditor()){
        return view('admin.gallery.create')->with(['model'=>new Gallery()]);
        }
            return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $user_id=Auth::user()->id;
        $gallery= new Gallery();
        $gallery->title = $request->input('title');
        $gallery->description = $request->input('description');
        $gallery->user_id = $user_id;
        $gallery->save();
        return redirect()->route('gallery.index')->with('status',"Gallery $request->title was successfully created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        if(Auth::user()->isAdminOrEditor()){
            $gallery=Gallery::findOrFail($gallery->id);
            return view('admin.gallery.edit',['model'=>$gallery]);
            }
        return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        // Update the post data
        $gallery->title = $request->input('title');
        $gallery->description = $request->input('description');
        $gallery->save();
        return redirect()->route('gallery.index')->with('status',"Gallery $request->title was successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        if(Auth::user()->isAdminOrEditor()){
            $gallery->delete();
            return redirect()->route('gallery.index')->with('status',"The Gallery is successfully deleted");
        }
        return redirect()->route('admin.index')->with('status',"You are not authorized to perform this action");
    }
}
