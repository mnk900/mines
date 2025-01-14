@extends('layouts.appHome')
@push('styles')
<style>
 @media (max-width: 576px) {
 .navbar {
  height: auto !important;
 }
}

@media (min-width: 576px) {
  html,
    body {
      height: 100%;
      background: linear-gradient(to bottom, #ffffff, #f0f0f0); /* White to light gray gradient */
      overflow: hidden; /* Disable scrolling */
    }  
}

.card {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }

        .card.show {
            opacity: 1;
            transform: translateY(0);
        }

        .card {
            background-color: #f8f9fa; /* Light background for cards */
        }

        /* Optional: Card hover effect */
        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }
    
</style>
@endpush
@section('content')
<!--Showcase-->
<div class="content-wrapper">
<section id="" class="container">
    <div  class="primary-overlay">
    <div class="row">
            <!-- Card 1 -->
            <div class="col-md-4 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <p class="card-text">Process Guide Lines</p>
                        <a href="{{url('applicationprocedure')}}" target="_blank" class="btn btn-dark">More Details <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <p class="card-text">Intractive MAP</p>
                        <a href="{{url('map')}}" class="btn btn-dark">More Details <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4 mb-4">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <!-- <h5 class="card-title">Card 3</h5> -->
                        <p class="card-text">Apply for Registration</p>
                        <a href="{{route('login')}}" class="btn btn-primary">Apply</a>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-md-4 mb-4">
                <div class="card bg-olive text-white">
                    <div class="card-body">
                        <!-- <h5 class="card-title">Card 4</h5> -->
                        <p class="card-text">Mining Concession  Rules</p>
                        <a href="{{url('mcr2016')}}" target="_blank" class="btn btn-dark">More Details <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="col-md-4 mb-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <!-- <h5 class="card-title">Card 5</h5> -->
                        <p class="card-text">Lease Holders</p>
                        <a href="#" class="btn btn-dark">More Details <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="col-md-4 mb-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <!-- <h5 class="card-title">Card 6</h5> -->
                        <p class="card-text">Downloads</p>
                        <a href="#" class="btn btn-dark">More Details <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

    <!--Maps-->
    <section id="about" class="py-5 text-center bg-light d-none">
    <div class="container">
      <div class="row">
        <div class="col">

          <!--Info header-->
          <div class="info-header mb-5">
            <h1 class="text-primary pb-3">
              MINES AND MINERALS MAP GILGIT BALTISTAN
            </h1>
            <p class="lead ">
              The Mines and Minerals Map Gilgit Baltistan is a comprehensive map of the area's mineral resources,
               including the study areas, applied areas, exploration sites, mining facilities, and reserved areas.
            </p>
          </div>
          {{-- MAP GOES HERE --}}
          <div id="map" style="height: 450px;">
          <div id="leasecheckboxes">
              <!-- <label><input type="checkbox" id="district" checked> District</label> -->
              <!-- <label><input type="checkbox" id="reserved" checked> Reserved Area</label> -->
              <label><input type="checkbox" id="study" checked> Study Area</label>
              <label><input type="checkbox" id="applied" checked> Applied</label>
              <label><input type="checkbox" id="exploration" checked> Exploration</label>
              <label><input type="checkbox" id="mining" checked> Mining</label> 
          </div>
          </div>
         
          {{-- END MAP --}}
        </div>
      </div>
    </div>
  </section>

  <!--Downloads-->
  <section id="boxes" class="py-5 d-none">
    <div class="container">
        <div class="info-header mb-5">
            <h1 class="text-primary pb-3" style="text-align: center">
              Downloads
            </h1>
          </div>
      <div class="row">
        <div class="col-lg-3">
            <a href="/mcr2024" target="_blank">
          <div class="card text-center border-primary mb-resp mb-3">
            <div class="card-body">
              <span class="d-block h3 text-primary">Mineral Concession Rules 2024</span>
              <p class="text-muted">Detailed document of Mineral Concession Rules 2024</p>
            </div>
          </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="/mcr2016" target="_blank">
          <div class="card text-center bg-primary text-white mb-resp mb-3">
            <div class="card-body">
              <span class="d-block h3">Mineral Concession Rules 2016</span>
              <p>Detailed document of Mineral Concession Rules 2016</p>
            </div>
          </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="/applicationprocedure"  target="_blank">
          <div class="card text-center border-primary mb-resp mb-3">
            <div class="card-body">
              <span class="d-block h3 text-primary">Guidelines for Fresh Applicants</span>
              <p class="text-muted">Guidelines for Fresh Applicants to apply for minerals lease</p>
            </div>
          </div>
            </a>
        </div>
        <div class="col-lg-3">
            <a href="/applicationfees" target="_blank">
          <div class="card text-center bg-primary text-white mb-3">
            <div class="card-body">
              <span class="d-block h3">Fee Schedule</span>
              <p>Guidelines for various fees to be submitted during mining lease</p>
            </div>
          </div>
            </a>
        </div>
      </div>
    </div>
  </section>
</div>
  @endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
crossorigin="anonymous"></script>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            let cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('show');
                }, 300 * index); // Delay each card animation
            });
        });
    </script>
