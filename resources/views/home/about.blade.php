@extends('layouts.appHome')
@section('content')
 <!-- About Start -->
        <!-- About Start -->
        <div class=" py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        {!! get_setting('About') !!}
                        <p class="mb-4">{{ $about[0]->description }} </p>
                        <div class="row g-3 pb-4">
                            {!! get_setting('Countries') !!}
                            {!! get_setting('Volunteers') !!}
                            {!! get_setting('Community') !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="{{ Storage::url($images[0]->thumbnail_url) }}" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="{{ Storage::url($images[1]->thumbnail_url) }}">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="{{ Storage::url($images[2]->thumbnail_url) }}">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="{{ Storage::url($images[3]->thumbnail_url) }}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h3 class="">Our <span class="text-primary text-uppercase">Mission</span></h3>
                    <p class="mt-1">{{ $about[0]->mission }} </p>
                    <h3 class="">Our <span class="text-primary text-uppercase">Vision</span></h3>
                    <p class="mt-1">{{ $about[0]->vision }} </p>
                    <h3 class="">Our <span class="text-primary text-uppercase">History</span></h3>
                    <p class="mt-1">{{ $about[0]->history }} </p>
                </div>
            </div>
        </div>
        <!-- About End -->
        <!-- About End -->
@endsection


