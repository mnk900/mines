<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'page_link',
        'slider_image',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
