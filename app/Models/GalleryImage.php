<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;
    public $table='images';
    protected $fillable = [
        'gallery_id',
        'title',
        'description',
        'url'
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
