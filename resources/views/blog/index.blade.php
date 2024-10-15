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
</style>
@endpush
@section('content')
<div class="py-5">
    <div class="container">
        <h1 class="mb-4 text-center mb-3">Our <span class="text-primary text-uppercase">Blog</span></h1>
        <p class="mb-4 text-center">The Pakistan Kissan Rabta Committee (PKRC) is committed to empowering local farmers and ensuring sustainable agricultural practices. By advocating for equitable land distribution and the right to food sovereignty, PKRC aims to address critical issues affecting rural communities. Through various initiatives, including land redistribution and tenancy reforms, PKRC strives to enhance agricultural productivity and promote socio-economic equity. Join us in supporting our mission to create a fair and sustainable future for farmers across Pakistan.
        </p>
        <div class="row g-5">
            <div class="col-lg-9">
                @foreach($posts as $post)
                <div class="image_description mb-5">
                    <div class="image_block">
                      <img src="{{ Storage::url($post->post_image_thumbnail) }}" alt="Image 200x200">
                    </div>
                    <div class="description_block">
                      <div class="title"><a href="{{ route('blog.view',['slug'=>$post->slug]) }}">{{ $post->title }}</a></div>
                      <div class="content">{{ Str::limit($post->body, 200, '...') }}</div>
                      <div class="labels">
                        <a href="{{ route('blog.view',['slug'=>$post->slug]) }}" class="btn btn-danger text-white mb-3">Read More >></a>
                      </div>
                    </div>
                  </div>
                @endforeach
        </div>
        <div class="col-lg-3">
            <div class="sidebar-widget">
                {{-- @foreach($posts as $key=>$po) --}}
                {{-- @if($area->link==$page->url) --}}
                <?php
                    $events=get_events('');
                    $posts=get_blogs('');
                    $images=get_images('');
                ?>
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="widget-title">Recent Events</h2>
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
                            <h2 class="widget-title">Gallery Items</h2>
                            <div class="recent-post">
                                @foreach ($images as $k=>$image)
                                @if($k<5)
                                <div class="post-item">
                                    <div class="post-img">
                                        <img src="{{ Storage::url($image->thumbnail_url) }}" />
                                    </div>
                                    <div class="post-text">
                                        <a href="">{{ Str::limit($image->description, 40, '...') }}</a>
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
@endsection


