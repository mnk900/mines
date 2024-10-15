<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreasOfWork extends Model
{
    use HasFactory;
    public $table='areas_of_work';
    protected $fillable = [
        'title',
        'description',
        'tags',
        'theme_image',
        'theme_image_thumbnail',
        'link'
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
