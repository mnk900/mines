<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $images = Gallery::join('images', 'galleries.id', '=', 'images.gallery_id')
    ->select('galleries.id as gallery_id', 'images.id', 'images.title', 'images.description', 'images.url', 'images.thumbnail_url', 'galleries.title as name', 'galleries.description as content')
    ->where('galleries.id', $id) // Adding a simple where clause
    ->get();
        return view('gallery.view',['images'=>$images]);
    }
}
