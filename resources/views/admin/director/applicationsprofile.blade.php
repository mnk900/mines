@extends('layouts.leaseAppAdmin')

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
</style>

@section('content')
<!-- Main content -->
<section class="content">

    <div class="container">
        <div class="clearfix blog-list">

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            @foreach ($applicantdata as $key=>$data)


            <div class="container mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Profile Information
                            <span style="font-size:13px;">
                                ( Application Status: &nbsp;@if($data->application_status == 'complete')
                                <span class="blinking-text">
                                    <button type="button"
                                        class="btn btn-primary btn-sm">{{ $data->application_status }}</button>
                                    <button></button></span>
                                @else
                                <button type="button"
                                    class="btn btn-danger btn-sm">{{ $data->application_status }}</button>
                                @endif)</span>

                        </h4>
                    </div>
                    <div class="card-body user-profile">
                        <div class="row">
                            <h3 class="section-heading">Applicant's Company/Firm Name</h3>
                            <div class="col-md-6">
                                <p><strong>Company Name:</strong> <span> {{ $data->company_name ; }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Company Address:</strong> <span>{{ $data->business_address;}} </span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Authorized Person Name:</strong> <span>{{ $data->authorize_person; }}</span>
                                </p>
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
                            <h3 class="section-heading">Organizational Address</h3>

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
                                <p><strong> Nature of Business :</strong> <span> {{ $data->nature_business; }} </span>
                                </p>
                            </div>
                            <h3 class="section-heading">Attached Company Documents</h3>
                            <div class="col-md-6">
                                <p><strong>Company/Firm Registration:</strong> <span>
                                        <a href="{{Storage::url('uploads/'.$data->firm_registration)}}"> Download </a>
                                    </span></p>
                              
                            </div>
                            <div class="col-md-6">
                                <h5><strong>Comments on Firm Registration:</strong> </h5>

                                <div class="comments-section">

                                    <ul id="firmCommentsList">
                                        @foreach ($comments as $comment)
                                        @if ($comment->comment_on_field == 'firm_registration')
                                        <li>
                                            <strong>{{ $comment->user->name }}:</strong>
                                            <span>{{ $comment->comment }}</span>
                                            <em>{{ date('d-m-Y h:i:s A', strtotime($comment->created_on)) }}</em>

                                            <span class="badge bg-info">{{ $comment->status }}</span>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Deed Partnership</strong> <span>
                                        <a href="{{Storage::url('uploads/'.$data->deed_partnership)}}">Download </a>
                                    </span></p>
                             
                            </div>
                            <div class="col-md-6">
                                <h5><strong>Comments Deed Partnerships:</strong></h5>

                                <div class="comments-section">

                                    <ul id="deedCommentsList">
                                        @foreach ($comments as $comment)
                                        @if ($comment->comment_on_field == 'deed_registration')
                                        <li>
                                            <strong>{{ $comment->user->name }}:</strong>
                                            <span>{{ $comment->comment }}</span>
                                            <em>{{ date('d-m-Y h:i:s A', strtotime($comment->created_on)) }}</em>

                                            <span class="badge bg-info">{{ $comment->status }}</span>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <h3 class="section-heading">License Category </h3>
                            <div class="col-md-6">
                                <p><strong>Name of Mineral Applied For:</strong> <span>{{ $data->name_mineral; }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Site Location:</strong> <span> {{ $data->location;}} </span></p>
                            </div>



                            <div class="col-md-6">
                                <p><strong>Total Covered Area:</strong> <span> {{ $data->covered_area;}} </span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Applicant CNIC:</strong> <span> {{ $data->name;}} </span></p>
                            </div>
                            <div class="col-md-12">
                                <p><strong>Applicant Email:</strong> <span>{{ $data->email; }} </span></p>
                            </div>


                            <hr class="invis" />


                            @if($data->challan_form)
                            @php
                            $url = asset('storage/' . $data->challan_form);
                            $fileExtension = pathinfo($data->challan_form, PATHINFO_EXTENSION);
                            @endphp
                            @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                            <div class="col-md-6">
                                <p><strong>Bank Challan :</strong> </p>
                                        <img src="{{ Storage::url($data->challan_form) }}" alt="Uploaded Image"
                                            class="img-fluid">
                                    
                            </div>
                            @else
                            <div class="col-md-6">
                                <p><strong>Bank Challan:</strong> <span>
                                        <a href="{{ asset('storage/' . $data->challan_form) }}"> Download </a> </span>
                                </p>

                             
                            </div>
                            @endif

                            <div class="col-md-6">
                                <h5><strong>Comments On Challan:</strong></h5>

                                <div class="comments-section">

                                    <ul id="challanCommentsList">
                                        @foreach ($comments as $comment)
                                        @if ($comment->comment_on_field == 'challan_fee')
                                        <li>
                                            <strong>{{ $comment->user->name }}:</strong>
                                            <span>{{ $comment->comment }}</span>
                                            <em>{{ date('d-m-Y h:i:s A', strtotime($comment->created_on)) }}</em>

                                            <span class="badge bg-info">{{ $comment->status }}</span>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>

                    <!-- Surveyor details -->
            <div class="card-body user-profile">
                <div class="row">
                    <h3 class="section-heading">Applicant's Survey Details</h3>
                     <div class="col-md-6">
                            <strong>Coordinates: </strong>
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
                                        @foreach ($coordinateData as $index => $coordinates)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $coordinates->longitude }}</td>
                                            <td>{{ $coordinates->latitude }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                         <div class="col-md-6">
                            <div id="map"></div>
                        </div>

                        <div class="col-md-12">
                                <h5><strong>Comments By Surveyor:</strong></h5>

                                <div class="comments-section">

                                    <ul id="challanCommentsList">
                                        @foreach ($comments as $comment)
                                        @if ($comment->comment_on_field == 'coordinates')
                                        <li>
                                            <strong>{{ $comment->user->name }}:</strong>
                                            <span>{{ $comment->comment }}</span>
                                            <em>{{ date('d-m-Y h:i:s A', strtotime($comment->created_on)) }}</em>

                                            <span class="badge bg-info">{{ $comment->status }}</span>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                      
                </div>
                    </div>



                    
                    <!-- Input from Director details -->
            <div class="card-body user-profile">
                <div class="row">
                    <h3 class="section-heading">Comments From Director</h3>
              
 <!-- Verify Button -->
 <button id="firm" type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#verifyFirm">
                                Add Comments
                                </button>
                        <div class="col-md-12">
                                <h5><strong>Comments By Director:</strong></h5>

                                <div class="comments-section">

                                    <ul id="challanCommentsList">
                                        @foreach ($comments as $comment)
                                     
                                        @if ($comment->comment_on_field == 'director')
                                        <li>
                                            <strong>{{ $comment->user->name }}:</strong>
                                            <span>{{ $comment->comment }}</span>
                                            <em>{{ date('d-m-Y h:i:s A', strtotime($comment->created_on)) }}</em>

                                            <span class="badge bg-info">{{ $comment->status }}</span>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                      
                </div>
                    </div>
            </div>
            </div>


            <!-- Verify Modal -->

            <div class="modal fade" id="verifyFirm" tabindex="-1" aria-labelledby="verifyFirmLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="firmForm">
                            <!-- action="" method="POST" -->
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="verifyFirmLabel">Verify Company</h5>
                                <button type="button" class="btn-close" data-dismiss="modal"
                                    aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                <!-- Application ID (hidden) -->
                                <input type="hidden" name="application_id" value="{{ $data->id }}">

                                <!-- User ID (hidden) -->
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="comment_on_field" id="comment_on_field">

                                <!-- Status Dropdown -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <!-- Assuming these are your enum values -->
                                        <option value="approved">Approved</option>
                                        <option value="pending">Pending</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>

                                <!-- Comments Box -->
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Comments</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Verify Modal End-->
            <hr class="invis" />
            @endforeach
        </div>
        <!-- end blog-list -->
    </div>

    </div>



</section>

@endsection



@push('scripts')


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
// Convert the coordinates from Blade to a JavaScript array
var coordinates = @json($coordinateData -> map(function($item) {
    return [
        $item -> latitude,
        $item -> longitude
    ];
}));

// Initialize the map
var map = L.map('map').setView([coordinates[0][0], coordinates[0][1]], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 20,
}).addTo(map);

