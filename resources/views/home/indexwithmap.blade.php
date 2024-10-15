@extends('layouts.appHome')
@push('styles')
    <style>
        .news_tick:hover{
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
<div id="map" style="height: 500px;"></div>
<div>
    <!-- <label><input type="checkbox" id="district" checked> District</label> -->
    <!-- <label><input type="checkbox" id="reserved" checked> Reserved Area</label> -->
    <label><input type="checkbox" id="study" checked> Study Area</label>
    <label><input type="checkbox" id="applied" checked> Applied</label>
    <label><input type="checkbox" id="extraction" checked> Extraction</label>
    <label><input type="checkbox" id="mining" checked> Mining</label> 
</div>
@endsection
@push('scripts');      
<script type="text/javascript">
    //alert("shdkashj");
    //Initialize the map
    var map = L.map('map').setView([35.5, 74.3], 19);
  
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
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 10,
}).addTo(map);


        //Parse WKT data from your PHP variables
        //var dis = ;
        var districts = @json($districts);
        var studyAreas = @json($studyAreas);
        var companyPolygons = @json($companyPolygons);
      
         // Step 3: Loop through the polygons and add to the map
         districts.forEach(area => {
            area.forEach(polygonData => {
                // Extract coordinates from the WKT format
                const coords = polygonData.geo.match(/(\d+\.\d+ \d+\.\d+)/g).map(coord => {
                    const [lng, lat] = coord.split(' ');
                    return [parseFloat(lat), parseFloat(lng)]; // Leaflet uses [lat, lng]
                });

                // Create a polygon
                const polygon = L.polygon(coords, {
                    color: 'blue', // Customize your polygon color
                    fillOpacity: 0.03,
                }).addTo(map);

                // Bind a popup with the polygon ID
                polygon.bindPopup(polygonData.polygonid);
            });
        });

        // Highlight district boundaries
        // L.geoJSON(districts, {
        //     style: { color: 'blue', weight: 2 },
        //     onEachFeature: function(feature, layer) {
        //         layer.bindPopup("District: " + feature.properties.name);
        //     }
        // }).addTo(map);

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
                const coords = polygonData.geo.match(/(\d+\.\d+ \d+\.\d+)/g).map(coord => {
                    const [lng, lat] = coord.split(' ');
                    return [parseFloat(lat), parseFloat(lng)]; // Leaflet uses [lat, lng]
                });

                // Create a polygon
                const polygon = L.polygon(coords, {
                    color: 'yellow', // Customize your polygon color
                    fillOpacity: 0.5,
                }).addTo(map);

                // Bind a popup with the polygon ID
                polygon.bindPopup(polygonData.polygonid);
            });
        });
           // L.geoJSON(studyAreas, { style: { color: 'yellow' } }).addTo(map);
        }
         if (document.getElementById('applied').checked) {
            companyPolygons.forEach(area => {
            area.forEach(polygonData => {
                // Extract coordinates from the WKT format
                console.log(polygonData.grantstatus);
                if(polygonData.grantstatus == "APPLIED"){
                    const coords = polygonData.geo.match(/(\d+\.\d+ \d+\.\d+)/g).map(coord => {
                    const [lng, lat] = coord.split(' ');
                    return [parseFloat(lat), parseFloat(lng)]; // Leaflet uses [lat, lng]
                });

                // Create a polygon
                const polygon = L.polygon(coords, {
                    color: 'green', // Customize your polygon color
                    fillOpacity: 0.7,
                }).addTo(map);
                polygon.bindPopup(polygonData.grantstatus);
                }
               
         });});}
         if (document.getElementById('extraction').checked) {
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
</script>
@endpush


