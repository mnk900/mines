@extends('layouts.appHome')
@section('content')
<!-- Carousel Start -->
         <!-- About Start -->
         <div class=" py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-12">
                        <h1 class="mb-4">{{  $page->title }} </h1>
                        <p class="mb-4">{{ $page->content }} </p>
                        <div class="row g-3 pb-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
        <!-- Team End -->
@endsection