<script>
// Get the current year for the copyright
$('#year').text(new Date().getFullYear());

//Initialize scrollspy
$('body').scrollspy({target: '#main-nav'});

//Smooth scrolling
$("#main-nav a").on('click', function(event) {
  if(this.hash !== "") {
    event.preventDefault();

    const hash = this.hash;

    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 800, function() {
      window.location.hash = hash;
    });
  }
});
</script>

<!-- /////////// Maps Scripts -------------------/////////////      -->
<script type="text/javascript">
    //alert("shdkashj");
    //Initialize the map

      // Define the map bounds for Gilgit-Baltistan
      var bounds = [
        [34.0, 73.0],  // South-West corner (latitude, longitude)
        [38.5, 78.5]   // North-East corner (latitude, longitude)
    ];

    //var map = L.map('map').setView([36, 75.35], 7); // [up/down][right/left]
    // Initialize the map
    var map = L.map('map', {
        maxBounds: bounds,
        maxBoundsVisble: true, // Ensures the bounds are visible
        worldCopyJump: true // Ensures seamless panning across the world
    }).setView([36, 75.35], 7); 
  

  
    // Step 2: Initialize the Geocoder
    const geocoder = L.Control.geocoder({
            defaultMarkGeocode: true
        }).addTo(map);
          // Optional: Handle geocode results
          geocoder.on('markgeocode', function(e) {
                      const latLng = e.geocode.center;
                      L.marker(latLng).addTo(map).bindPopup(e.geocode.name).openPopup();
                      map.setView(latLng, 15);
                  });
              // Function to add polygons to the map
              function addPolygons() {
                

          // // Add a tile layer (you can choose your preferred tiles)
          //https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png

            // Define tile layers
        const topoLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 20,
            minZoom: 07,
           
        });

        const  streetsLayer= L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            maxZoom: 19,
            minZoom: 07,
        });
          //

          // Add initial tile layer
        topoLayer.addTo(map);
       
        // Change tile layer based on zoom level
        map.on('zoomend', function() {
            const currentZoom = map.getZoom();
            console.log('Current zoom level: ' + currentZoom );
            if (currentZoom >11) {
                if (map.hasLayer(topoLayer)) {
                    map.removeLayer(topoLayer);
                }
                if (!map.hasLayer(streetsLayer)) {
                    streetsLayer.addTo(map);
                }
            } else {
                if (map.hasLayer(streetsLayer)) {
                    map.removeLayer(streetsLayer);
                }
                if (!map.hasLayer(topoLayer)) {
                    topoLayer.addTo(map);
                }
            }
        });


        //Parse WKT data from your PHP variables
        //var dis = ;
        var districts = @json($districts);
        var studyAreas = @json($studyAreas);
        var companyPolygons = @json($companyPolygons);
      
         // This function displays the boundary line for each district of Gilgit Baltistan
              districts.forEach(area => {
                  area.forEach(polygonData => {
                      // Extract coordinates from the WKT format
                      const coords = polygonData.geo.match(/(\d+\.\d+ \d+\.\d+)/g).map(coord => {
                          const [lng, lat] = coord.split(' ');
                          return [parseFloat(lat), parseFloat(lng)]; // Leaflet uses [lat, lng]
                      });

                      // Create a polygon
                      const polygon = L.polygon(coords, {
                          color: '#778899', // Customize your polygon color
                          fillOpacity: 0.2,
                          weight: 2, 
                      }).addTo(map);

                      // Bind a popup with the polygon ID
                     // polygon.bindPopup(polygonData.polygonid);
                  });
              });




        // Add other polygons with different colors
        // if (document.getElementById('reserved').checked) {

        //      // Step 3: Loop through the polygons and add to the map
        //      companyPolygons.forEach(area => {
        //     area.forEach(polygonData => {
        //         // Extract coordinates from the WKT format
        //         const coords = polygonData.geo.match(/(\d+\.\d+ \d+\.\d+)/g).map(coord => {
        //             const [lng, lat] = coord.split(' ');
        //             return [parseFloat(lat), parseFloat(lng)]; // Leaflet uses [lat, lng]
        //         });

        //         // Create a polygon
        //         const polygon = L.polygon(coords, {
        //             color: 'red', // Customize your polygon color
        //             fillOpacity: 0.7,
        //         }).addTo(map);

        //         // Bind a popup with the polygon ID
        //         polygon.bindPopup(polygonData.polygonid +'---'+ polygonData.grantstatus);
        //     });
        // });
        //    // L.geoJSON(companyPolygons, { style: { color: 'green' } }).addTo(map);
        // }
        if (document.getElementById('study').checked) {

             // Step 3: Loop through the polygons and add to the map
        studyAreas.forEach(area => {
            area.forEach(polygonData => {
                // Extract coordinates from the WKT format
                const coordsstudyArea = polygonData.geo.match(/(\d+\.\d+ \d+\.\d+)/g).map(coord => {
                    const [lng, lat] = coord.split(' ');
                    return [parseFloat(lat), parseFloat(lng)]; // Leaflet uses [lat, lng]
                });

                // Create a polygon
                const polygon = L.polygon(coordsstudyArea, {
                    color: 'yellow', // Customize your polygon color
                    fillOpacity: 0.5,
                }).addTo(map);

                        
                  // Convert coordinates to [lng, lat] format for Turf.js
                  const turfCoords = coordsstudyArea.map(coord => [coord[1], coord[0]]);
                  const turfPolygon = turf.polygon([turfCoords]);

                  // Calculate area in square meters
                  const areaInSquareMeters = turf.area(turfPolygon);

                  // Format area for display (e.g., convert to sqkms)
                  const areaInSqkms = areaInSquareMeters / 1000000; // Convert to hectares if needed

                  // Bind a popup with the polygon ID and area
                  polygon.bindPopup(`<b>Study Area Name:</b> ${polygonData.polygonid}<br><b>Area:</b> ${areaInSqkms.toFixed(2)} sqkms`);
                      });
             });
           // L.geoJSON(studyAreas, { style: { color: 'yellow' } }).addTo(map);
        }

         if (document.getElementById('applied').checked) {
            companyPolygons.forEach(area => {
            area.forEach(polygonData => {
                // Extract coordinates from the WKT format
                console.log(polygonData);
                if(polygonData.grantstatus == "APPLIED"){
                    const coordsApplied = polygonData.geo.match(/(\d+\.\d+ \d+\.\d+)/g).map(coord => {
                    const [lng, lat] = coord.split(' ');
                    return [parseFloat(lat), parseFloat(lng)]; // Leaflet uses [lat, lng]
                });

                // Create a polygon
                const polygon = L.polygon(coordsApplied, {
                    color: 'green', // Customize your polygon color
                    fillOpacity: 0.7,
                }).addTo(map);
                polygon.bindPopup(polygonData.grantstatus);

                    // Convert coordinates to [lng, lat] format for Turf.js
                  const turfCoordsApplied = coordsApplied.map(coord => [coord[1], coord[0]]);
                  const turfPolygonApplied = turf.polygon([turfCoordsApplied]);

                  // Calculate area in square meters
                  const areaInSquareMetersApplied = turf.area(turfPolygonApplied);

                  // Format area for display (e.g., convert to sqkms)
                  const areaInSqkmsApplied = areaInSquareMetersApplied / 1000000; // Convert to hectares if needed

                  // Bind a popup with the polygon ID and area
                  polygon.bindPopup(`<b>Applied Lease For:</b> ${polygonData.polygonid}<br><b>Area:</b> ${areaInSqkmsApplied.toFixed(2)} sqkms`);
                          
                }
               
            });
          });
      }
         if (document.getElementById('exploration').checked) {
            companyPolygons.forEach(area => {
            area.forEach(polygonData => {
                // Extract coordinates from the WKT format
                console.log(polygonData.grantstatus);
                if(polygonData.grantstatus == "EXPLORATION"){
                    const coords = polygonData.geo.match(/(\d+\.\d+ \d+\.\d+)/g).map(coord => {
                    const [lng, lat] = coord.split(' ');
                    return [parseFloat(lat), parseFloat(lng)]; // Leaflet uses [lat, lng]
                });

                // Create a polygon
                const polygon = L.polygon(coords, {
                    color: 'pink', // Customize your polygon color
                    fillOpacity: 0.7,
                }).addTo(map);
                polygon.bindPopup(polygonData.grantstatus);
                }
               
         });});}
        // if (document.getElementById('mining').checked) {
        //     L.geoJSON(companyPolygons.mining, { style: { color: 'purple' } }).addTo(map);
        // }

        if (document.getElementById('mining').checked) {
            companyPolygons.forEach(area => {
            area.forEach(polygonData => {
                // Extract coordinates from the WKT format
                console.log(polygonData.grantstatus);
                if(polygonData.grantstatus == "MINING"){
                    const coords = polygonData.geo.match(/(\d+\.\d+ \d+\.\d+)/g).map(coord => {
                    const [lng, lat] = coord.split(' ');
                    return [parseFloat(lat), parseFloat(lng)]; // Leaflet uses [lat, lng]
                });

                // Create a polygon
                const polygon = L.polygon(coords, {
                    color: 'orange', // Customize your polygon color
                    fillOpacity: 0.7,
                }).addTo(map);
                polygon.bindPopup(polygonData.grantstatus);
                }
               
         });});}
    }

    // Add event listeners to checkboxes
    document.querySelectorAll('input[type=checkbox]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            // Clear existing layers and re-add based on checked states
            map.eachLayer(function(layer) {
                map.removeLayer(layer);
            });
            addPolygons();
        });
    });

    addPolygons(); // Initial call to add polygons


 //// script to open download files
 ///////////////////////////////////////////////////
 
        // Function to open the Word document in a new window
        function openDoc2024() {
            window.open('{{ url('/view-mcr2024') }}', '_blank', 'width=800,height=600');
        }

        function openDoc2016() {
            window.open('{{ url('/view-mcr2016') }}', '_blank', 'width=800,height=600');
        }
        function openDocFresh() {
            window.open('{{ url('/view-fresh') }}', '_blank', 'width=800,height=600');
        }


       
    </script>


@endpush


