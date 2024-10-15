<?php

namespace App\Http\Controllers\Admin;
use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
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
            $slides=About::where('title', 'LIKE', "%{$request->search}%")->paginate();
            }
            else{
                return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
            }
            return view('admin.about.index',['model'=>$slides]);
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
        return view('admin.about.create')->with(['model'=>new About()]);
        }
            return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AboutRequest $request)
    {
        $user_id=Auth::user()->id;
        $about= new About();
        $about->title = $request->input('title');
        $about->description = $request->input('description');
        $about->mission = $request->input('mission');
        $about->vision = $request->input('vision');
        $about->history = $request->input('history');
        $about->user_id = $user_id;
        $about->save();
        return redirect()->route('about.index')->with('status',"About $request->title was successfully created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        if(Auth::user()->isAdminOrEditor()){
            $about=About::findOrFail($about->id);
            return view('admin.about.edit',['model'=>$about]);
            }
        return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(AboutRequest $request, About $about)
    {
        // Update the post data
        $about->title = $request->input('title');
        $about->description = $request->input('description');
        $about->mission = $request->input('mission');
        $about->vision = $request->input('vision');
        $about->history = $request->input('history');
        $about->save();
        return redirect()->route('about.index')->with('status',"About $request->title was successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        if(Auth::user()->isAdminOrEditor()){
            $about->delete();
            return redirect()->route('about.index')->with('status',"The About is successfully deleted");
        }
        return redirect()->route('admin.index')->with('status',"You are not authorized to perform this action");
    }
}
