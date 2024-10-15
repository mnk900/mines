<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LeaseApplicationRegistrations;
use App\Http\Controllers\ApplicationsController;
use App\Models\ApplicationsForSurvey;
use App\Models\ApplicationsForDirector;
use App\Models\ChallansGenerated;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $loginuser = auth()->user();
        //dd($loginuser);
          // ---------------------------- Applicant's Data ----------------------------
        // ----------------------------------------------------------------------------
        if (auth()->user()->roles()->where('name', 'Applicant')->exists()) {

            return redirect()->route('user.applications', ['email' => $loginuser->email]);
        }


        // login for surveyor users
           // ---------------------------- Surveyors Data ----------------------------
        // ----------------------------------------------------------------------------
        else if (auth()->user()->roles()->where('name', 'Surveyor')->exists()) {

                $verifiedApplicationsCount = ApplicationsForSurvey :://where('district_id', $loginuser->district)
                 where('survey_completed', true)
                ->count();
                $unVerifiedApplicationsCount = ApplicationsForSurvey :://where('district_id', $loginuser->district)
                            where('survey_completed', false)
                            ->count();

                $totalApplicationsCount = ApplicationsForSurvey :://where('district_id', $loginuser->district)
                            count();

                $surveyApplications =  LeaseApplicationRegistrations::select(
                    'companies.company_name',
                    'companies.user_id',
                    'lease_application_registrations.licence_for',
                    'lease_application_registrations.created_at',
                    'lease_application_registrations.id as appsid',
                    'applications_for_survey.sent_on',
                    'applications_for_survey.survey_id',
                    'applications_for_survey.survey_conducted_by',
                    'applications_for_survey.survey_completed_date',
                    'applications_for_survey.survey_completed',
                    'users.name',
                    'users.email',
                    'applications_for_director.application_id as app_sent_to_director',
                )
                ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
                ->join('applications_for_survey', 'lease_application_registrations.id', '=', 'applications_for_survey.application_id')
                ->join('users', 'users.id', '=', 'applications_for_survey.sent_by')
                ->leftJoin('applications_for_director', 'applications_for_survey.application_id', '=', 'applications_for_director.application_id')

                ->get();

            return view('admin.surveyor.index',['verifiedApplicationsCount'=>$verifiedApplicationsCount,
            'unVerifiedApplicationsCount'=>$unVerifiedApplicationsCount,
           'surveyApplications'=>$surveyApplications,'totalApplicationsCount'=>$totalApplicationsCount,'loginuser'=>$loginuser]);

        }


        // ---------------------------- Assistant Diretors ----------------------------
        // ----------------------------------------------------------------------------
        else if(auth()->user()->roles()->where('name', 'AssistantDirector')->exists()){

            $verifiedApplicationsCount = LeaseApplicationRegistrations::where('district_id', $loginuser->district)
                            ->where('is_verified', true)
                            ->count();
            $unVerifiedApplicationsCount = LeaseApplicationRegistrations::where('district_id', $loginuser->district)
                            ->where('is_verified', false)
                            ->count();

            $totalApplicationsCount = LeaseApplicationRegistrations::where('district_id', $loginuser->district)
                            ->count();

            $leaseApplications = LeaseApplicationRegistrations::select('lease_application_registrations.id as appsid','lease_application_registrations.*','companies.*','users.*', DB::raw("IF(applications_for_survey.application_id IS NULL, 'notsentforsurvey', 'sentforsurvey') as surveyrecord"))
            ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
            ->join('users', 'lease_application_registrations.user_id', '=', 'users.id')
            ->leftJoin('applications_for_survey', 'lease_application_registrations.id', '=', 'applications_for_survey.application_id')
            ->where('district_id', $loginuser->district)->get();
           // dd($leaseApplications);
            return view('admin.milc',['verifiedApplicationsCount'=>$verifiedApplicationsCount,
                        'unVerifiedApplicationsCount'=>$unVerifiedApplicationsCount,
                        'leaseapplications'=>$leaseApplications,'totalApplicationsCount'=>$totalApplicationsCount,'loginuser'=>$loginuser]);

        }
         // ---------------------------- Assistant Diretors ----------------------------
        // ----------------------------------------------------------------------------
        else if(auth()->user()->roles()->where('name', 'Director')->exists()){

            $totalApplicationsCount = LeaseApplicationRegistrations::count();
            $DirectorApplicationsCount = ApplicationsForDirector::count();
            $SurveyApplicationsCount = ApplicationsForSurvey::count() - $DirectorApplicationsCount;
            $AdApplicationsCount = $totalApplicationsCount- ApplicationsForSurvey::count();

          // dd('Survey Applications: '.$SurveyApplicationsCount);



            $leaseApplications = LeaseApplicationRegistrations::select(
                'lease_application_registrations.id',
                'companies.user_id',
                'companies.company_name',
                'lease_application_registrations.name_mineral',
                'lease_application_registrations.licence_For',
                'users.email',
                DB::raw("GROUP_CONCAT(CASE WHEN application_comments.comment_on_field = 'coordinates' THEN application_comments.comment END) as coordinates_comment"),
                DB::raw("GROUP_CONCAT(CASE WHEN application_comments.comment_on_field = 'deed_registration' THEN application_comments.comment END) as deed_partnership_comment"),
                DB::raw("GROUP_CONCAT(CASE WHEN application_comments.comment_on_field = 'firm_registration' THEN application_comments.comment END) as company_registration_comment"),
                DB::raw("GROUP_CONCAT(CASE WHEN application_comments.comment_on_field = 'challan_fee' THEN application_comments.comment END) as challan_comment")
            )
            ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
            ->join('users', 'companies.user_id', '=', 'users.id')
            ->LeftJoin('applications_for_survey', 'lease_application_registrations.id', '=', 'applications_for_survey.application_id')
            ->LeftJoin('applications_for_director', 'lease_application_registrations.id', '=', 'applications_for_director.application_id')
            ->LeftJoin('application_comments', 'lease_application_registrations.id', '=', 'application_comments.application_id')
            ->groupBy('lease_application_registrations.id','companies.user_id','companies.company_name','users.email',
                'lease_application_registrations.name_mineral',
                'lease_application_registrations.licence_For')
            ->get();



            return view('admin.director.dashboard',['totalApplicationsCount'=>$totalApplicationsCount,
                        'DirectorApplicationsCount'=>$DirectorApplicationsCount, 'AdApplicationsCount'=>$AdApplicationsCount,
                        'leaseapplications'=>$leaseApplications,'SurveyApplicationsCount'=>$SurveyApplicationsCount,'loginuser'=>$loginuser]);

        }
        //auth()->user()->roles()->where('name', 'AssistantDirector')->exists()
        else if($loginuser->district != 0){

            $verifiedApplicationsCount = LeaseApplicationRegistrations::where('district_id', $loginuser->district)
                            ->where('is_verified', true)
                            ->count();
            $unVerifiedApplicationsCount = LeaseApplicationRegistrations::where('district_id', $loginuser->district)
                            ->where('is_verified', false)
                            ->count();

            $totalApplicationsCount = LeaseApplicationRegistrations::where('district_id', $loginuser->district)
                            ->count();

            $leaseApplications = LeaseApplicationRegistrations::select('lease_application_registrations.*', DB::raw("IF(applications_for_survey.application_id IS NULL, 'notsentforsurvey', 'sentforsurvey') as surveyrecord"))
            ->leftJoin('applications_for_survey', 'lease_application_registrations.id', '=', 'applications_for_survey.application_id')
            ->where('district_id', $loginuser->district)->get();
           // dd($leaseApplications);
            return view('admin.milc',['verifiedApplicationsCount'=>$verifiedApplicationsCount,
                        'unVerifiedApplicationsCount'=>$unVerifiedApplicationsCount,
                        'leaseapplications'=>$leaseApplications,'totalApplicationsCount'=>$totalApplicationsCount,'loginuser'=>$loginuser]);

        }
        else{

            return  redirect()->route('user.applications', ['name' => $loginuser->email]);;

        }
    }

    // when document verification is complete send it for survey

    public function sendtosurvey(Request $request)
    {

        //dd($request);

        // Validate the incoming request data
        $request->validate([
            'application_id' => 'required|integer',
            'sent_by' => 'required|integer',
        ]);

        //'firm_registration','challan_fee','deed_registration','general_application','rules_regulations'
        $applicationData =  LeaseApplicationRegistrations::select(
            'companies.company_name',
            'application_comments.application_id',
            'application_comments.comment',
            'application_comments.comment_on_field',
            'application_comments.status'
        )
        ->join('application_comments', 'lease_application_registrations.id', '=', 'application_comments.application_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
        ->whereIn('application_comments.comment_on_field', ['firm_registration', 'challan_fee', 'deed_registration'])
        ->where('application_comments.status', 'approved')
        ->where('lease_application_registrations.id', '=', $request->application_id)
        ->get();

            //dd($applicationData);


            $crossTab = $applicationData->groupBy('application_id')->map(function ($items) {
                // Initialize the status fields
                $result = [
                    'firm_registration' => 'newapplication',
                    'challan_fee' => 'newapplication',
                    'deed_registration' => 'newapplication',
                ];

                // Set the status fields based on the available data
                foreach ($items as $item) {
                    $result[$item->comment_on_field] = $item->status;
                }

                return $result;
            });

                    $errors = [];
                    foreach ($crossTab as $application_id => $statuses) {
                        foreach ($statuses as $field => $status) {
                            if ($status !== 'approved') {
                                $errors[] = "The <strong style='color: gold;'>{$field} </strong> for Application  <strong style='color: gold;'> {$applicationData[0]->company_name} </strong> is not approved. Please approve it.";
                            }
                        }
                    }

            if (!empty($errors)) {

                return redirect()->back()->with('errors', $errors);
            }
            else {
                  // Insert the new survey record
                        $survey = ApplicationsForSurvey::create([
                            'application_id' => $request->input('application_id'),
                            'sent_by' => $request->input('sent_by'),
                            'sent_on' => Carbon::now(),
                        ]);

                    // dd($survey);
                        // Return a response or redirect
                        return redirect()->back()->with('success', 'Survey inserted successfully.');
                    }
    }

   //------------------------------------- End of sendtosurvey --------------------------------//



    public function getSurveyRecord($applicationId)
    {
        $surveyRecord = DB::table('applications_for_survey')
                     ->select('application_id', 'sent_by','sent_on')
                     ->where('application_id', $applicationId)
                     ->distinct()
                     ->get();

                     if ($surveyRecord->isEmpty()) {
                        // Handle the case where no records are found
                        // For example, you can return null, an empty array, or a custom message
                        return null;
                    }

        return $surveyRecord;
    }


    //------------------------------------- Challans Verification Process --------------------------------//
    public function challan_list(Request $request){
        $results = DB::table('challans_generated')
    ->join('challan_fees', 'challans_generated.challan_id', '=', 'challan_fees.id')
    ->join('lease_application_registrations', 'lease_application_registrations.id', '=', 'challans_generated.application_id')
    ->join('companies', 'companies.id', '=', 'challans_generated.company_id')
    ->where('challans_generated.qr_code', 'like', '%' . $request->search . '%')
    ->orWhere('companies.company_name', 'like', '%' . $request->search . '%')
    ->select('challans_generated.*','challans_generated.is_active as challan_active', 'challan_fees.*', 'lease_application_registrations.*', 'companies.*')
    ->get();
    //dd($results);
        return view("admin.challans.challan_list",["results"=>$results]);
    }

    public function challan_details($qr_code){
        $results = DB::table('challans_generated')
    ->join('challan_fees', 'challans_generated.challan_id', '=', 'challan_fees.id')
    ->join('lease_application_registrations', 'lease_application_registrations.id', '=', 'challans_generated.application_id')
    ->join('companies', 'companies.id', '=', 'challans_generated.company_id')
    ->where('challans_generated.qr_code', '=', $qr_code)
    ->select('challans_generated.*','challans_generated.is_active as challan_active', 'challan_fees.*', 'lease_application_registrations.*', 'companies.*')
    ->get();
    $barcodeWidth = 4;  // This controls the thickness of the barcode lines
        $barcodeHeight = 4;  // This controls the height of the barcode
        $randomAlphabets = $results[0]->qr_code;
        $barcode_generator = new DNS2D();
        // $product = Barcode::where('barcode', $randomAlphabets)->first();
        // while($product){
        //     $barcode_generator = new DNS2D();
        // }
        $barcode1D = $barcode_generator->getBarcodeHTML($randomAlphabets, 'QRCODE', $barcodeWidth, $barcodeHeight);
    //dd($results);
        return view("admin.challans.challan_details",["results"=>$results,'qr_code'=>$barcode1D]);
    }
    //------------------------------------- End Challans Verification Process --------------------------------//

    public function challanFeeVerify(Request $request){
        $challan_fee = ChallansGenerated::where('qr_code', $request->input('qr_code'))->firstOrFail();
        //dd($challan_fee);
        $challan_fee->fee_paid=$request->fee_amount_submitted;
        $challan_fee->fee_paid_on=$request->fee_submitted_date;
        $challan_fee->fee_verified=$request->fee_verify;
        $challan_fee->update();
        return redirect()->route('admin.challans.challan_list')->with('status','Challan Fee has been verified successfully');
    }
    //controller end
}
