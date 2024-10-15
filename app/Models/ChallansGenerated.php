<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChallansGenerated extends Model
{
    public $timestamps = false; // Disable timestamps
    protected $table = 'challans_generated'; // Set this to your actual table name
    protected $primaryKey='challan_id';
    protected $fillable = [
        'fee_paid',
        'fee_paid_on',
        'fee_verified',
        'qr_code'
    ];
}



