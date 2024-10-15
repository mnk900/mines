<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polygon extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'polygons';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Allow mass assignment for these fields
    protected $fillable = [
        'district_id',
        'company_id',
        'polygon_data',
        'application_id',
        'polygon_added',
        'is_approved',
        'created_on',
    ];

    // Optionally, you can define date casting
    protected $dates = [
        'polygon_added',
        'created_on',
    ];
}
