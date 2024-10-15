<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    public $table='companies';
    protected $fillable = [
        'company_name',
        'user_id',
        'authorize_person',
        'designation',
        'office_no',
        'cell_no',
        'business_address',
        'ntn_no',
        'gst_no',
        'nature_business'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
