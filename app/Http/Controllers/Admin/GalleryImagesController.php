<?php

namespace App\Http\Controllers\Admin;
use App\Models\GalleryImage;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryImageRequest;
use App\Http\Requests\GalleryImageUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class GalleryImagesController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->isAdminOrEditor()){
            $gallery_images=GalleryImage::where('title', 'LIKE', "%{$request->search}%")->paginate();
            }
            else{
                return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
            }
            return view('admin.images.index',['model'=>$gallery_images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gallery=Gallery::get();
        if(Auth::user()->isAdminOrEditor()){
        return view('admin.images.create',['gallery'=>$gallery])->with(['model'=>new GalleryImage()]);
        }
            return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryImageRequest $request)
    {
        //dd($request);
        $imageorg = $request->file('image')->store('uploads/images/GalleryImages/Images', 'public');
        $thumbnailImage = Image::make($request->file('image'))->resize(150, 150);
        $thumbnailPath = 'uploads/images/GalleryImages/thumbnails/' . basename($imageorg);
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
        $user_id=Auth::user()->id;
        $gallery_image = new GalleryImage();
        $gallery_image->gallery_id = $request->input('gallery_id');
        $gallery_image->title = $request->input('title');
        $gallery_image->description = $request->input('description');
        $gallery_image->url = $imageorg;
        $gallery_image->thumbnail_url = $thumbnailPath;
        $gallery_image->user_id = $user_id;
        $gallery_image->save();
        return redirect()->route('images.index')->with('status',"Gallery Image $request->title was successfully created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GalleryImage  $gallery_image
     * @return \Illuminate\Http\Response
     */
    public function edit(GalleryImage $image)
    {
        //dd($image);
        $gallery=Gallery::get();
        if(Auth::user()->isAdminOrEditor()){
            $gallery_image=GalleryImage::findOrFail($image->id);
            return view('admin.images.edit',['model'=>$image,'gallery'=>$gallery]);
            }
        return redirect()->route('admin.index')->with('status',"You are not authorized to access this page");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GalleryImage  $gallery_image
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryImageUpdateRequest $request, GalleryImage $image)
    {
        // Handle the uploaded image file if provided
        //dd($image);
        if ($request->hasFile('image')) {
            // Delete the old image
            Storage::disk('public')->delete($image->url);
            Storage::disk('public')->delete($image->thumbnail_url);

            // Store the new image
        $imageorg = $request->file('image')->store('uploads/images/GalleryImages/Images', 'public');
        $thumbnailImage = Image::make($request->file('image'))->resize(150, 150);
        $thumbnailPath = 'uploads/images/GalleryImages/thumbnails/' . basename($imageorg);
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());


            $image->url = $imageorg;
            $image->thumbnail_url = $thumbnailPath;
        }
        $image->update($request->only(['gallery_id','title', 'description','url','thumbnail_url']));
        return redirect()->route('images.index')->with('status',"Gallery Image $request->title was successfully updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GalleryImage  $gallery_image
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryImage $gallery_image)
    {
        if(Auth::user()->isAdminOrEditor()){
            $previousImagePath = $gallery_image->url;
            if ($previousImagePath) {
                Storage::disk('public')->delete($gallery_image->url);
                Storage::disk('public')->delete($gallery_image->thumbnail_url);
            }
            $gallery_image->delete();
            return redirect()->route('images.index')->with('status',"The GalleryImage is successfully deleted");
        }
        return redirect()->route('admin.index')->with('status',"You are not authorized to perform this action");
    }
}
