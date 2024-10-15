<?php

namespace App\Http\Controllers\Admin;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContactUsController extends Controller
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
            $contactus=ContactUs::where('name', 'LIKE', "%{$request->search}%")->paginate();
            }
            else{
                return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
            }
            return view('admin.contact_us.index',['model'=>$contactus]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactUs  $contactus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contact_u)
    {
       // dd($contact_u);
        if(Auth::user()->isAdminOrEditor()){
            $contact_u->delete();
            return redirect()->route('contact_us.index')->with('status',"The record is successfully deleted");
        }
        return redirect()->route('admin.index')->with('status',"You are not authorized to perform this action");
    }
}
