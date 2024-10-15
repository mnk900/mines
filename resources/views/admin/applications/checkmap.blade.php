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
</style>


@section('content')
<!-- Main content -->
<section class="content">

    <div class="container">
        <div class="clearfix blog-list">




            <div class="container mt-5">
                <div class="card">

                    <div class="card-body user-profile">
                        <div class="row">


                            <div class="col-md-12">
                                <strong>Coordinates: </strong>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Point</th>
                                                <th>Licence For</th>
                                                <th>District</th>
                                                <th>Company</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($polygonData as $index => $coordinates)
                                            @foreach ($coordinates as $coordinatedata)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $coordinatedata->licence }}</td>
                                                <td>{{ $coordinatedata->district }}</td>
                                                <td>{{ $coordinatedata->company }}</td>
                                                <!-- <td>{{ $coordinatedata->geo }}</td> -->
                                            </tr>
                                            @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div id="map"></div>
                            </div>
                            <!-- Form to input new polygon coordinates -->
                            <div class="col-md-12">

                                <div class="row">
                                <h3>Add a New Polygon</h3>
                                    <div class="col-md-4">
                                        <form id="polygonForm">

                                            <label for="coordinates">Enter Coordinates (lat lng pairs, comma separated):</label><br>
                                            <textarea id="coordinates" rows="10" cols="35"
                                                placeholder="e.g. 35.9 74.2, 35.9 74.3, 36 74.3, 36 74.2"></textarea><br><br>
                                            <input type="submit" value="Save Coordinates"> <button id="limitedButton"
                                                onclick="handleButtonClick()">Check Map</button>
                                            <p id="statusMessage"></p>
                                        </form>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="table-responsive">
                                            <table id="overlap-info" class="table table-bordered table-hover">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Coordinates</th>
                                                        <th>Overlap Area (sq km)</th>
                                                        <th>Overlap Percentage</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="overlap-data">
                                                    <tr>
                                                        <td colspan="3">No data available</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>


                        <hr class="invis" />






                    </div>
                </div>
            </div>
        </div>
        <hr class="invis" />

    </div>
    <!-- end blog-list -->
    </div>

    </div>



</section>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
var map = L.map('map').setView([35.92, 74.30], 10); // Set your map center

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
}).addTo(map);

// Get polygons from the controller
var polygons = @json($polygonData);

console.log('these',polygons);
// Loop through the polygon data and add each polygon to the map
polygons.forEach(function(polygonGroup, groupIndex) {
    polygonGroup.forEach(function(polygon, polygonIndex) {
        // Extract the part inside the outer parentheses of the geo property
        var coordinatesString = polygon.geo.match(/\(\(([^)]+)\)\)/)[1];

        // Split coordinates by commas, then split each coordinate by spaces
        var coordinates = coordinatesString.split(',').map(function(coord) {
            var latlng = coord.trim().split(/\s+/); // Split by any number of spaces
            console.log(latlng);
            return [parseFloat(latlng[1]), parseFloat(latlng[0])]; // Leaflet expects [lat, lng]
        });

        // Define a few specific color palettes
        var colorPalette = ['#7CF5FF', '#EE66A6', '#72BF78','#F2EED7','#7E60BF','#FF6500','#D2FF72','#87A2FF','#6A9AB0','#41B3A2'];


        // Function to pick a color from the palette
        function getColorFromPalette(index) {
            return colorPalette[index % colorPalette.length];
        }

        // Get a color from the palette for each polygon
        var color = getColorFromPalette(groupIndex + polygonIndex);
        // Generate a random color for each polygon
        //var color = getRandomColor();

        // Add polygon to the map
        L.polygon(coordinates, {
            color: color,
            fillOpacity: 0.7
        }).addTo(map);

    });
});

