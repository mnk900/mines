<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicationComments;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; // Import the DB facade

class ApplicationCommentsController extends Controller
{
    public function verifyfirm(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(),[
            'application_id' => 'required|integer',
            'user_id' => 'required|integer',
            'status' => 'required|in:approved,pending,rejected',
            'comment' => 'required|string',
            'comment_on_field' => 'required|in:firm_registration,deed_registration,challan_fee,rejected,coordinates,director',
        ]);
            // Check if validation fails

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);  // 422 Unprocessable Entity
            }

        //dd($request);
        // Insert the data into the application_comments table
        $comment = ApplicationComments::create([
            'application_id' => $request->input('application_id'),
            'user_id' => $request->input('user_id'),
            'status' => $request->input('status'),
            'comment' => $request->input('comment'),
            'comment_on_field' => $request->input('comment_on_field'),
            'created_on' => Carbon::now(),
        ]);
        

        // update status of survey

        // Update the record based on application_id
            DB::table('applications_for_survey')
            ->where('application_id', $request->input('application_id'))
            ->update([
                'survey_completed' => true,
                'survey_completed_date' => now(),
                'survey_conducted_by' => $request->input('user_id'),
            ]);
            
       
   // console.log('================================');
        $comment->load('user'); // Assuming you have a 'user' relationship
       // Format the created_on date
       $formattedDate = Carbon::parse($comment->created_on)->format('d-m-Y h:i:s A');
        return response()->json([
            'comment' => [
                'id' => $comment->id,
                'application_id' => $comment->application_id,
                'user_id' => $comment->user_id,
                'status' => $comment->status,
                'comment' => $comment->comment,
                'comment_on_field' => $comment->comment_on_field,
                'created_on' => $formattedDate,
            ],
            'user' => $comment->user,
        ]);

        // Redirect back with a success message
       // return redirect()->back()->with('success', 'Verification submitted successfully!');
    }

    public function showcomments($applicationId)
{
    $comments = ApplicationComments::where('application_id', $applicationId)
                ->with('user') // Assuming you have a relationship with the User model
                ->orderBy('created_on', 'desc')
                ->get();

                dd('Comments sre '.$comments);
    return view('applicationsdetails', compact('comments'));
}
}