<?php

namespace App\Http\Controllers\Admin;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Http\Requests\TeamUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeamsController extends Controller
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
            $slides=Team::where('name', 'LIKE', "%{$request->search}%")->paginate();
            }
            else{
                return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
            }
            return view('admin.teams.index',['model'=>$slides]);
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
        return view('admin.teams.create')->with(['model'=>new Team()]);
        }
            return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        //dd($request);
        $imagePath = $request->file('photo')->store('uploads/images/teams', 'public');
        $user_id=Auth::user()->id;
        $team = new Team();
        $team->name = $request->input('name');
        $team->position = $request->input('position');
        $team->bio = $request->input('bio');
        $team->photo = $imagePath;
        $team->user_id = $user_id;
        $team->save();
        return redirect()->route('teams.index')->with('status',"Team member $request->name was successfully created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        if(Auth::user()->isAdminOrEditor()){
            $team=Team::findOrFail($team->id);
            return view('admin.teams.edit',['model'=>$team]);
            }
        return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(TeamUpdateRequest $request, Team $team)
    {
        // Update the post data
        $previousImagePath = $team->image_path;
        $team->name = $request->input('name');
        $team->position = $request->input('position');
        $team->bio = $request->input('bio');

        // Handle the uploaded image file if provided
        if ($request->hasFile('photo')) {
            //dd($team);
            if ($previousImagePath) {
                Storage::disk('public')->delete($previousImagePath);
            }
            $imagePath = $request->file('photo')->store('uploads/images/teams', 'public');

            $team->photo = $imagePath;
        }

        $team->save();
        return redirect()->route('teams.index')->with('status',"Team member $request->title was successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        if(Auth::user()->isAdminOrEditor()){
            $previousImagePath = $team->image_path;
            if ($previousImagePath) {
                Storage::disk('public')->delete($previousImagePath);
            }
            $team->delete();
            return redirect()->route('teams.index')->with('status',"The team member is successfully deleted");
        }
        return redirect()->route('admin.index')->with('status',"You are not authorized to perform this action");
    }
}
