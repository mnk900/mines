<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyAreaPolygon extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'study_area_polygons';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'study_area_id';

    // Disable timestamps if your table does not have `created_at` and `updated_at`
    public $timestamps = false;

    // Specify the fillable attributes
    protected $fillable = [
        'study_area_name',
        'study_area_district',
        'study_area_village',
        'mineral_name',
        'polygon_data',
        'created_on',
    ];

   
}
