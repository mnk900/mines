<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationComments extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'application_comments';

    // Define the primary key
    protected $primaryKey = 'id';

    // Specify if the primary key is auto-incrementing
    public $incrementing = true;

    // Set the primary key type
    protected $keyType = 'int';

    // Disable timestamps if your table doesn't have created_at and updated_at columns
    public $timestamps = false;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'application_id',
        'user_id',
        'comment',
        'status',
        'created_on',
        'comment_on_field',
    ];

    // Define relationships
    public function application()
    {
        return $this->belongsTo(LeaseApplicationRegistration::class, 'application_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Optional: Add any custom methods or accessors here
}
