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

.image_description{
   width:100%;
   height: auto;
  display:block;
  float:left;
  /* transition: box-shadow 0.3s; */
   border-bottom:1px solid #bc9668;
  /*background-color: #F8F8F8; */
  margin:0;
  padding:0;
  /* box-shadow: 0 4px 6px 0 rgba(0,0,0,0.2);
  -moz-box-shadow: 0 4px 6px 0 rgba(0,0,0,0.2);
  -webkit-box-shadow: 0 4px 6px 0 rgba(0,0,0,0.2); */
}
/* .image_description:hover{
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.5);
  -moz-box-shadow: 0 4px 8px 0 rgba(0,0,0,0.5);
  -webkit-box-shadow: 0 4px 8px 0 rgba(0,0,0,0.5);
} */
.image_block{
  float:left;
  margin: 0;
  /* width: 35%; */
  /*height: 200px;
  border: 1px solid #ddd;
  background: gray;*/
}
.image_block img{
  /* width:200px;
  height:200px; */
  /*height: -webkit-fill-available;*/
  margin:8px;
  margin-top: 0px;
}
.description_block{
  /* float:left;
  width: 65%; */
  margin: 0;
  /* padding:20px 15px; */
 display: block;
}
.title{
  font-size:18px;
  line-height:24px;
  font-weight:bold;
  margin-bottom:10px;
}
.content{
  margin:0 0 20px 0;
  line-height:26px;
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  line-height: 20px;
  max-height: 80px;
  -webkit-line-clamp: 4;
  -webkit-box-orient: vertical;
}
/* .labels span{
  float:left;
  color:green;
  font-weight:bold;
  cursor:pointer;
} */
.labels a{
  /* color:red; */
  float: right;
  /* font-weight:bold;
  text-decoration:none; */
}
.credits{
    display: inline-block;
    margin: 0;
    padding: 0 3px;
    font-size: 14px;
    font-weight: 500;
    font-style: italic;
}
.owl-prev, .owl-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #FFFFFF;
            border: 1px solid #ccc;
            padding: 5px 10px;
            cursor: pointer;
            background: var(--primary);
        }
        .owl-prev {
            left: -25px;
        }
        .owl-next {
            right: -25px;
        }
</style>
@endpush
@section('content')
<div class="container-fluid page-header mb-5 p-0" style="background-image: url({{ Storage::url($post->post_image) }});">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center pb-5">
            <h3 class="display-3 text-white mb-3 animated slideInDown">Blog</h3>
            <h5 class="section-title text-white text-uppercase mb-3 animated slideInDown">{{ $post->title }}</h5>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-9">
                    <h1 class="mb-2">{{ $post->title }}</h1>
                    <span class="credits mb-3">Published by {{ $post->user->name }} on {{ $post->present()->publishedDate }}</span>
                    <p class="mb-4">{!! $post->body !!}</p>
                    <hr>
            <h1 class="mt-4 mb-4">Other Posts </h1>
            <div class="row">
                <div class="owl-carousel" id="carousel">
                <?php $posts=get_blogs(''); ?>
                @foreach($posts as $key=>$other_post)
                 @if($other_post->slug!=$post->slug)
                    <div class="item">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative text-center">
                                <img class="whatwedo-img img-fluid" src="{{ Storage::url($other_post->post_image) }}" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-danger text-white rounded py-1 px-3 ms-4">Published on {{ $other_post->present()->publishedDate }}</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="text-info mb-0">{{ $other_post->title }}</h5>

                                </div>

                                <p class="text-body mb-3">{{ Str::limit($other_post->body, 120, '...') }}</p>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-info text-white rounded py-2 px-4" href="">View Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                 @endif
                @endforeach
            </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="sidebar-widget">
                {{-- @foreach($posts as $key=>$po) --}}
                {{-- @if($area->link==$page->url) --}}
                <?php
                    $events=get_events($post->title);
                    $images=get_images($post->title);
                ?>
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="widget-title">Similar Events</h2>
                            <div class="recent-post">
                                @foreach ($events as $k=>$event)
                                @if($k<5)
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
                            <h2 class="widget-title">Similar Gallery</h2>
                            <div class="recent-post">
                                @foreach ($images as $k=>$image)
                                @if($k<5)
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
                {{-- @endif --}}
                {{-- @endforeach --}}
                </div>
        </div>
    </div>
</div>
</div>
<!-- Page Header End -->
@push('scripts')
<script type="text/javascript">
        $("#carousel").owlCarousel({
            items: 3, // This sets the number of items per slide
            loop: true,
            nav:true,
            navText: ["<", ">"],
            responsive: {
                    0: {
                        items: 1 // Number of items to display on small screens
                    },
                    600: {
                        items: 2 // Number of items to display on medium screens
                    },
                    1000: {
                        items: 3 // Number of items to display on large screens
                    }
                }
        });
</script>
@endpush
@endsection


