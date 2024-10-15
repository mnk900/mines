<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    public $table='about';
    protected $fillable = [
        'title',
        'description',
        'mission',
        'vision',
        'history',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
