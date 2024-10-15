<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'logo_thumbnail',
        'website',
        'description'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
