@extends('layouts.appHome')
@push('styles')
<style>
    /**********************************/
/*********** Sidebar CSS **********/
/**********************************/
.sidebar {
    position: relative;
    width: 100%;
}

@media(max-width: 991.98px) {
    .sidebar {
        margin-top: 45px;
    }
}

.sidebar .sidebar-widget {
    position: relative;
    margin-bottom: 45px;
}

.sidebar .sidebar-widget .widget-title {
    position: relative;
    margin-bottom: 30px;
    padding-bottom: 5px;
    font-size: 25px;
    font-weight: 700;
}

.sidebar .sidebar-widget .widget-title::after {
    position: absolute;
    content: "";
    width: 60px;
    height: 2px;
    bottom: 0;
    left: 0;
    background: #bc9668;
}

.sidebar .sidebar-widget .recent-post {
    position: relative;
}

.sidebar .sidebar-widget .recent-post .post-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.sidebar .sidebar-widget .recent-post .post-item .post-img {
    width: 100%;
    max-width: 80px;
}

.sidebar .sidebar-widget .recent-post .post-item .post-img img {
    width: 100%;
}

.sidebar .sidebar-widget .recent-post .post-item .post-text {
    padding-left: 15px;
}

.sidebar .sidebar-widget .recent-post .post-item .post-text a {
    font-size: 16px;
    font-weight: 600;
}
.sidebar .sidebar-widget .recent-post .post-item .post-meta {
    display: flex;
    margin-top: 8px;
}

.sidebar .sidebar-widget .recent-post .post-item .post-meta p {
    display: inline-block;
    margin: 0;
    padding: 0 3px;
    font-size: 14px;
    font-weight: 500;
    font-style: italic;
}

.sidebar .sidebar-widget .recent-post .post-item .post-meta p a {
    margin-left: 5px;
    color: #999999;
    font-size: 14px;
    font-weight: 500;
    font-style: normal;
}
</style>
@endpush
@section('content')
@foreach($areas_of_work as $key=>$area)
@if($area->link==$page->url)
 <!-- Page Header Start -->
 <div class="container-fluid page-header mb-5 p-0" style="background-image: url({{ Storage::url($area->theme_image) }});">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center pb-5">
            <h3 class="display-3 text-white mb-3 animated slideInDown">Areas of Work</h3>
            <h5 class="section-title text-white text-uppercase mb-3 animated slideInDown">{{ $area->title }}</h5>
        </div>
    </div>
</div>
@endif
@endforeach
<div class="py-5">
    <div class="container">
        <div class="row g-5">
            @foreach($areas_of_work as $key=>$area)
            @if($area->link==$page->url)
            <div class="col-lg-9">
            <h1 class="mb-4">{{ $area->title }}</h1>
            <p class="mb-4">{!! $area->description !!}</p>
            @endif
            @endforeach
            <hr>
            <h1 class="mt-4 mb-4">Other Areas </h1>
            <div class="row g4">
            @foreach($areas_of_work as $key=>$area)
            @if($area->link!=$page->url)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                <div class="room-item shadow rounded overflow-hidden">
                    <div class="position-relative text-center">
                        <img class="whatwedo-img img-fluid" src="{{ Storage::url($area->theme_image) }}" alt="">
                        <small class="position-absolute start-0 top-100 translate-middle-y bg-danger text-white rounded py-1 px-3 ms-4">Theme</small>
                    </div>
                    <div class="p-4 mt-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="text-info mb-0">{{ $area->title }}</h5>

                        </div>

                        <p class="text-body mb-3">{{ Str::limit($area->description, 175, '...') }}</p>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-sm btn-info text-white rounded py-2 px-4" href="{{ $area->link }}">View Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
</div>
        <div class="col-lg-3">
            <div class="sidebar-widget">
                @foreach($areas_of_work as $key=>$area)
                @if($area->link==$page->url)
                <?php
                    $events=get_events($area->title);
                    $posts=get_blogs($area->title);
                    $images=get_images($area->title);
                ?>
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="widget-title">Related Events</h2>
                            <div class="recent-post">
                                @foreach ($events as $k=>$event)
                                @if($k<3)
                                <div class="post-item">
                                    <div class="post-img">
                                        <img src="{{ Storage::url($event->eventImage) }}" />
                                    </div>
                                    <div class="post-text">
                                        <a href="{{ route('events.view',['id'=>$event->id]) }}">{{ Str::limit($event->eventDescription, 40, '...') }}</a>
                                        <div class="post-meta">
                                            <p>By<a href="">{{  $event->user()->first()->name }}</a></p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                <div class="">
                                    <a class="btn btn-sm btn-info text-white rounded py-2 px-4" href="/events">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <h2 class="widget-title">Related Blogs</h2>
                            <div class="recent-post">
                                @foreach ($posts as $k=>$post)
                                @if($k<3)
                                <div class="post-item">
                                    <div class="post-img">
                                        <img src="{{ Storage::url($post->post_image_thumbnail) }}" />
                                    </div>
                                    <div class="post-text">
                                        <a href="{{ route('blog.view',['slug'=>$post->slug]) }}">{{ Str::limit($post->body, 40, '...') }}</a>
                                        <div class="post-meta">
                                            <p>By<a href="">{{  $post->user()->first()->name }}</a></p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                <div class="">
                                    <a class="btn btn-sm btn-info text-white rounded py-2 px-4" href="/blog">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <h2 class="widget-title">Related Gallery</h2>
                            <div class="recent-post">
                                @foreach ($images as $k=>$image)
                                @if($k<3)
                                <div class="post-item">
                                    <div class="post-img">
                                        <img src="{{ Storage::url($image->thumbnail_url) }}" />
                                    </div>
                                    <div class="post-text">
                                        <a href="{{ route('gallery.view',['id'=>$image->gallery_id]) }}">{{ Str::limit($image->description, 40, '...') }}</a>
                                        <div class="post-meta">
                                            <p>By<a href="">{{  $image->user()->first()->name }}</a></p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                <div class="">
                                    <a class="btn btn-sm btn-info text-white rounded py-2 px-4" href="/gallery">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @endforeach
                </div>
        </div>
    </div>
</div>
</div>
<!-- Page Header End -->
@endsection


