<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicationsForDirector;
use App\Models\ApplicationsForSurvey;
use Carbon\Carbon;

class ApplicationsForDirectorController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $applications = ApplicationsForDirector::all();
        return response()->json($applications);
    }

    // Show the form for creating a new resource
    public function create()
    {
        // This is often used for displaying a form in a web application
        // For an API, you might not need this method
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'application_id' => 'required|integer|exists:lease_application_registrations,id',
            'survey_id' => 'required|integer|exists:applications_for_survey,survey_id',
            'director_comments' => 'nullable|string',
            'deputy_director_comments' => 'nullable|string',
            'deputy_director_id' => 'nullable|integer|exists:users,id',
            'deputy_director_comments_date' => 'nullable|date',
            'director_comments_date' => 'nullable|date',
            'upload_documents' => 'nullable|string|max:300',
            'document_title' => 'nullable|string|max:300',
            'received_date' => 'required|date',
            'application_status' => 'required|in:approved,rejected,sent for revision,pending',
            'update_date' => 'nullable|date',
        ]);

        // Create a new ApplicationForDirector record
        $applicationForDirector = ApplicationForDirector::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Application for director created successfully.',
            'data' => $applicationForDirector
        ], 201);
    }



     // when the survey is complete sent it to director

     public function sendtodirector(Request $request)
     {
        
        
         // Validate the incoming request data
         $request->validate([
             'application_id' => 'required|integer',
             'sent_by' => 'required|integer', 
             'survey_id' => 'required|integer',         
         ]);

        
 
         //'firm_registration','challan_fee','deed_registration','general_application','rules_regulations'
         $applicationData =  ApplicationsForSurvey::select(
             'applications_for_survey.survey_id', 
             'applications_for_survey.survey_conducted_by', 
             'applications_for_survey.survey_completed', 
             'application_comments.user_id',
             'application_comments.comment', 
             'application_comments.comment_on_field', 
             'application_comments.status'
         )
         ->join('application_comments', 'applications_for_survey.application_id', '=', 'application_comments.application_id')
         ->where('application_comments.comment_on_field', 'coordinates')
         ->where('applications_for_survey.application_id', '=', $request->application_id)
         ->get();
 
         $errors = [];
         if ($applicationData->isEmpty()) {
            $errors[] = "This  Application   is not approved and no comment from surveyor is added yet. Please add comments to forward it .";
                        
        } 

      
                     
             if (!empty($errors)) {
                               
                 return redirect()->back()->with('errors', $errors);
             }
             else {
                   // Insert the new survey record
                         $survey = ApplicationsForDirector::create([
                             'application_id' => $request->input('application_id'),
                             'surveyor_id' => $request->input('sent_by'),
                             'survey_id' => $request->input('survey_id'),
                             'received_date' => Carbon::now(),
                         ]);
 
                     // dd($survey);
                         // Return a response or redirect
                         return redirect()->back()->with('success', 'Sent to Director  successfully.');
                     }
     }
 
 
    // Display the specified resource
    public function show($id)
    {
        $application = ApplicationForDirector::find($id);

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found.'
            ], 404);
        }

        return response()->json($application);
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        // This is often used for displaying a form in a web application
        // For an API, you might not need this method
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'application_id' => 'required|integer|exists:lease_application_registrations,id',
            'survey_id' => 'required|integer|exists:applications_for_survey,survey_id',
            'director_comments' => 'nullable|string',
            'deputy_director_comments' => 'nullable|string',
            'deputy_director_id' => 'nullable|integer|exists:users,id',
            'deputy_director_comments_date' => 'nullable|date',
            'director_comments_date' => 'nullable|date',
            'upload_documents' => 'nullable|string|max:300',
            'document_title' => 'nullable|string|max:300',
            'received_date' => 'required|date',
            'application_status' => 'required|in:approved,rejected,sent for revision,pending',
            'update_date' => 'nullable|date',
        ]);

        $application = ApplicationForDirector::find($id);

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found.'
            ], 404);
        }

        // Update the record with validated data
        $application->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Application for director updated successfully.',
            'data' => $application
        ]);
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $application = ApplicationForDirector::find($id);

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found.'
            ], 404);
        }

        // Delete the record
        $application->delete();

        return response()->json([
            'success' => true,
            'message' => 'Application for director deleted successfully.'
        ]);
    }
}
