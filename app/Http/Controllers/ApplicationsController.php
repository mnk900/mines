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
use App\Models\LeaseApplicationCoordinates;
use App\Models\LeaseApplicationRegistrations;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\ApplicationComments;
use App\Models\ChallansGenerated;
use GeoPhp\Geometry\Polygon;
use GeoPhp\GeoPHP;
use GeoPHP\Geometry;
//use geoPHP\geoPHP;
use App\Helpers\GeoPHPHelper; // Import the

use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Str;

class ApplicationsController extends Controller
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
    public function applicationsprofile(Request $request) {

           // $user_email = $request->email;
            $loginuser = auth()->user();
            $user_id =$loginuser->id;
            $user_email=$loginuser->email;
        /// get complete data of the applicant for director  //

        $applicantCompleteData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
        ->select('users.*','lease_application_registrations.*','companies.*','lease_application_registrations.id as applicationid')
        ->where('users.email', '=', $user_email)
        ->get();

        $applicationsRegisteredCount = DB::table('lease_application_registrations')
        ->where('user_id', $user_id)
        ->count();

        if ($applicationsRegisteredCount > 0){

        $applicantData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
        ->leftjoin('challans_generated', function($join) {
            $join->on('lease_application_registrations.company_id', '=', 'challans_generated.company_id')
                 ->on('lease_application_registrations.id', '=', 'challans_generated.application_id');
        })
        ->select(
            'users.*',
            'lease_application_registrations.*',
            'companies.*',
            'challans_generated.created_on as challan_generated_date',
            'lease_application_registrations.id as application_id'  // Ensure this alias comes after the general selection
        )
        ->where('users.email', '=', $user_email)
        ->get();
        }
        else{
            $applicantData = [];
        }


           // dd($applicantData);
            $coordinateData = DB::table('users')
            ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
            ->join('lease_coordinates', 'lease_application_registrations.id', '=', 'lease_coordinates.application_id')
            ->select('lease_coordinates.*')
            ->where('users.email', '=', $user_email)
            ->get();

                    $selected_main_menu = 'home_page';
                    //dd( GeneralSetting::find(1)); exit;
                    $this->page_title = " Lease Application Profile ";

          // dd($applicantData);
                   return view('admin.applications.lease_applications',['applicantdata'=>$applicantData, 'coordinatedata'=>$coordinateData,'applicantcompleteData'=>$applicantCompleteData]);
                  //  return view('admin.applications.lease_applications',['applicantdata'=>$applicantData, 'coordinatedata'=>$coordinateData,'applicantcompleteData'=>$applicantCompleteData]);

                }


