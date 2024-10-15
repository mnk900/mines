<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictBoundary extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'district_boundries';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'district_boundary_id';

    // Disable timestamps if your table does not have `created_at` and `updated_at`
    public $timestamps = false;

    // Specify the fillable attributes (add any additional fields as necessary)
    protected $fillable = [
        'district_id',
        'boundary_polygon',
        'created_on',
    ];

  
}
