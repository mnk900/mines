@extends('layouts.appHome')
@push('styles')
<style>
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
</style>
@endpush
@section('content')
<div class=" py-5">
    <div class="container">
    <div class="row g-5 align-items-center">
            <!-- Event Start -->
        <div class="event">
            <div class="container">
                {{-- <h6 class="section-title text-start text-primary text-uppercase">Upcming Events</h6> --}}
                <h1 class="mb-4 text-center mb-3">Our upcoming <span class="text-primary text-uppercase">Events</span></h1>
                <p class="mb-4">PKRC organizes a series of impactful events aimed at empowering farmers and advocating for agricultural reforms. These events include workshops on sustainable farming practices, forums on food sovereignty, and discussions on the critical issue of land rights. Additionally, the PKRC is hosting community gatherings to foster dialogue between farmers and policymakers, ensuring that the voices of local farmers are heard in the decision-making process. These events are designed to promote socio-economic equity, enhance agricultural productivity, and support the implementation of land redistribution and tenancy reforms, reflecting PKRC's commitment to improving the lives of rural communities in Pakistan.
                </p>
                <div class="row">
                    @foreach($events as $key=>$event)
                        <div class="col-lg-6">
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
                                            {{ Str::limit($event->eventDescription, 200, '...') }}
                                        </p>
                                        <a class="btn btn-custom text-white bg-danger" href="{{ route('events.view',['id'=>$event->id]) }}">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Event End -->
        </div>
    </div>
</div>
@endsection
