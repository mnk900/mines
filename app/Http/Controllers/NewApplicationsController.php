<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\NewApplicationRequest;
use App\Models\LeaseApplicationRegistrations;
use App\Models\Polygon;
use App\Models\ChallansGenerated;

class NewApplicationsController extends Controller
{
    public function new_application(){

    //     $id = $id;
    //     // if new application is not present sent to create new application
    //  if ($id == 0) {

        //// Step 1: create new Application
        return view("admin.new_applications.new_application");
       // }
        //  else {
        //         // the application is already created check for other steps

        //         $application = LeaseApplicationRegistrations::find($id);
        //         // dd($application->application_status);
        //         $polygon = Polygon::where('application_id', $id)->first();
        //         /// if the polygon is added check for challan generation else add coordinates
        //         /// step 2 Add coordinates 
        //             if ($polygon) {
        //                 // Polygon found, check for challan generation record
        //                 $challan_fee_id =7; // Registration fee id
        //                 $challan = ChallansGenerated::where('application_id', $id)                        
        //                                             ->where('challan_fee_id', $challan_fee_id)
        //                                             ->first();
        //                     // if challan generated send to upload challan record
        //                     // Step 4: Upload Challan
        //                   if ($challan) {
        //                     return view("admin.new_applications.uploadChallan", compact('challan'));
        //                     /// if challan not generated send to challan generation
        //                          }  
        //                          // Step 3: generate Challan  
        //                         else {
        //                             /// generate challan record
        //                             return redirect()->route('admin.new_applications.generatechallan', $id);
        //                         }

        //                 } 
        //         //// Step 2: Add Coordinates
        //         //// Add the coordinates if does not exist
        //                 else {
        //                 return redirect()->route('admin.new_applications.addcoordinates', $id);
        //                      }
        //                  $coordinates = Polygon::find($id);
               
                
        //     }
    }

    public function new_application_store(NewApplicationRequest $request){
        $user=Auth::user();
        $user_id=$user->id;
        $email=$user->email;
        $company = Company::where('user_id', $user_id)->firstOrFail();
        $firm_registration_path="";
        $deed_partnership_path="";
        if($request->hasFile('firm_registration')){
            $firm_registration_path = $request->file('firm_registration')->store('companydocuments', 'public_uploads');
        }
        if($request->hasFile('deed_partnership')){

            $deed_partnership_path = $request->file('deed_partnership')->store('companydocuments', 'public_uploads');
        }
        $lease_app=new LeaseApplicationRegistrations();
        $lease_app->firm_registration=$firm_registration_path;
        $lease_app->deed_partnership=$deed_partnership_path;
        $lease_app->name_mineral=$request->name_mineral;
        $lease_app->licence_for=$request->licence;
        $lease_app->location=$request->location;
        $lease_app->covered_area=$request->covered_area;
        $lease_app->District_id=$request->district;
        $lease_app->Tehsil_id=$request->tehsil;
        $lease_app->user_id=$user_id;
        $lease_app->company_id=$company->id;
        $lease_app->application_status="incomplete";
        $lease_app->challan_form="";
        $lease_app->save();
        return redirect()->route('user.applications', ['email' => $user->email])->with('status','Your new application has been submitted successfully');
    }
}
