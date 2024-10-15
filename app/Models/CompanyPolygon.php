<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyPolygon extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'company_polygons';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'polygon_id';

    // Disable timestamps if your table does not have `created_at` and `updated_at`
    public $timestamps = false;

    // Specify the fillable attributes
    protected $fillable = [
        'company_name',
        'mineral_name',
        'description',
        'district',
        'status',
        'granted_date',
        'coordinates',
        'contact',
        'address',
        'area',
        'scale',
        'tanure',
        'created_on',
    ];

   
}
