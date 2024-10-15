<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationsForSurvey extends Model
{
    use HasFactory;

    protected $table = 'applications_for_survey';
    public $timestamps = false; // Disable timestamps
    protected $fillable = [
        'application_id',
        'sent_by',
        'sent_on',
        'survey_completed',
        'survey_completed_date',
        'survey_conducted_by',
    ];

    // If `survey_id` is the primary key, define it explicitly
    protected $primaryKey = 'survey_id';


       // Define inverse relationship with ApplicationForDirector
       public function applicationsForDirector()
       {
           return $this->hasMany(ApplicationsForDirector::class, 'survey_id', 'survey_id');
       }
}
