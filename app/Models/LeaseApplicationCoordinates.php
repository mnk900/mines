<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaseApplicationCoordinates extends Model
{
    // The table associated with the model.
    protected $table = 'lease_coordinates';
    use HasFactory;
}
