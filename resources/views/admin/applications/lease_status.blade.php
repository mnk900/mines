@extends('layouts.leaseApplications')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" />
<style>
    #map {
        height: 300px;
        width: 100%;
        margin-top: 20px;
        margin-bottom: 20px;
    }
</style>
<style>
    .card-body.user-profile h3 {
        width: 100%;
        margin-bottom: 20px;
    }

    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    .blinking-text {
        text-align: center;
        margin-top: 20%;
        font-size: 24px;
        color: green;
        animation: blink 1s infinite;
    }
</style>

<style>
    .section-heading {
        background-color: #f8f9fa;
        padding: 10px;
        border-left: 5px solid #007bff;
        margin-top: 20px;
        margin-bottom: 20px;
        font-weight: bold;
        font-size: 1.5rem;
    }

    .section-heading span {
        font-size: 1.25rem;
        color: #007bff;
    }

    .card-body p {
        margin-bottom: 10px;
    }

    .card-body a {
        color: #007bff;
        text-decoration: none;
    }

    .card-body a:hover {
        text-decoration: underline;
    }


    .notification-box {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        margin: 10px 0;
        background-color: #f8f9fa;
    }

    .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .notification-header h5 {
        margin: 0;
    }

    .notification-date {
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>

@section('content')
<!-- Main content -->
<section class="content">
            <div class="container-fluid">
                <div class="card card-olive card-outline">
                    <div class="bs-stepper">
                        <div class="card-header">
                            <div class="bs-stepper-header" role="tablist">
                                <!-- your steps here -->
                                <div class="step @if($applicantdata->challan_added==1 && $applicantdata->challan_uploaded==1) active @endif" data-target="#challan-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="challan-part" id="challan-part-trigger">
                                        <span class="bs-stepper-circle"><span class="fas fa-receipt" aria-hidden="true"></span></span>
                                        <span class="bs-stepper-label">Challan Submitted</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step @if($applicantdata->challan_added==1 && $applicantdata->challan_uploaded==1 && $applicantdata->application_status == 'complete') active @endif" data-target="#logins-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                                        <span class="bs-stepper-circle"><span class="fas fa-user" aria-hidden="true"></span></span>
                                        <span class="bs-stepper-label">Application Submitted</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#information-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                                        <span class="bs-stepper-circle"><span class="fas fa-fingerprint" aria-hidden="true"></span></span>
                                        <span class="bs-stepper-label">Employee Details</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="bs-stepper-content">
                                <!-- your steps content here -->
                                <div id="challan-part" class="content @if($applicantdata->challan_added==1 && $applicantdata->challan_uploaded==1) active @endif" role="tabpanel" aria-labelledby="challan-part-trigger">
                                    <div class="container">
                                        Challan Info here.
                                    </div>
                                </div>
                                <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                                    <div class="container">
                                        <div class="search-group form-inline">
                                            <label for="searchInput" class="mr-2">Enter CNIC No: </label>
                                            <input type="text" id="searchInput" required class="form-control col-md-4" placeholder="Search by CNIC, Personnel No">
                                            <button onclick="verify(this)" id="searchButton" class="btn btn-success mt-1 mb-2 ml-2">Search</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                    <div id="detailsContainer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</section>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="//cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>

@stop


@push('scripts')
<script>
    var stepperEl = $('.bs-stepper')[0];
    var stepper = new Stepper(stepperEl, {
    linear: true,
    animation: true
  });

  stepperEl.addEventListener('click', function (event) {
  // You can call prevent to stop the rendering of your step
  // event.preventDefault()
  stepper.to(2);
  console.warn(event)
})
</script>
@endpush