// Create a polygon from the coordinates
var polygon = L.polygon(coordinates, {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5
}).addTo(map);

// Add a popup to the polygon
var data = <?php echo json_encode($applicantdata); ?>;
console.log(data); // This will print the entire data array
polygon.bindPopup(data[0]['company_name']+' Suggested Area For Mining of '+data[0]['licence_for']);
</script>


<script>
// Get the firm verification comments for the current application from the server
document.addEventListener('DOMContentLoaded', function() {
    // Get the buttons and the hidden input field
    const firmButton = document.getElementById('firm');
    const commentFromInput = document.getElementById('comment_on_field');

    // Add event listeners to each button
    firmButton.addEventListener('click', function() {
        commentFromInput.value = 'director';
    });
 
});

$(document).ready(function() {
    console.log("Document is ready"); // Check if document is ready
    $('#firmForm').on('submit', function(e) {
        e.preventDefault();
        console.log("Form submitted"); // Check if the form submit event is triggered
        console.log("I was here");
        let formData = $(this).serialize();
        console.log(formData); // Check if the form data is being logged correctly

        $.ajax({
            url: '{{ route("verify.firm") }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                // Close the modal
                $('#verifyFirm').modal('hide');
                console.log(response);
                // Add the new comment to the comments list

                if (response.comment.comment_on_field == 'firm_registration') {
                    $('#firmCommentsList').prepend(`
                        <li>
                            <strong>${response.user.name}:</strong> 
                            <span>${response.comment.comment}</span> 
                            <em>(${response.comment.created_on})</em>
                            <span class="badge bg-info">${response.comment.status}</span>
                        </li>
                    `);
                } else if (response.comment.comment_on_field == 'deed_registration') {
                    $('#deedCommentsList').prepend(`
                        <li>
                            <strong>${response.user.name}:</strong> 
                            <span>${response.comment.comment}</span> 
                            <em>(${response.comment.created_on})</em>
                            <span class="badge bg-info">${response.comment.status}</span>
                        </li>
                    `);
                } else {
                    $('#challanCommentsList').prepend(`
                        <li>
                            <strong>${response.user.name}:</strong> 
                            <span>${response.comment.comment}</span> 
                            <em>(${response.comment.created_on})</em>
                            <span class="badge bg-info">${response.comment.status}</span>
                        </li>
                    `);
                }

            },
            error: function(xhr, status, error) {
                console.error(xhr);
                alert('There was an error submitting your comment.');
            }
        });
    });
});


// Get the challan verification comments for the current application from the server
</script>



@endpush