// Function to add a polygon dynamically
function addPolygon(coordinatesString) {
    var coordinates = coordinatesString.split(',').map(function(coord) {
        var latlng = coord.trim().split(/\s+/);
        return [parseFloat(latlng[1]), parseFloat(latlng[0])]; // [lat, lng]
    });

    var polygon = L.polygon(coordinates, {
        color: 'White', // New polygons will be red
        fillOpacity: 0.8
    }).addTo(map);


      // Zoom the map to fit the polygon's bounds
      var bounds = polygon.getBounds();  // Get the bounds of the polygon
    map.fitBounds(bounds);  // Zoom to the polygon's bounds

    // Set max bounds to restrict the map within a 20km radius
    var center = bounds.getCenter();  // Get the center of the polygon
    var radius = 20000;  // 20 km radius in meters

    // Calculate latitude and longitude changes for the 20 km radius (rough estimate)
    var latChange = radius / 111000; // Roughly 1 degree latitude = 111 km
    var lngChange = radius / (111000 * Math.cos(center.lat * Math.PI / 180)); // Longitude varies by latitude

    // Create a bounding box around the center with a 20km radius
    var maxBounds = L.latLngBounds(
        L.latLng(center.lat - latChange, center.lng - lngChange),  // South-West bound
        L.latLng(center.lat + latChange, center.lng + lngChange)   // North-East bound
    );

    // Set the max bounds on the map to lock within the 20km radius
    map.setMaxBounds(maxBounds);



        // Get the current zoom level after fitting bounds
        var currentZoom = map.getZoom();

        // Set the minimum and maximum zoom levels
        map.setMinZoom(currentZoom-2);   // Fix the zoom level to the current zoom
        map.setMaxZoom(currentZoom + 2); // Allow zooming in only by 2 levels
}

// Form submission handler
document.getElementById('polygonForm').addEventListener('submit', function(e) {
    e.preventDefault();

    var coordinates = document.getElementById('coordinates').value;
    var polygonWKT = 'POLYGON((' + coordinates + '))'; // Convert to WKT format
    if (coordinates) {
        addPolygon(coordinates);
    } else {
        alert('Please enter valid coordinates');
    }

    // Send data to the backend to check for overlap
    $.ajax({
        url: '{{ route('checkOverlap') }}', // Backend route to handle overlap check
        type: 'POST',
        data: {
            newPolygon: polygonWKT, // Send WKT string of the polygon
            _token: '{{ csrf_token() }}' // Include CSRF token
        },
        success: function(response) {

            var tableBody = $('#overlap-data'); // Get the table body element
            tableBody.empty(); // Clear the existing rows

            if (response.overlap_found) {
                // If overlap is found, populate the table with overlap data
                response.overlap_data.forEach(function(overlap) {
                    var row = `<tr>
                    <td>${overlap.intersection_polygon}</td>
                    <td>${overlap.intersection_area_in_sqkms} sq km</td>
                    <td>${overlap.intersection_percentage}%</td>
                </tr>`;
                    tableBody.append(row); // Append each row with data
                });
            } else {
                // If no overlap is found, display a message in the table
                var noOverlapRow = `<tr>
                <td colspan="3">No overlap detected</td>
            </tr>`;
                tableBody.append(noOverlapRow);
            }
        },
        error: function(xhr) {
            alert('Error checking overlap.');
        }
    });
});





/// handle check overlap button


function handleButtonClick() {
    // Make an AJAX request to the backend

    fetch("{{ route('checkoverlapbutton.click') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            // body: JSON.stringify({
            //     company_id: companyId,
            //     application_id: applicationId
            // })
        })
        .then(response => response.json())
        .then(data => {
            const button = document.getElementById('limitedButton');
            const message = document.getElementById('statusMessage');

            if (data.status === 'success') {
                message.innerText = data.message + ' You can click ' + data.clicks_left + ' more time(s).';
            } else if (data.status === 'locked') {
                message.innerText = data.message;
                button.disabled = true; // Disable the button
            }
        });
}



/// handle check overlap button
</script>
@stop


@push('scripts')
<script></script>
@endpush
