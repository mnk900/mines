<?php

namespace App\Http\Controllers\Admin;
use App\Models\Page;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SliderUpdateRequest;

class SlidersController extends Controller
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
            $slides=Slider::where('title', 'LIKE', "%{$request->search}%")->paginate();
            }
            else{
                return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
            }
            return view('admin.sliders.index',['model'=>$slides]);
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
        return view('admin.sliders.create',['page_links'=>$page_links])->with(['model'=>new Slider()]);
        }
            return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        //dd($request);
        $imagePath = $request->file('slider_image')->store('uploads/images/sliders', 'public');
        $user_id=Auth::user()->id;
        $slider = new Slider();
        $slider->title = $request->input('title');
        $slider->description = $request->input('description');
        $slider->slider_image = $imagePath;
        $slider->page_link =  $request->input('page_link');
        $slider->user_id = $user_id;
        $slider->save();
        return redirect()->route('sliders.index')->with('status',"Slider $request->title was successfully created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $page_links=Page::get();
        if(Auth::user()->isAdminOrEditor()){
            $slider=Slider::findOrFail($slider->id);
            return view('admin.sliders.edit',['model'=>$slider,'page_links'=>$page_links]);
            }
        return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(SliderUpdateRequest $request, Slider $slider)
    {
        // Update the post data
        $previousImagePath = $slider->image_path;
        $slider->title = $request->input('title');
        $slider->description = $request->input('description');
        $slider->page_link =  $request->input('page_link');

        // Handle the uploaded image file if provided
        if ($request->hasFile('slider_image')) {
            //dd($slider);
            if ($previousImagePath) {
                Storage::disk('public')->delete($previousImagePath);
            }
            $imagePath = $request->file('slider_image')->store('uploads/images/sliders', 'public');

            $slider->slider_image = $imagePath;
        }

        $slider->save();
        return redirect()->route('sliders.index')->with('status',"Slider $request->title was successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if(Auth::user()->isAdminOrEditor()){
            $previousImagePath = $slider->image_path;
            if ($previousImagePath) {
                Storage::disk('public')->delete($previousImagePath);
            }
            $slider->delete();
            return redirect()->route('sliders.index')->with('status',"The slider is successfully deleted");
        }
        return redirect()->route('admin.index')->with('status',"You are not authorized to perform this action");
    }
}
