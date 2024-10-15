<?php

    namespace App\Http\Controllers\Admin;

use App\Models\ApplicationForSurvey;
use Illuminate\Http\Request;

class ApplicationsForSurveyController extends Controller
{
    public function index()
    {
        $surveys = ApplicationsForSurvey::all();
        return view('surveys.index', compact('surveys'));
    }

    public function create()
    {
        return view('surveys.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'application_id' => 'required|integer',
            'sent_by' => 'required|integer',
            'sent_on' => 'required|date',
            'survey_completed' => 'required|boolean',
            'survey_completed_date' => 'nullable|date',
            'survey_conducted_by' => 'nullable|integer',
        ]);

        dd($request);

        ApplicationForSurvey::create($request->all());

        return redirect()->route('surveys.index')
                         ->with('success', 'Survey created successfully.');
    }

    public function show(ApplicationForSurvey $survey)
    {
        return view('surveys.show', compact('survey'));
    }

    public function edit(ApplicationForSurvey $survey)
    {
        return view('surveys.edit', compact('survey'));
    }

    public function update(Request $request, ApplicationForSurvey $survey)
    {
        $request->validate([
            'application_id' => 'required|integer',
            'sent_by' => 'required|integer',
            'sent_on' => 'required|date',
            'survey_completed' => 'required|boolean',
            'survey_completed_date' => 'nullable|date',
            'survey_conducted_by' => 'nullable|integer',
        ]);

        $survey->update($request->all());

        return redirect()->route('surveys.index')
                         ->with('success', 'Survey updated successfully.');
    }

    public function destroy(ApplicationForSurvey $survey)
    {
        $survey->delete();

        return redirect()->route('surveys.index')
                         ->with('success', 'Survey deleted successfully.');
    }
}