@extends('layouts.app')
@section('header')
<style>
    .links-margin{margin:3px;}
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
       #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Search Result</div>

                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="map" style=" width: 100%; height: 500px;"></div>
                            </div>
                        </div>
                    </div>

                    <div id="map"></div>
                    <script>

                    function initMap() {

                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 5,
                            center: {lat: 9.0820, lng: 8.6753}
                        });

                        var infoWin = new google.maps.InfoWindow();
                        // Add some markers to the map.
                        // Note: The code uses the JavaScript Array.prototype.map() method to
                        // create an array of markers based on a given "locations" array.
                        // The map() method here has nothing to do with the Google Maps API.
                        var markers = locations.map(function(location, i) {
                        var marker = new google.maps.Marker({
                            position: location
                        });
                        google.maps.event.addListener(marker, 'click', function(evt) {
                            infoWin.setContent(location.info);
                            infoWin.open(map, marker);
                        })
                        return marker;
                        });

                        // markerCluster.setMarkers(markers);
                        // Add a marker clusterer to manage the markers.
                        var markerCluster = new MarkerClusterer(map, markers, {
                            imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
                        });

                    }

                    var locations = <?php echo json_encode($data_points, JSON_NUMERIC_CHECK); ?>

                    google.maps.event.addDomListener(window, "load", initMap);

                    </script>
                    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
                    </script>
                    <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBe-RmhBRkRcquAMNv2mKZJ6iA81pX6_Dw&callback=initMap">
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection