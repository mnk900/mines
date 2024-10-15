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
/**********************************/
/*********** Events CSS **********/
/**********************************/
    .event {
    position: relative;
    width: 100%;
    padding: 45px 0 15px 0;
}
    .event .event-item {
    margin-bottom: 30px;
    background: #f3f6ff;
}
.event .event-item img {
    width: 100%;
    height: 400px;
}
.event .event-content {
    padding: 30px;
    display: flex;
}
.event .event-meta {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}
.event .event-meta p {
    position: relative;
    margin-bottom: 8px;
    padding-bottom: 8px;
    white-space: nowrap;
    border-bottom: 1px solid rgba(0, 0, 0, .15);
}
.event .event-meta i {
    color: #4a4c70;
    width: 25px;
}
.event .event-text {
    position: relative;
    margin-left: 20px;
    padding-left: 20px;
}
.event .event-text h3 {
    font-size: 25px;
    font-weight: 700;
    margin-bottom: 10px;
}
.event .event-text p {
    margin: 0;
    height: 100px;
    overflow: overlay;
}
.event .btn.btn-custom {
    margin-top: 20px;
    padding: 8px 30px;
}
/**********************************/
/*********** Slider CSS **********/
/**********************************/
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
<div class=" py-5">
    <div class="container">
    <div class="row g-5 align-items-center">
            <!-- Event Start -->
        <div class="event">
            <div class="container">
                {{-- <h6 class="section-title text-start text-primary text-uppercase">Upcming Events</h6>
                <h1 class="mb-4 text-center mb-3">Our upcoming <span class="text-primary text-uppercase">Events</span></h1>
                <p class="mb-4">PKRC organizes a series of impactful events aimed at empowering farmers and advocating for agricultural reforms. These events include workshops on sustainable farming practices, forums on food sovereignty, and discussions on the critical issue of land rights. Additionally, the PKRC is hosting community gatherings to foster dialogue between farmers and policymakers, ensuring that the voices of local farmers are heard in the decision-making process. These events are designed to promote socio-economic equity, enhance agricultural productivity, and support the implementation of land redistribution and tenancy reforms, reflecting PKRC's commitment to improving the lives of rural communities in Pakistan.
                </p> --}}
                <div class="row">
                        <div class="col-lg-9">
                            <div class="event-item">
                                <img src="{{ Storage::url($event->eventImage) }}" alt="Image">
                                <div class="event-content bg-info">
                                    <div class="event-meta text-white">
                                        <p><i class="fa fa-calendar-alt text-white"></i>{{ $event->present()->eventDate }}</p>
                                        <p><i class="far fa-clock text-white"></i>{{ $event->eventTime }}</p>
                                        <p><i class="fa fa-map-marker-alt text-white"></i>{{ $event->eventLocation }}</p>
                                    </div>
                                    <div class="event-text text-white">
                                        <h3 class="text-white">{{ $event->eventName }}</h3>
                                        <p>
                                            {{ $event->eventDescription }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-4 mb-4">Other Events </h1>
            <div class="row">
                <div class="owl-carousel" id="carousel">
                <?php $events=get_events(''); ?>
                @foreach($events as $key=>$other_event)
                 @if($other_event->id!=$event->id)
                    <div class="item">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative text-center">
                                <img class="whatwedo-img img-fluid" src="{{ Storage::url($other_event->eventImage) }}" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-danger text-white rounded py-1 px-3 ms-4">On {{ $other_event->present()->eventDate }}</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="text-info mb-0">{{ Str::limit($other_event->eventName, 18, '...') }}</h5>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-info text-white rounded py-2 px-4" href="{{ route('events.view',['id'=>$other_event->id]) }}">View Detail</a>
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
                                <?php
                                    $posts=get_blogs($event->eventName);
                                    $images=get_images($event->eventName);
                                ?>
                                    <div class="sidebar">
                                        <div class="sidebar-widget">
                                            <h2 class="widget-title">Similar Blogs</h2>
                                            <div class="recent-post">
                                                @foreach ($posts as $k=>$post)
                                                @if($k<4)
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
                                            <h2 class="widget-title">Similar Gallery</h2>
                                            <div class="recent-post">
                                                @foreach ($images as $k=>$image)
                                                @if($k<4)
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
        <!-- Event End -->
        </div>
    </div>
</div>
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
