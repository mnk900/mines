<?php

use App\Models\Post;
use App\Models\Event;
use App\Models\Setting;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\DB;

if (!function_exists('get_setting')) {
    function get_setting($key)
    {
        return Setting::where('key', $key)->value('value');
    }
}

if (!function_exists('get_events')) {
    function get_events($tags)
    {
        $wordsArray = explode(' ', $tags);
        $query = Event::query();
        foreach ($wordsArray as $tag) {
            $query->orWhere('eventTags', 'LIKE', '%' . $tag . '%');
        }
        $events = $query->get();
        return($events);
    }
}

if (!function_exists('get_blogs')) {
    function get_blogs($tags)
    {
        $wordsArray = explode(' ', $tags);
        $query = Post::query();
        foreach ($wordsArray as $tag) {
            $query->orWhere('title', 'LIKE', '%' . $tag . '%');
        }
        $posts = $query->get();
        return($posts);
    }
}

if (!function_exists('get_images')) {
    function get_images($tags)
    {
        $wordsArray = explode(' ', $tags);
        $query = GalleryImage::query();
        foreach ($wordsArray as $tag) {
            $query->orWhere('title', 'LIKE', '%' . $tag . '%');
        }
        $images = $query->get();
        return($images);
    }
}

if (!function_exists('getCompleteUserData')) {
    function getCompleteUserData() {
        $loginuser = auth()->user();
        $user_id =$loginuser->id;
        // Replace YourModel with your actual model name
        $applicantCompleteData = DB::table('users')
        ->join('lease_application_registrations', 'users.id', '=', 'lease_application_registrations.user_id')
        ->join('companies', 'lease_application_registrations.company_id', '=', 'companies.id')
        ->select('users.*','lease_application_registrations.*','companies.*','lease_application_registrations.id as applicationid')
        ->where('users.id', '=', $user_id)
        ->get();
        return $applicantCompleteData;
    }
}
