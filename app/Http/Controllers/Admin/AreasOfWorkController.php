<?php

namespace App\Http\Controllers\Admin;
use App\Models\AreasOfWork;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AreasOfWorkRequest;
use App\Http\Requests\AreasOfWorkUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AreasOfWorkController extends Controller
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
            $slides=AreasOfWork::where('title', 'LIKE', "%{$request->search}%")->paginate();
            }
            else{
                return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
            }
            return view('admin.areas_of_work.index',['model'=>$slides]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_links=Page::get();
        if(Auth::user()->isAdminOrEditor()){
        return view('admin.areas_of_work.create',['page_links'=>$page_links])->with(['model'=>new AreasOfWork()]);
        }
            return redirect()->route('admin.index',)->with('status',"You are not authorized to access this page");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreasOfWorkRequest $request)
    {
        $imageorg = $request->file('theme_image')->store('uploads/images/AreasOfWork', 'public');
        $thumbnailImage = Image::make($request->file('theme_image'))->resize(300, 170);
        $thumbnailPath = 'uploads/images/AreasOfWork/thumbnails/' . basename($imageorg);
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
        $user_id=Auth::user()->id;
        $areas_of_work = new AreasOfWork();
        $areas_of_work->title = $request->input('title');
        $areas_of_work->description = $request->input('description');
        $areas_of_work->tags = $request->input('tags');
        $areas_of_work->link = $request->input('link');
        $areas_of_work->theme_image = $imageorg;
        $areas_of_work->theme_image_thumbnail = $thumbnailPath;
        $areas_of_work->user_id = $user_id;
        $areas_of_work->save();
        return redirect()->route('areas_of_work.index')->with('status',"Areas Of Work $request->title was successfully created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AreasOfWork  $areas_of_work
     * @return \Illuminate\Http\Response
     */
    public function edit(AreasOfWork $areas_of_work)
    {
        $page_links=Page::get();
        if(Auth::user()->isAdminOrEditor()){
            $areas_of_work=AreasOfWork::findOrFail($areas_of_work->id);
            return view('admin.areas_of_work.edit',['model'=>$areas_of_work,'page_links'=>$page_links]);
            }
        return redirect()->route('admin.index',)->with('status',"You are not authorized to access this page");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AreasOfWork  $areas_of_work
     * @return \Illuminate\Http\Response
     */
    public function update(AreasOfWorkUpdateRequest $request, AreasOfWork $areas_of_work)
    {
        // Update the post data
        $previousImagePath = $areas_of_work->image_path;
        $areas_of_work->title = $request->input('title');
        $areas_of_work->description = $request->input('description');
        $areas_of_work->tags = $request->input('tags');
        $areas_of_work->link = $request->input('link');

        // Handle the uploaded image file if provided
        if ($request->hasFile('theme_image')) {
            // Delete the old image
            Storage::disk('public')->delete('uploads/images/AreasOfWork/'.$areas_of_work->theme_image);
            Storage::disk('public')->delete('uploads/images/AreasOfWork/thumbnails/'.$areas_of_work->theme_image);

            // Store the new image
        $imageorg = $request->file('theme_image')->store('uploads/images/AreasOfWork', 'public');
        $thumbnailImage = Image::make($request->file('theme_image'))->resize(300, 170);
        $thumbnailPath = 'uploads/images/AreasOfWork/thumbnails/' . basename($imageorg);
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
        $areas_of_work->theme_image = $imageorg;
        $areas_of_work->theme_image_thumbnail = $thumbnailPath;
        }


        $areas_of_work->save();
        return redirect()->route('areas_of_work.index')->with('status',"Areas Of Work $request->title was successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AreasOfWork  $areas_of_work
     * @return \Illuminate\Http\Response
     */
    public function destroy(AreasOfWork $areas_of_work)
    {
        if(Auth::user()->isAdminOrEditor()){
            $previousImagePath = $areas_of_work->theme_image;
            if ($previousImagePath) {
                Storage::disk('public')->delete($previousImagePath);
                Storage::disk('public')->delete($areas_of_work->theme_image_thumbnail);
            }
            $areas_of_work->delete();
            return redirect()->route('areas_of_work.index')->with('status',"The Areas Of Work is successfully deleted");
        }
        return redirect()->route('admin.index')->with('status',"You are not authorized to perform this action");
    }
}
