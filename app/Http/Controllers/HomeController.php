<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;
use Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\DistrictBoundary;
use App\Models\StudyAreaPolygon;
use App\Models\CompanyPolygon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //dd('asjhdajhs');


        $districts = DB::table('district_boundries')->get();
        //dd($districts);
        $studyAreas = DB::table('study_area_polygons')->get();
        //dd($studyAreas);

        $companyPolygons = DB::table('company_polygons')->get();
      //  dd($companyPolygons);


            // Convert the polygons to a format usable by Leaflet (array of coordinates)
            $polygonData = [];
            foreach ($districts as $polygon) {
                $coordinates = DB::select("SELECT ST_AsText(p.boundary_polygon) as geo, p.district_id as polygonid
                 FROM district_boundries  p
                 WHERE p.district_boundary_id = ?", [$polygon->district_boundary_id]);
                $polygonData[] = $coordinates;
            }

             // Convert the polygons to a format usable by Leaflet (array of coordinates)
             $studyAreasData = [];
             foreach ($studyAreas as $polygon) {
                 $coordinates = DB::select("SELECT ST_AsText(p.polygon_data) as geo, p.study_area_name as polygonid
                  FROM study_area_polygons  p
                  WHERE p.study_area_id = ?", [$polygon->study_area_id]);
                 $studyAreasData[] = $coordinates;
             }

              // Convert the polygons to a format usable by Leaflet (array of coordinates)
            $companyPolygonsData = [];
            foreach ($companyPolygons as $polygon) {
                $coordinates = DB::select("SELECT ST_AsText(p.coordinates) as geo, p.mineral_name as polygonid, p.status as grantstatus
                 FROM company_polygons  p
                 WHERE p.polygon_id = ?", [$polygon->polygon_id]);
                $companyPolygonsData[] = $coordinates;
            }

        $slider=Slider::get();
        return view('home.index',['slider'=>$slider,'districts'=>$polygonData,  'studyAreas'=>$studyAreasData, 'companyPolygons'=>$companyPolygonsData]);
    }

    public function map()
    {
        //dd('asjhdajhs');


        $districts = DB::table('district_boundries')->get();
        //dd($districts);
        $studyAreas = DB::table('study_area_polygons')->get();
        //dd($studyAreas);

        $companyPolygons = DB::table('company_polygons')->get();
      //  dd($companyPolygons);


            // Convert the polygons to a format usable by Leaflet (array of coordinates)
            $polygonData = [];
            foreach ($districts as $polygon) {
                $coordinates = DB::select("SELECT ST_AsText(p.boundary_polygon) as geo, p.district_id as polygonid
                 FROM district_boundries  p
                 WHERE p.district_boundary_id = ?", [$polygon->district_boundary_id]);
                $polygonData[] = $coordinates;
            }

             // Convert the polygons to a format usable by Leaflet (array of coordinates)
             $studyAreasData = [];
             foreach ($studyAreas as $polygon) {
                 $coordinates = DB::select("SELECT ST_AsText(p.polygon_data) as geo, p.study_area_name as polygonid
                  FROM study_area_polygons  p
                  WHERE p.study_area_id = ?", [$polygon->study_area_id]);
                 $studyAreasData[] = $coordinates;
             }

              // Convert the polygons to a format usable by Leaflet (array of coordinates)
            $companyPolygonsData = [];
            foreach ($companyPolygons as $polygon) {
                $coordinates = DB::select("SELECT ST_AsText(p.coordinates) as geo, p.mineral_name as polygonid, p.status as grantstatus
                 FROM company_polygons  p
                 WHERE p.polygon_id = ?", [$polygon->polygon_id]);
                $companyPolygonsData[] = $coordinates;
            }

        $slider=Slider::get();
        return view('home.map',['slider'=>$slider,'districts'=>$polygonData,  'studyAreas'=>$studyAreasData, 'companyPolygons'=>$companyPolygonsData]);
    }

            public function register(){
                $districts = DB::table('areas')
                                ->select('District', 'DistrictName')
                                ->distinct()
                                ->get();
                //dd('here');
                return view('home.register', compact('districts'));
            }


            public function register_post(Request $request){
            
              
                    
                        $validator = Validator::make($request->all(),[
                            'authorize_person' => 'required|string|max:255',
                            'designation' => 'required|string|max:50|',
                            'office_no' => 'nullable|string|regex:/^\+?[0-9]{1,15}$/',
                            'cell_no' => 'required|string|regex:/^\+?[0-9]{1,15}$/',
                            'company_name' => 'required|string|max:150',
                            'business_address' => 'required|string|max:255',
                            'nature_business' => 'required|string|max:150',
                            'firm_registration' => 'required|file|mimes:pdf,jpg,png',
                            'deed_partnership' => 'required|file|mimes:pdf,jpg,png',
                            // 'name_mineral' => 'required|string|max:100',
                            // 'location' => 'required|string|max:255',
                            // 'covered_area' => 'required|string|max:255',
                            'password' => 'required|string|min:8|confirmed',
                            'email' => 'required|string|email|max:255|unique:users',
                            'ntn_no' => 'nullable|string|max:30',  // Add validation rule here
                            'gst_no' => 'nullable|string|max:30',
                            'cnic' => 'nullable|string|max:30',
                        
                        
                        ]);
                    // echo "test80"; exit;
                        if ($validator->fails()) {
                            
                        return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
                    }
                    
                        if($validator->passes()) {
                        $firm_registration_path = $request->file('firm_registration')->store('companydocuments', 'public_uploads');
                        $deed_partnership_path = $request->file('deed_partnership')->store('companydocuments', 'public_uploads');
                        //dd($request);
                        try {
                    $leaseApplicationID = DB::select("CALL CreateLeaseApplication(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                        $request->cnic,
                       
                       // $request->district,
                       // $request->tehsil,
                        1, // user_role
                        Hash::make($request->password),
                        $request->email,
                        $request->authorize_person,
                        $request->designation,
                        $request->office_no,
                        "incomplete", //application status code
                        $request->cell_no,
                        $request->company_name,
                        $request->business_address,
                        $request->ntn_no,
                        $request->gst_no,
                        $request->nature_business,
                        $firm_registration_path,
                        $deed_partnership_path,
                       // $request->name_mineral,
                       // $request->location,
                       // $request->covered_area,
                    // $longitudesStr,
                    // $latitudesStr,
                       // $request->licence,
                    ]);
                } catch (\Exception $e) {
                    return back()->withErrors(['error' => $e->getMessage()]);
                }
                //dd($leaseApplicationID);
                $leaseApplicationID = $leaseApplicationID[0]->LeaseApplicationID;
                $credentials = [
                    'name' =>$request->email,
                    'password' => $request->password
                ];

                if (Auth::attempt($credentials)) {
                    return redirect()->route('user.applications', ['email' => $request->email]);
                }


                }
            }


public function uploadchallan(Request $request)
    {
        // Validate the request (e.g., ensure the file is present)
        $request->validate([
            'application_id' => 'required|integer',
            'challan_form' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('challan_form')) {
            $challan_path = $request->file('challan_form')->store('uploads/images/challans', 'public');
            dd($challan_path);
            // Update the database record
            $update = DB::table('lease_application_registrations')
                ->where('id', $request->application_id)
                ->update([
                    'challan_form' => $challan_path,
                    'challan_date' => Carbon::now(),
                    'application_status' => 'complete', // Change the application status to incomplete for now
                ]);

            // Check if the update was successful
            if ($update) {
                // Redirect to a success page or another route
                return redirect()->route('user.applications', ['user_name' => $request->user_name ?? 'default_user']);
            } else {
                // Handle the case where the update failed
                return Redirect::back()->withErrors(['update_error' => 'Failed to update the application.']);
            }
        } else {
            // Handle the case where the file upload failed
            return Redirect::back()->withErrors(['file_error' => 'Failed to upload the file.']);
        }
    }


// to display the districts in view
public function showDropdowns()
        {
            $districts = DB::table('areas')
                        ->select('District', 'DistrictName')
                        ->distinct()
                        ->get();

            return view('home.register', compact('districts'));
        }
}