/// to check individual applications //////////////////////////////////
    public function viewAppDetails(Request $request) {

                    $app_id = $request->appid;
                     $loginuser = auth()->user();
                     $user_id =$loginuser->id;
        /// get complete data of the applicant for director  //

            $applicantCompleteData = DB::table('users')
            ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
            ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
            ->select('users.*','lease_application_registrations.*','companies.*','lease_application_registrations.id as applicationid')
            ->where('users.id', '=', $user_id)
            ->get();


                    $applicantData = DB::table('users')
                    ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
                    ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')

                    ->select('users.id as user_id','users.*','lease_application_registrations.*','companies.*','lease_application_registrations.id as application_id')
                    ->where('lease_application_registrations.id', '=', $app_id)
                    ->get();
                    //dd($applicantData);
                    $coordinateData = DB::table('users')
                    ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
                    ->join('lease_coordinates', 'lease_application_registrations.id', '=', 'lease_coordinates.application_id')
                    ->select('lease_coordinates.*')
                    ->where('lease_application_registrations.id', '=', $app_id)
                    ->get();

                            $selected_main_menu = 'home_page';
                            //dd( GeneralSetting::find(1)); exit;
                            $this->page_title = " Lease Application Profile ";

                  // dd($applicantCompleteData);
                            return view('admin.applications.lease_profile',['applicantdata'=>$applicantData, 'coordinatedata'=>$coordinateData,'applicantcompleteData'=>$applicantCompleteData,'appid'=>$app_id]);
                            //return view('admin.applications.lease_applications',['applicantdata'=>$applicantData, 'coordinatedata'=>$coordinateData,'applicantcompleteData'=>$applicantCompleteData]);

                        }



     /// Generate Challans for applications ////

     public function generatechallan(Request $request) {


        $app_id =$request->name;
        $loginuser = auth()->user();
        $user_id =$loginuser->id;
        $user_email=$loginuser->email;
        /// get complete data of the applicant for director  //

        $applicantCompleteData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
        ->select('users.*','lease_application_registrations.*','companies.*','lease_application_registrations.id as applicationid')
        ->where('users.id', '=', $user_id)
        ->get();
        //$randomNumber = mt_rand(100000000, 999999999);
        // Adjust the width and height of the barcode here
        $barcodeWidth = 4;  // This controls the thickness of the barcode lines
        $barcodeHeight = 4;  // This controls the height of the barcode
        $randomAlphabets = Str::random(15);
        $barcode_generator = new DNS2D();
        // $product = Barcode::where('barcode', $randomAlphabets)->first();
        // while($product){
        //     $barcode_generator = new DNS2D();
        // }
        $barcode1D = $barcode_generator->getBarcodeHTML($randomAlphabets, 'QRCODE', $barcodeWidth, $barcodeHeight);



        $user_id = $request->name;

        $applicantData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')

        ->select('users.*','lease_application_registrations.*','companies.*')
        ->where('users.name', '=', $user_id)
        ->get();
       // dd($applicantData);
        $coordinateData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('lease_coordinates', 'lease_application_registrations.id', '=', 'lease_coordinates.application_id')
        ->select('lease_coordinates.*')
        ->where('users.name', '=', $user_id)
        ->get();

        $challanfee = DB::table('challan_fees')->select('challan_fees.*')->get();
                $selected_main_menu = 'home_page';
                //dd( GeneralSetting::find(1)); exit;
                $this->page_title = " Lease Application Profile ";

                return view('admin.applications.generatechallans',[ 'appid'=>$app_id,'coordinatedata'=>$coordinateData,'challanfees'=>$challanfee, 'barcode'=>$barcode1D,'ranAl'=>$randomAlphabets
                ,'applicantcompleteData'=>$applicantCompleteData,'user_email'=>$user_email]);
 }


 //// End Generate Challans ////////////////////////////////////////////


    public function getchallanfee(Request $request){


        $challanfeeId = $request->challanfeeId; // Get the challan fee ID from the request
        $applicationId = $request->applicationId; // Get the application

            // Fetch challan details based on the ID
            $challanfee = DB::table('challan_fees')->select('challan_fees.*')
                            ->where('challan_fees.id',$challanfeeId)->get();

             // Fetch the application details based on the application
            $application = DB::table('lease_application_registrations')
            ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
            ->select('lease_application_registrations.*','companies.*','companies.id as company_id')
            ->where('lease_application_registrations.id', '=', $applicationId)->get();
            //return response()->json(['application'=>$application]);
            // Check if the challan fee exists
            if ($challanfee) {
                return response()->json([
                    'challan_id' => $challanfee[0]->id,
                    'challan_title' => $challanfee[0]->fee_title,
                    'challan_fee' => $challanfee[0]->fee_amount,
                    'amount_in_words' => $challanfee[0]->fee_amount_in_words,
                    'bank_name' => $challanfee[0]->bank_name,
                    'account_no' => $challanfee[0]->fee_account,
                    'company_name'=> $application[0]->company_name,
                    'application_id' => $application[0]->id,
                    'location' => $application[0]->location,
                    'area' => $application[0]->covered_area,
                    'mineral_concession' => $application[0]->licence_for,
                    'created_at' => $application[0]->created_at,
                    'company_id' => $application[0]->company_id,
                ]);
            }

            // Return an error if no record is found
            return response()->json(['error' => 'Challan fee is not found!'], 404);

    }


 //// Get Existing Challans ////////////////////////////////

    public function getExistingChallans(Request $request){

         // Get the challan fee ID from the request
         // Get the application
         $loginuser = auth()->user();
         $user_id =$loginuser->id;
            // Fetch challan details based on the ID


             // Fetch the application details based on the application
            $application = DB::table('lease_application_registrations')
            ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
            ->join('users', 'users.id', '=', 'companies.user_id')
            ->join('challans_generated', 'challans_generated.application_id', '=', 'lease_application_registrations.id')
            ->join('challan_fees', 'challans_generated.challan_fee_id', '=', 'challan_fees.id')
            ->select('lease_application_registrations.*','companies.*','companies.id as company_id',
                    'challans_generated.*','challan_fees.*','challans_generated.created_on as challan_date')
            ->where('users.id', '=', $user_id)->get();
            //return response()->json(['application'=>$application]);
            // Check if the challan fee exists

            if ($application && $application->count() > 0) {
                return response()->json([
                    'data' => $application->map(function($item) {
                        return [
                            'challan_id' => $item->id,
                            'challan_title' => $item->fee_title,
                            'challan_fee' => $item->fee_amount,
                            'amount_in_words' => $item->fee_amount_in_words,
                            'bank_name' => $item->bank_name,
                            'account_no' => $item->fee_account,
                            'company_name' => $item->company_name,
                            'application_id' => $item->id,
                            'location' => $item->location,
                            'area' => $item->covered_area,
                            'mineral_concession' => $item->licence_for,
                            'created_at' => $item->challan_date,
                            'company_id' => $item->company_id,
                        ];
                    })->toArray() // Convert the Collection to an array
                ]);
            } else {
                return response()->json(['data' => []]); // Return empty array if no records
            }


    }



 //////////////////// End Existing Challans //////////////////////////////

 //// save challan fee information ////////////


    public function saveChallan(Request $request){

        // Validate incoming data
        $validatedData = $request->validate([
            'application_id'=> 'required|string',
            'account_no' => 'required|string',
            'challan_type' => 'required|string',
            'bank_name' => 'required|string',
            'type_of_concession' => 'required|string',
            'qr_code' => 'required|string',
            'company_id' => 'required|string',
        ]);

        // Create new challan record challans_generated` (`challan_id`, `company_id`, `application_id`, `qr_code`,
        //`account_title`, `account_no`, `created_on`, `end_date`, `challan_fee_id`, `type_of_concession`,
        //`is_active`, `updated_on`
        $challan = new ChallansGenerated();
        $challan->application_id = $validatedData['application_id'];
        $challan->qr_code = $validatedData['qr_code'];
        $challan->account_title = $validatedData['bank_name'];
        $challan->challan_fee_id = $validatedData['challan_type'];
        $challan->type_of_concession = $validatedData['type_of_concession'];
        $challan->company_id = $validatedData['company_id'];
        $challan->account_no = $validatedData['account_no'];
        $challan->save();
        $app_status_update=LeaseApplicationRegistrations::where("id",$validatedData['application_id'])->firstOrFail();
        $app_status_update->challan_added=1;
        $app_status_update->save();
        return response()->json(['success' => true]);


    }




 /////// end save challan fee /////////



    public function viewapplications($email) {


        $company_email = $email;
        $loginuser = auth()->user();
        $user_id =$loginuser->id;
            /// get complete data of the applicant for director  //

            $applicantCompleteData = DB::table('users')
            ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
            ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
            ->select('users.*','lease_application_registrations.*','companies.*','lease_application_registrations.id as applicationid')
            ->where('users.id', '=', $user_id)
            ->get();

        /// get complete data of the applicant for director  //
        if (auth()->user()->roles()->where('name', 'Director')->exists()) {
            $applicantData = DB::table('users')
            ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
            ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
            ->select('users.*','lease_application_registrations.*','companies.*','lease_application_registrations.id as applicationid')
            ->where('users.email', '=', $company_email)
            ->get();



            $selected_main_menu = 'home_page';
            //dd( GeneralSetting::find(1)); exit;
            $this->page_title = " Lease Application Profile ";

            $applicant = $applicantData->first(); // Get the first row of the collection

               //dd($applicant);
                         $applicationId = $applicant->applicationid;
            $comments = ApplicationComments::where('application_id', $applicationId)
                 ->with('user') // Assuming you have a relationship with the User model
                 ->orderBy('created_on', 'desc')
                 ->get();

            $coordinateData = LeaseApplicationCoordinates::where('application_id', $applicant->applicationid)->get();



            return view('admin.director.applicationsprofile',['applicantdata'=>$applicantData,'coordinateData'=>$coordinateData,'applicantcompleteData'=>$applicantCompleteData],compact('comments'));




        }
        else {
            $applicantData = DB::table('users')
            ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
            ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
            ->select('users.*','lease_application_registrations.*','companies.*','lease_application_registrations.id as applicationid')
            ->where('users.email', '=', $company_email)
            ->get();

        }


           $selected_main_menu = 'home_page';
           //dd( GeneralSetting::find(1)); exit;
           $this->page_title = " Lease Application Profile ";

           $applicant = $applicantData->first(); // Get the first row of the collection


                        $applicationId = $applicant->applicationid;
           $comments = ApplicationComments::where('application_id', $applicationId)
                ->with('user') // Assuming you have a relationship with the User model
                ->orderBy('created_on', 'desc')
                ->get();


           return view('admin.applications.applicantprofile',['applicantdata'=>$applicantData,'applicantcompleteData'=>$applicantCompleteData],compact('comments'));
       }

 // ------------------------------ View Application for Survey Profile ------------------------------
 // -------------------------------------------------------------------------------------------------


     public function viewapplicationsurvey($id) {


                $app_id = $id;

                    $applicantData = DB::table('users')
                    ->join('companies', 'companies.user_id', '=','users.id')
                    ->join('lease_application_registrations', 'companies.id', '=', 'lease_application_registrations.company_id')
                    ->select('companies.company_name',
                             'lease_application_registrations.id as applicationid',
                             'companies.user_id',
                             'lease_application_registrations.licence_for',
                             'lease_application_registrations.created_at',
                             'lease_application_registrations.location',
                             'lease_application_registrations.covered_area')
                    ->where('lease_application_registrations.id', '=', $app_id)
                    ->get();

                    $coordinateData = DB::table('users')
                    ->join('companies', 'users.id', '=', 'companies.user_id')
                    ->join('lease_application_registrations', 'lease_application_registrations.company_id', '=', 'companies.id')
                    ->join('lease_coordinates', 'lease_coordinates.application_id', '=', 'lease_application_registrations.id')
                    ->select('lease_coordinates.longitude',
                             'lease_coordinates.latitude'  )
                    ->where('lease_application_registrations.id', '=', $app_id)
                    ->get();

                  // dd($applicantData);

                $selected_main_menu = 'home_page';
                //dd( GeneralSetting::find(1)); exit;
                $this->page_title = " Applications For Survey ";

                $applicant = $applicantData->first(); // Get the first row of the collection


                                $applicationId = $applicant->applicationid;
                $comments = ApplicationComments::where('application_id', $applicationId)
                        ->with('user') // Assuming you have a relationship with the User model
                        ->orderBy('created_on', 'desc')
                        ->get();


                return view('admin.surveyor.applicantprofile',['applicantdata'=>$applicantData,'coordinateData'=>$coordinateData],compact('comments'));
            }






        public function uploadchallan(Request $request)
        {
            // Validate the request (e.g., ensure the file is present)
            $request->validate([
                'application_id' => 'required|integer',
                'challan_form' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            ]);
            $app_status_update=LeaseApplicationRegistrations::where("id",$request->application_id)->firstOrFail();
            $app_status_update->challan_uploaded=1;
            $file = $request->file('challan_form');
            $mimeType = $file->getMimeType();
            // Handle file upload
            if ($request->hasFile('challan_form') && strstr($mimeType, "image/")) {
                // Store the file and get the file path
                $challan_path = $request->file('challan_form')->store('images/challans', 'public_uploads');
                $challanImagePath = 'uploads/images/challans/' . basename($challan_path);
                $challanImage = Image::make($request->file('challan_form'));
                Storage::disk('public')->put($challanImagePath, (string) $challanImage->encode());
                // Update the database record
                $update = DB::table('lease_application_registrations')
                    ->where('id', $request->application_id)
                    ->update([
                        'challan_form' => $challanImagePath,
                        'challan_date' => Carbon::now(),
                        'application_status' => 'complete', // Change the application status to incomplete for now
                    ]);

                // Check if the update was successful
                if ($update) {
                    // Redirect to a success page or another route
                    $app_status_update->save();
                    return redirect()->route('user.applications', ['email' => $request->name ?? 'default_user']);
                } else {
                    // Handle the case where the update failed
                    return Redirect::back()->withErrors(['update_error' => 'Failed to update the application.']);
                }
            }
            elseif ($mimeType === 'application/pdf') {
                // The file is a PDF, store it directly without image processing
                $pdfPath = 'uploads/pdfs/' . uniqid() . '.' . $file->getClientOriginalExtension();
                $challan_path = $request->file('challan_form')->store('images/challans', 'public_uploads');
                $challanImagePath = 'uploads/images/challans/' . basename($challan_path);
                //Storage::disk('public')->put($challanImagePath, (string) $challanImage->encode());
                Storage::disk('public')->put($challanImagePath, file_get_contents($file));
           // Update the database record
           $update = DB::table('lease_application_registrations')
           ->where('id', $request->application_id)
           ->update([
               'challan_form' => $challanImagePath,
               'challan_date' => Carbon::now(),
               'application_status' => 'complete', // Change the application status to incomplete for now
           ]);

       // Check if the update was successful
       if ($update) {
        $app_status_update->save();
           // Redirect to a success page or another route
           return redirect()->route('user.applications', ['email' => $request->name ?? 'default_user']);
       } else {
           // Handle the case where the update failed
           return Redirect::back()->withErrors(['update_error' => 'Failed to update the application.']);
       }
            }

            else {
                // Handle the case where the file upload failed
                return Redirect::back()->withErrors(['file_error' => 'Failed to upload the file.']);
            }
        }


        public function showfullMap()
        {

            $loginuser = auth()->user();
            $user_id =$loginuser->id;
            /// get complete data of the applicant for director  //

            $applicantCompleteData = DB::table('users')
            ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
            ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
            ->select('users.*','lease_application_registrations.*','companies.*','lease_application_registrations.id as applicationid')
            ->where('users.id', '=', $user_id)
            ->get();



        $applicantData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')

        ->select('users.*','lease_application_registrations.*','companies.*')
        ->where('users.name', '=', $user_id)
        ->get();


            $polygons = DB::table('polygons')->get();

            // Convert the polygons to a format usable by Leaflet (array of coordinates)
            $polygonData = [];
            foreach ($polygons as $polygon) {
                $coordinates = DB::select("SELECT ST_AsText(p.polygon_data) as geo, p.id as polygonid,
                 p.district_id as district, c.company_name as company , CONCAT(l.licence_for ,' Licence ' , l.name_mineral , ' ' , l.location) as licence
                 FROM polygons  p
                 join companies c on p.company_id = c.id
                 join lease_application_registrations  l on l.id = p.application_id
                 WHERE p.id = ?", [$polygon->id]);
                $polygonData[] = $coordinates;
            }

            //return $polygonData;
            return view('admin/applications/checkmap', ['applicantdata'=>$applicantData,'applicantcompleteData'=>$applicantCompleteData],compact('polygonData'));
        }



        /////// Add Coordinates of applications //////////////////

        public function addcoordinates($app_id)
        {

            $loginuser = auth()->user();
            $user_id =$loginuser->id;
            $email =$loginuser->email;
           // $app_id =0 ;

            //$challan_fee = ChallansGenerated::where('qr_code', $request->input('qr_code'))->firstOrFail();
            $user_application = LeaseApplicationRegistrations::where('id', $app_id)->firstOrFail();
           // dd($user_application);
            $districtId = $user_application->District_id;
            //dd($districtId);
            $companyId=null;
           // dd($districtId);
            /// get complete data of the applicant for director  //

            $applicantCompleteData = DB::table('users')
            ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
            ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
            ->select('users.*','lease_application_registrations.*','companies.id as companyid','companies.*','lease_application_registrations.id as applicationid')
            ->where('users.id', '=', $user_id)
            ->get();



        $applicantData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')

        ->select('users.*','lease_application_registrations.*','companies.*')
        ->where('users.name', '=', $user_id)
        ->get();

            // Assuming there is at least one result
            if ($applicantCompleteData->isNotEmpty()) {
                $companyId = $applicantCompleteData[0]->companyid;
                // Now you can use $companyId as needed
            }
            $polygons = DB::table('polygons')
            ->where('company_id',$companyId)
            ->where('application_id',$app_id)
            ->get();

            // Convert the polygons to a format usable by Leaflet (array of coordinates)
            $polygonData = [];

                $coordinates = DB::select("SELECT ST_AsText(polygon_data) as geo, id as polygonid, district_id as district, company_id as company FROM polygons WHERE district_id = ?", [$districtId]);
                $polygonData[] = $coordinates;


            //return $polygonData;
            return view('admin/applications/addcoordinates', ['applicantdata'=>$applicantData,'applicantcompleteData'=>$applicantCompleteData,'appid'=>$app_id,'company_id'=>$companyId,'districtid'=>$districtId,'email'=>$email],compact('polygonData'));
        }



        ///////// Save Polygon Data //////////////////////////

        public function savePolygon(Request $request){


              // Validate the incoming data
        $request->validate([
            'polygon' => 'required',
            'appid' => 'required|integer',
            'companyid' => 'required|integer',
            'districtid' => 'required|integer'
        ]);

        $polygonString = $request->input('polygon'); // Get the polygon string
             // Convert polygon string to WKT format
            $wktPolygon = 'POLYGON(('.$polygonString.'))';
            // Retrieve the input data

            $appid = $request->input('appid'); // Get application ID
            $company_id = $request->input('companyid'); // Get company ID
            $district_id = $request->input('districtid'); // Get district ID

            // return response()->json([
            //     'success' => true,
            //     'message' => 'i am here',
            //     'coordinates' => $polygonString
            // ]);


           // $wktPolygon = convertToWKT($polygonString);

              // Insert the polygon into the database
        DB::table('polygons')->insert([
            'company_id' => $company_id,
            'application_id' => $appid,
            'district_id' => $district_id,
            'polygon_data' => DB::raw("ST_GeomFromText('$wktPolygon')"),
        ]);

        $app_status_update=LeaseApplicationRegistrations::where("id",$appid)->firstOrFail();
        $app_status_update->coor_added=1;
        $app_status_update->save();


        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'data inserted successfully',
            'coordinates' => $polygonString
        ]);
        }


        /////////////////////////////////////////////////////////


    public function checkOverlaps(Request $request)
    {
        // Get existing polygons from the database (or however you retrieve them)
    // $existingPolygons = Polygon::all();
        $existingPolygons = DB::table('polygons')
                                ->select('id', DB::raw('ST_AsText(polygon_data) as polygon_data'))
                                ->get();
        // Load the geoPHP library
        GeoPHPHelper::loadGeoPHP();

        // Convert incoming new polygon coordinates (as WKT string) from frontend form to geoPHP geometry
        $newPolygonGeo = \geoPHP::load($request->input('newPolygon'), 'wkt');

        $wkt1 = 'POLYGON((0 0, 0 5, 5 5, 5 0, 0 0))';  // A square polygon
        $wkt2 = 'POLYGON((3 3, 3 7, 7 7, 7 3, 3 3))';  // Another square polygon

            // Parse the WKT strings into GeoPHP geometry objects
            $polygon1 = geoPHP::load($wkt1, 'wkt');
            $polygon2 = geoPHP::load($wkt2, 'wkt');
            $intersection = $polygon1->intersection($polygon2);
            if ($intersection) {
                echo $intersection->out('wkt');  // Output the intersection as WKT
            } else {
                echo "No intersection";
            }


        // Variables to store overlap data
        $overlapFound = false;
        $overlapArea = 0; // Square kilometers
        $newPolygonArea = $newPolygonGeo->getArea(); // Area in square kilometers




        foreach ($existingPolygons as $polygonData) {

            $json = json_encode($polygonData->polygon_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            // Convert existing polygon geometry into geoPHP geometry
            //$existingPolygonGeo = \geoPHP::load($polygonData->polygon_data, 'wkt');
            $existingPolygonGeo = \geoPHP::load('POLYGON((0 0, 0 10, 10 10, 10 0, 0 0))', 'wkt');

            $newPolygonGeo = \geoPHP::load('POLYGON((0 0, 0 10, 10 10, 10 0, 0 0))', 'wkt');


                //dd('Existing Polygon WKT: ' . $newPolygonGeo->out('wkt'));



            // dd('Invalid new polygon geometry.');





        $intersection = $existingPolygonGeo->intersection($newPolygonGeo);
        dd($intersection->out('wkt'). 'intersection');
                if ($intersection->isEmpty()) {
                    dd('No intersection found.');
                } else {
                    dd($intersection->out('wkt'));
                }


            if (!$existingPolygonGeo) {
                // Log or debug invalid WKT
                \Log::error('Invalid WKT for existing polygon: ' . $polygonData->polygon_data);
                continue; // Skip this polygon if it's invalid
            }

            // Check for overlap using geoPHP's intersection function
        // $intersection = $existingPolygonGeo->intersection($newPolygonGeo);

            if ($intersection && !$intersection->isEmpty()) {
                // Overlap found
                $overlapFound = true;

                // Calculate overlap area (in square kilometers)
                $overlapArea += $intersection->getArea();

                dd('i am here   is  ');
            }


        }

            // Calculate overlap percentage
            $overlapPercentage = ($overlapArea / $newPolygonArea) * 100;
            $overlapRoundedValue = round($overlapPercentage, 2);

            // Return response (you can return to frontend as JSON or display directly)
            return response()->json([
                'overlap_found' => $overlapFound,
                'overlap_area_km' => $overlapArea,
                'overlap_percentage' => $overlapPercentage,
            ]);
    }



    public function checkOverlap(Request $request)
    {
        // Load GeoPHP library using helper
        GeoPHPHelper::loadGeoPHP();
        $earthRadius = 6371000; // Earth's radius in meters (for accuracy)
        // Convert incoming new polygon coordinates (as WKT string) from the frontend form to geoPHP geometry
        $newPolygonWKT = $request->input('newPolygon');  // The WKT string of the new polygon
        $newPolygonGeo = \geoPHP::load($newPolygonWKT, 'wkt'); // Load new polygon WKT
        $newPolygonArea = $newPolygonGeo->getArea();

         // Conversion factor from square degrees to square meters (approximate)
         $conversionFactor = ($earthRadius * M_PI / 180) ** 2;

         // Convert to square meters
         $newPolygonAreaMeters = $newPolygonArea * $conversionFactor;

        if (!$newPolygonGeo) {
            return response()->json(['error' => 'Invalid new polygon geometry.'], 400);
        }



                // Define your input polygon as a raw SQL expression
                $inputPolygon = DB::raw("ST_GeomFromText('$newPolygonWKT')");

                // Perform the query using Eloquent with raw SQL
                $results = DB::table('polygons')
                    ->select(
                        'company_id',
                        'id',
                        DB::raw('ST_AsText(polygon_data) AS intersecting_polygon'),
                        DB::raw('ST_Area(polygon_data) AS polygon_area'),
                        DB::raw('ST_Area(ST_Intersection(polygon_data, ' . $inputPolygon . ')) AS intersection_area')
                    )
                    ->whereRaw('ST_Intersects(polygon_data, ' . $inputPolygon . ')')
                    ->get();


                    ///////




                    if ($results->isEmpty()) {
                        // Handle the case where no intersections are found
                        $overlapFound = false;
                        $overlapArea = 0; // Or set a default value if needed
                        $overlapPercentage = 0; // Or set a default value if needed
                        $combinedData =[];
                        $polygonArea = 0; //
                    } else {
                        // Process the results
                        $overlapFound = true; // Initialize to 0 in case you want to sum areas


            // Convert intersection areas from square degrees to square meters using the approximate conversion factor


                        // return response()->json([
                        //     'overlap_found' => $results
                        // ]);

                        foreach ($results as $result) {

                            $areaInSquareDegrees = $result->intersection_area;
                            $polygonareaInSquareDegrees = $result->polygon_area;

                            // Conversion factor from square degrees to square meters (approximate)
                            $conversionFactor = ($earthRadius * M_PI / 180) ** 2;

                            // Convert to square meters
                            $areaInSquareMeters = $areaInSquareDegrees * $conversionFactor;
                            $polygonareaInSquareMeters = $polygonareaInSquareDegrees * $conversionFactor;

                            // Convert to square kilometers
                            $areaInSquareKilometers = $areaInSquareMeters / 1e6;
                            $polygonareaInSquareKilometers = $polygonareaInSquareMeters / 1e6;

                            $percentOverlap = $areaInSquareMeters/$newPolygonAreaMeters * 100;
                            $overlapRoundedValue = round($percentOverlap, 2);
                            // Store the converted value back in the result
                            $result->intersection_area_in_square_km = $areaInSquareKilometers;

                            // Collect intersecting polygons and their areas
                            $combinedData[] = [
                                'intersection_polygon' => $result->intersecting_polygon,
                                'intersection_area_in_sqmeters' => round($areaInSquareMeters,3),
                                'intersection_area_in_sqkms' => round($areaInSquareKilometers,3),
                                'company_id' => $result->company_id,
                                'polygon_id' => $result->id,
                                'total_area_of_IntersectingPolygon' => round($polygonareaInSquareKilometers,3),
                                'intersection_percentage' => $overlapRoundedValue,
                                'area' =>$newPolygonAreaMeters,
                            ];
                        }
                    }



        // Calculate overlap percentage based on the total area
    // $overlapPercentage = ($overlapArea / $newPolygonArea) * 100;

        // Return JSON response with overlap details
        return response()->json([
            'overlap_found' => $overlapFound,
            'overlap_data' => $combinedData
        ]);
    }



    public function handlecheckoverlapButtonClick(Request $request)
    {
        $user = auth()->user();  // Assuming you're using authentication to identify users.

        $companyId = $request->input('company_id');
        $applicationId = $request->input('application_id');

        // Check if button click limit is not exceeded
        if ($user->button_clicks < 3) {
            // Increment the button click count
            $user->button_clicks += 1;
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Button clicked successfully!',
                'clicks_left' => 3 - $user->button_clicks,
                'company_id' => $companyId,
                'application_id' => $applicationId
            ]);
        } else {
            // If the button has been clicked 3 times, lock it
            return response()->json([
                'status' => 'locked',
                'message' => 'Button is locked after 3 clicks.',
                'company_id' => $companyId,
                'application_id' => $applicationId
            ]);
        }
    }


     /// checklist of mining licenses /////
    public function clistminninglease(Request $request)
    {
        $loginuser = auth()->user();
        $user_id =$loginuser->id;
        /// get complete data of the applicant for director  //

        $applicantCompleteData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
        ->select('users.*','lease_application_registrations.*','companies.*','lease_application_registrations.id as applicationid')
        ->where('users.id', '=', $user_id)
        ->get();

        $applicantData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')

        ->select('users.*','lease_application_registrations.*','companies.*')
        ->where('users.name', '=', $user_id)
        ->get();



        $selected_main_menu = 'home_page';
        //dd( GeneralSetting::find(1)); exit;
        $this->page_title = " Lease Application Profile ";

        return view('admin.checklists.MiningLease',['applicantdata'=>$applicantData,'applicantcompleteData'=>$applicantCompleteData]);
    }

    public function clistexplorationlicense(Request $request)
    {
        $loginuser = auth()->user();
        $user_id =$loginuser->id;
        /// get complete data of the applicant for director  //

        $applicantCompleteData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
        ->select('users.*','lease_application_registrations.*','companies.*','lease_application_registrations.id as applicationid')
        ->where('users.id', '=', $user_id)
        ->get();

        $applicantData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')

        ->select('users.*','lease_application_registrations.*','companies.*')
        ->where('users.name', '=', $user_id)
        ->get();



        $selected_main_menu = 'home_page';
        //dd( GeneralSetting::find(1)); exit;
        $this->page_title = " Lease Application Profile ";

        return view('admin.checklists.ExplorationLicense',['applicantdata'=>$applicantData,'applicantcompleteData'=>$applicantCompleteData]);
    }

    public function clistreconnaissancelicense(Request $request)
    {
        $loginuser = auth()->user();
        $user_id =$loginuser->id;
        /// get complete data of the applicant for director  //

        $applicantCompleteData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
        ->select('users.*','lease_application_registrations.*','companies.*','lease_application_registrations.id as applicationid')
        ->where('users.id', '=', $user_id)
        ->get();

        $applicantData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')

        ->select('users.*','lease_application_registrations.*','companies.*')
        ->where('users.name', '=', $user_id)
        ->get();



        $selected_main_menu = 'home_page';
        //dd( GeneralSetting::find(1)); exit;
        $this->page_title = " Lease Application Profile ";

        return view('admin.checklists.ReconnaissanceLicense',['applicantdata'=>$applicantData,'applicantcompleteData'=>$applicantCompleteData]);
    }

    public function clistdepositretensionlicense(Request $request)
    {
        $loginuser = auth()->user();
        $user_id =$loginuser->id;
        /// get complete data of the applicant for director  //

        $applicantCompleteData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
        ->select('users.*','lease_application_registrations.*','companies.*','lease_application_registrations.id as applicationid')
        ->where('users.id', '=', $user_id)
        ->get();

        $applicantData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')

        ->select('users.*','lease_application_registrations.*','companies.*')
        ->where('users.name', '=', $user_id)
        ->get();



        $selected_main_menu = 'home_page';
        //dd( GeneralSetting::find(1)); exit;
        $this->page_title = " Lease Application Profile ";

        return view('admin.checklists.DepositRetensionLicense',['applicantdata'=>$applicantData,'applicantcompleteData'=>$applicantCompleteData]);
    }



    function convertToWKT($polygonString)
{
    // Split the polygon string into individual coordinate pairs
    $coordinates = explode(',', $polygonString);

    // Prepare an array to store formatted coordinates
    $wktCoordinates = [];

    // Loop through the coordinate pairs and convert them to "x y" format
    foreach ($coordinates as $coordinate) {
        // Split the latitude and longitude
        $points = explode(' ', trim($coordinate));

        // Check if both latitude and longitude are present
        if (count($points) === 2) {
            $longitude = $points[0];
            $latitude = $points[1];
            // Append the coordinate in "x y" (longitude latitude) format
            $wktCoordinates[] = "{$longitude} {$latitude}";
        }
    }

    // Join the coordinates with a comma and wrap it in the WKT format for POLYGON
    $wktPolygon = 'POLYGON((' . implode(', ', $wktCoordinates) . '))';

    return $wktPolygon;
}

}
