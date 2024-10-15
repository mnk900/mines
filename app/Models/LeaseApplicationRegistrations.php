<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaseApplicationRegistrations extends Model
{
    protected $table = 'lease_application_registrations';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'company_id',
        'user_id',
        'District_id',
        'Tehsil_id',
        'firm_registration',
        'deed_partnership',
        'name_mineral',
        'location',
        'licence_for',
        'covered_area',
        'coor_added',
        'challan_added',
        'challan_uploaded',
        'application_status',
        'challan_form',
        'challan_date',
        'is_verified',
        'is_approved',
    ];



       // Define inverse relationship with ApplicationForDirector
       public function applicationsForDirector()
       {
           return $this->hasMany(ApplicationForDirector::class, 'application_id', 'id');
       }
}
