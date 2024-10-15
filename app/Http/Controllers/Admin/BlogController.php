<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
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
        $posts=Post::where('title', 'LIKE', "%{$request->search}%")->paginate();
        }
        else{
            $posts=Auth::user()->posts()->where('title', 'LIKE', "%{$request->search}%")->paginate();
        }
        return view('admin.blog.index',['model'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.blog.create')->with(['model'=>new Post()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $imageorg = $request->file('post_image')->store('uploads/images/Post', 'public');
        $thumbnailImage = Image::make($request->file('post_image'))->resize(150, 150);
        $thumbnailPath = 'uploads/images/Post/thumbnails/' . basename($imageorg);
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
        $post = new Post();
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->excerpt = $request->input('excerpt');
        $post->body = $request->input('body');
        $post->published_at = $request->input('published_at');
        $post->post_image = $imageorg;
        $post->post_image_thumbnail = $thumbnailPath;
        Auth::user()->posts()->save($post);
        return redirect()->route('blog.index')->with('status',"Post $request->title was successfully created");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $blog)
    {
        $blog=Post::findOrFail($blog->id);
        if(Auth::user()->cant('update',$blog)){
            return redirect()->route('blog.index')->with('status',"You are not authorized to update this post");
        }
        return view('admin.blog.edit',['model'=>$blog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $blog)
    {
        $previousImagePath = $blog->post_image;
        $blog->title = $request->input('title');
        $blog->slug = $request->input('slug');
        $blog->excerpt = $request->input('excerpt');
        $blog->body = $request->input('body');
        $blog->published_at = $request->input('published_at');
        if(Auth::user()->cant('update',$blog)){
            return redirect()->route('blog.index')->with('status',"You are not authorized to update this post");
        }
        // Handle the uploaded image file if provided
        if ($request->hasFile('post_image')) {
            // Delete the old image
            Storage::disk('public')->delete('uploads/images/Post/'.$blog->post_image);
            Storage::disk('public')->delete('uploads/images/Post/thumbnails/'.$blog->post_image);

            // Store the new image
        $imageorg = $request->file('post_image')->store('uploads/images/Post', 'public');
        $thumbnailImage = Image::make($request->file('post_image'))->resize(150, 150);
        $thumbnailPath = 'uploads/images/Post/thumbnails/' . basename($imageorg);
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());
        $blog->post_image = $imageorg;
        $blog->post_image_thumbnail = $thumbnailPath;
        }
       // $blog->fill($request->only(['title','slug','body','excerpt','published_at']));
        $blog->save();
        return redirect()->route('blog.index')->with('status',"Post $blog->title was successfully updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $blog)
    {
        if(Auth::user()->cant('delete',$blog)){
            return redirect()->route('blog.index')->with('status','You do not have the permsissions to delete this post');
        }
        $previousImagePath = $blog->post_image;
            if ($previousImagePath) {
                Storage::disk('public')->delete($previousImagePath);
                Storage::disk('public')->delete($blog->post_image_thumbnail);
            }
        $blog->delete();
        return redirect()->route('blog.index')->with('status',"Post $blog->title was successfully deleted");

    }
}
