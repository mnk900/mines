@extends('layouts.leaseApplications')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
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

<script type="text/javascript">
        // Function to open the Word document in a new window
        function openDoc() {
            window.open('{{ url('/view-procedure') }}', '_blank', 'width=800,height=600');
        }

        // Automatically open the document on page load
        window.onload = function() {
            openDoc();
        };
    </script>

@section('content')
  <!-- Main content -->
  <section class="content">

<div class="container">
    <div class="clearfix blog-list">

        @foreach ($applicantdata as $key=>$data)


        <div class="container mt-5">
            {{-- <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Application Details:
                        <span style="font-size:13px;">
                            ( Application Status: &nbsp;@if($data->application_status == 'complete')
                            <span class="blinking-text">
                                <button type="button"
                                    class="btn btn-primary btn-sm">{{ $data->application_status }}</button>
                                <button></button></span>
                            @else
                            <button type="button" class="btn btn-danger btn-sm">{{ $data->application_status }}</button>
                            @endif)</span>

                                          </h4>

                                          <span> <button onclick="openDoc()" class="btn btn-primary btn-lg active float-right btn-sm">Application Procedures</button></span>

                </div>
                <div class="card-body user-profile">
                    <div class="row">
                        <h3 class="section-heading"> Company/Firm Details</h3>
                        <div class="col-md-6">
                            <p><strong>Company Name:</strong> <span> {{ $data->company_name ; }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Company Address:</strong> <span>{{ $data->business_address;}} </span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Authorized Person Name:</strong> <span>{{ $data->authorize_person; }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Designation:</strong> <span> {{ $data->designation ; }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Phone Number:</strong> <span> {{ $data->office_no ; }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Company Cell no:</strong> <span>{{ $data->cell_no ; }} </span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Applicant Email:</strong> <span>{{ $data->email ; }} </span></p>
                        </div>
                        <h3 class="section-heading">Company/Firm Address</h3>

                        <div class="col-md-6">
                            <p><strong>Business Address:</strong> <span> {{ $data->business_address; }} </span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>NTN No:</strong> <span>{{ $data->ntn_no;}} </span></p>
                        </div>

                        <div class="col-md-6">
                            <p><strong>GST No:</strong> <span> {{$data->gst_no ;}} </span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong> Nature of Business :</strong> <span> {{ $data->nature_business; }} </span></p>
                        </div>
                        <h3 class="section-heading">Attached Company Documents</h3>
                        <div class="col-md-6">
                            <p><strong>Company/Firm Registration:</strong> <span>
                                    <a href="{{Storage::url('uploads/'.$data->firm_registration)}}"> View Company/Firm Registration </a> </span></p>
                                            </div>
                        <div class="col-md-6">
                            <p><strong>Deed Partnership</strong> <span>
                                    <a href="{{Storage::url('uploads/'.$data->deed_partnership)}}">View Deed Partnership </a> </span></p>






</div>

    <!-- End notification -->
                                </div>



                        <h3 class="section-heading">License Category </h3>
                        <div class="col-md-6">
                            <p><strong>Name of Mineral Applied For:</strong> <span>{{ $data->name_mineral; }} </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Site Location:</strong> <span> {{ $data->location;}} </span></p>
                        </div>

                        <div class="col-md-6">
                            <strong>Coordinates: </strong>
                            <p class="text-danger">Add Coordinates option will be availabe when your challan is verified by the department. </p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Point</th>
                                            <th>Longitude</th>
                                            <th>Latitude</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($coordinatedata && $coordinatedata->isNotEmpty())
                                    @foreach ($coordinatedata as $index => $coordinates)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $coordinates->longitude }}</td>
                                            <td>{{ $coordinates->latitude }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3">No coordinates data available</td>
                                    </tr>
                                @endif
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div id="map"></div>
                        </div>

                        <div class="col-md-6">
                            <p><strong>Total Covered Area:</strong> <span> {{ $data->covered_area;}} </span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Applicant CNIC:</strong> <span> {{ $data->name;}} </span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Applicant Email:</strong> <span>{{ $data->email; }} </span></p>
                        </div> --}}


                        <hr class="invis" />


                        @if($data->challan_form)
                        @php
                        $url = asset('storage/' . $data->challan_form);
                        $fileExtension = pathinfo($data->challan_form, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                        <div class="col-md-6">
                        <p><strong>Your Challan:</strong> </p>
                        <img src="{{ Storage::url($data->challan_form) }}" alt="Uploaded Image" class="img-fluid">
                       </div>
                        @elseif(in_array($fileExtension, ['pdf']))
                        <div class="col-md-6">
                        <p><strong>Your Challan:</strong> </p>
                        <iframe src="{{ Storage::url($data->challan_form)}}" width="100%" height="300px">
                          This browser does not support PDFs. Please download the PDF to view it: <a href="{{ Storage::url($data->challan_form) }}">Download PDF</a>.
                     </iframe></div>
                        @else
                        <div class="col-md-6">
                            <p><strong>Challan Form:</strong> <span>
                                    <a href="{{Storage::url($data->challan_form) }}"> Download </a> </span></p>
                        </div>
                        @endif




                        @endif

                        <h3 class="section-heading">Upload Challan Form </h3>


                        <form action="{{ route('uploadchallan') }}" method="POST" enctype="multipart/form-data"
                            style="width:80%; margin:auto">
                            @csrf



                            <div class="row">
                                <div class="col-md-4">
                                    <p>Upload Deposited Challan Form: </p>
                                </div>


                            <div class="col-md-5">

                                <input id="challan_form" type="file" name="challan_form"
                                    value="{{ old('challan_form') }}"
                                    class="form-control @error('challan_form') is-invalid @enderror" required
                                    placeholder="Enter Your Deposited Challan form">
                                <input id="application_id" name="application_id" type="hidden"
                                    value="{{$data->application_id}}">
                                <input id="name" name="name" type="hidden" value="{{$data->name}}">
                            </div>
                            <div class="col-md-3">
                            <button type="submit" class="btn btn-primary ">Confirm Upload</button>
                            </div>




                        </div>

                    </div>


                    </form>

{{--
                    <h3 class="section-heading">Add Your Site Coordinates</h3>


                            <div class="col-md-3">
                            <a  href="{{ route('addcoordinates',['appid' => $appid, 'districtid' => $data->District_id]) }}"  class="btn btn-primary ">Add Coordinates</a>
                            </div> --}}

                </div>
            </div>
        </div>
    </div>
    <hr class="invis" />
    @endforeach
</div>
<!-- end blog-list -->


</div>

</div>



</section>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

@if($coordinatedata && $coordinatedata->isNotEmpty())
<script>
// Convert the coordinates from Blade to a JavaScript array
var coordinates = @json($coordinatedata -> map(function($item) {
    return [
        $item -> latitude,
        $item -> longitude
    ];
}));

// Initialize the map
var map = L.map('map').setView([coordinates[0][0], coordinates[0][1]], 15);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 12,
}).addTo(map);

// Create a polygon from the coordinates
var polygon = L.polygon(coordinates, {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5
}).addTo(map);

// Add a popup to the polygon
polygon.bindPopup('Polygon Area');
</script>

@else
<script>

            // Initialize the map
var map = L.map('map').setView(['35.920834','74.308334'], 15);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 12,
}).addTo(map);
var message = "No coordinate data available to draw the map.";
        L.popup()
            .setLatLng(map.getCenter())
            .setContent(message)
            .openOn(map);


    </script>
@endif



@stop


@push('scripts')
<script></script>
@endpush
