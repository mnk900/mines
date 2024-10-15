<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallanFees extends Model
{
    use HasFactory;
 // `challan_fees` (`id`, `fee_title`, `fee_amount`, `fee_amount_in_words`, `active_from`,
  // `active_to`, `is_active`, `created_at`, `updated_at`, `created_by`
    // Define the table associated with the model
    protected $table = 'challan_fees';

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
        'fee_title',
        'fee_amount',
        'fee_amount_in_words',
 
    ];

    // Define relationships
   

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Optional: Add any custom methods or accessors here
}
