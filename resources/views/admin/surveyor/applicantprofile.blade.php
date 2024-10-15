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
                             <!-- Verify Button -->
                             <button id="firm" type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#verifyCoordinates">
                                    Surveyor Comments
                                </button>
                        </h4>
                    </div>
                    <div class="card-body user-profile">
                        <div class="row">
                        <div class="col-md-10">
                                <h5><strong>Comments By Surveyor:</strong> </h5>

                                <div class="comments-section">

                                    <ul id="CoordinatesCommentsList">
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
                        <div class="row">
                            <h3 class="section-heading">Applicant's Company/Firm Name</h3>
                            <div class="col-md-6">
                                <p><strong>Company Name:</strong> <span> {{ $data->company_name ; }}</span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>License Applied For:</strong> <span>{{ $data->licence_for;}} </span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Applied Date:</strong> <span>{{ $data->created_at; }}</span>
                                </p>
                            </div>
                         
                            <div class="col-md-6">
                                <p><strong>Site Location:</strong> <span> {{ $data->location;}} </span></p>
                            </div>



                            <div class="col-md-6">
                                <p><strong>Total Covered Area:</strong> <span> {{ $data->covered_area;}} </span></p>
                            </div>
                        


                        </div>
                    </div>
               
           

       @endforeach
        

             <div class="row">
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

                      
                </div>
            </div>
    </div>





     <!-- Verify Modal -->

     <div class="modal fade" id="verifyCoordinates" tabindex="-1" aria-labelledby="verifyCoordinatesLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="firmForm">
                            <!-- action="" method="POST" -->
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="verifyCoordinatesLabel">Verification of Coordinates</h5>
                                <button type="button" class="btn-close" data-dismiss="modal"
                                    aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                <!-- Application ID (hidden) -->
                               
                                <input type="hidden" name="application_id" value="{{ $applicantdata[0]->applicationid }}">

                                <!-- User ID (hidden) -->
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="comment_on_field" id="comment_on_field" value="coordinates">

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
</div>
     
    </div>




</section>

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



@stop

@push('scripts')

<script>
// -------------------------------- Script to insert the comment and display it to the screen using ajax request
// --------------------------------------------------------------------------------------------------------------//

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
                $('#verifyCoordinates').modal('hide');
                console.log(response);
                // Add the new comment to the comments list

                if (response.comment.comment_on_field == 'coordinates') {
                    $('#CoordinatesCommentsList').prepend(`
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


</script>
@endpush

