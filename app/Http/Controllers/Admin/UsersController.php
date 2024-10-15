<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AreaController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
        $this->middleware('can:manageUsers,App\Models\User');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.users.index')->with('model',User::paginate(10));
    }


   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
        $areaController = new AreaController();
        $districts = $areaController->getDistrictsdata();
        
        return view('admin.users.create',['model'=>new User(),'roles'=>$roles,'districts'=>$districts]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->roles()->sync($request->roles);
        return redirect()->route('users.index')->with('status',"user $user->name was successfully created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Auth::user()->id==$user->id){
            return redirect()->route('users.index')->with('status',"You cannot edit the admin");;
        }
        return view('admin.users.edit',['model'=>$user,'roles'=>Role::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(Auth::user()->id==$user->id){
            return redirect()->route('users.index')->with('status',"You cannot edit the admin");
        }
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id
        ]);
        $user->fill($request->only(['name','email']));
        $user->save();
        $user->roles()->sync($request->roles);
        return redirect()->route('users.index')->with('status',"user $user->name was successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
