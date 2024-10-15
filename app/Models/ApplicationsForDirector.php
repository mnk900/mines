<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationsForDirector extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model name
    protected $table = 'applications_for_director';

    // Primary key of the table
    protected $primaryKey = 'id';

    // Disable timestamps as per your setup
    public $timestamps = false;

    // Fillable fields to allow mass assignment
    protected $fillable = [
        'application_id',
        'survey_id',
        'surveyor_id',
        'director_comments',
        'deputy_director_comments',
        'deputy_director_id',
        'deputy_director_comments_date',
        'director_comments_date',
        'upload_documents',
        'document_title',
        'received_date',
        'application_status',
        'update_date',
    ];

    // Define relationships
    public function survey()
    {
        return $this->belongsTo(ApplicationForSurvey::class, 'survey_id', 'survey_id');
    }

    public function application()
    {
        return $this->belongsTo(LeaseApplicationRegistration::class, 'application_id', 'id');
    }

    public function deputyDirector()
    {
        return $this->belongsTo(User::class, 'deputy_director_id', 'id');
    }
}
