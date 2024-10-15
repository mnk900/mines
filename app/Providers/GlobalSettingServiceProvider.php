<?php

namespace App\Providers;

use App\Models\About;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Setting;
use App\Models\AreasOfWork;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GlobalSettingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $about=About::get();
        $images=GalleryImage::get();
        $events=Event::get();
        $gallery=Gallery::join('images', 'galleries.id', '=', 'images.gallery_id')
        ->select('galleries.id as gallery_id','images.id', 'images.title', 'images.description', 'images.url', 'images.thumbnail_url', 'galleries.title as name','galleries.description as content')
        ->get();
        $gallery_images=[];
        foreach ($gallery as $item) {
                $gallery_images[$item->gallery_id][] = [
                "gallery_id" => $item->gallery_id,
                "id" => $item->id,
                "title" => $item->title,
                "description" => $item->description,
                "url" => $item->url,
                "thumbnail_url" => $item->thumbnail_url,
                "name" => $item->name,
                "content" => $item->content
            ];
        }
        $partners=Partner::get();
        $areas_of_work=AreasOfWork::get();
        // Fetch the site setting from the database
        $site_setting = Setting::where('key', 'Logo')->first();

        // Share the site setting with all views
        View::share(['gallery_images'=>$gallery_images,'site_setting'=> $site_setting,'about'=>$about,'images'=>$images,'events'=>$events,'areas_of_work'=>$areas_of_work,'partners'=>$partners]);
    }
}
