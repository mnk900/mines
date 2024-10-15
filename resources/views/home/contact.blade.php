@extends('layouts.appHome')
@section('content')
<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class=" wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title text-info text-uppercase">Contact Us</h6>
            <h1 class="mb-5"><span class="text-info text-uppercase">Contact</span> For Any Query</h1>
        </div>
        <div class="row g-4 mb-5">
            <div class="col-12">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <p class="mb-4">For inquiries, support, or more information, please contact the Pakistan Kissan Rabta Committee (PKRC). We are dedicated to empowering local farmers, advocating for equitable land distribution, and promoting sustainable agricultural practices</p>
                        <div class="row g-3 pb-4">
                            <div class="col-sm-12 wow fadeIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                                <div class="">
                                    <div class="">
                                        <h6 class="section-title text-start text-info text-uppercase text-center">Email </h6>
                                        {!! get_setting('Email') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
                                <div class="">
                                    <div class="">
                                        <h6 class="section-title text-start text-info text-uppercase">Contact </h6>
                                        {!! get_setting('Telephone') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 wow fadeIn" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;">
                                <div class="">
                                    <div class="">
                                        <h6 class="section-title text-start text-info text-uppercase">Address</h6>
                                        {!! get_setting('Address') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                        {!! get_setting('map') !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Contact End -->

@endsection
