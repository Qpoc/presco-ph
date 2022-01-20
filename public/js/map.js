$(document).ready(function () { 
    $(".pin-address").unbind("click").on("click", function(e){
        viewMap();
    });

    function viewMap() {
        mapboxgl.accessToken = 'pk.eyJ1Ijoia3Vwb2MiLCJhIjoiY2txdTlzaWxmMDJrNjJ3dDk2OXkwN3gxNCJ9.S5PnZaGfMfKwlF7OXiht4w';
        // var coordinates = document.getElementById('coordinates');
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [120.9809674, 14.5907332],
            zoom: 15
        });

        $('#pinAddress').on('shown.bs.modal', function() {
            map.resize();
        });
    
        var marker = new mapboxgl.Marker({
            draggable: true
        })
            .setLngLat([120.9809674, 14.5907332])
            .addTo(map);
    
        function onDragEnd() {
            var lngLat = marker.getLngLat();
            // coordinates.style.display = 'block';
            // coordinates.innerHTML = 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "https://us1.locationiq.com/v1/reverse.php?key=pk.d88d529910dc274215d4880e78558a0e&lat=" + lngLat.lat + "&lon=" + lngLat.lng + "&format=json", true);
            xhr.onload = function () {
                if (this.status == 200) {
    
                    var data = JSON.parse(this.responseText);
                    console.log(data);
                    document.getElementById("addressField").value = data.display_name;
                    // document.getElementById('longitude').value = lngLat.lng;
                    // document.getElementById('latitude').value = lngLat.lat;
                }
            }
            xhr.send();
        }
    
    
        var lngLat = marker.getLngLat();
        // coordinates.style.display = 'block';
        // coordinates.innerHTML = 'Longitude: ' + lngLat.lng + '<br/>Latitude: ' + lngLat.lat;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "https://us1.locationiq.com/v1/reverse.php?key=pk.d88d529910dc274215d4880e78558a0e&lat=" + lngLat.lat + "&lon=" + lngLat.lng + "&format=json", true);
        xhr.onload = function () {
            if (this.status == 200) {
    
                var data = JSON.parse(this.responseText);
                console.log(data);
    
                document.getElementById("addressField").value = data.display_name;
                // document.getElementById('longitude').value = lngLat.lng;
                // document.getElementById('latitude').value = lngLat.lat;
            }
        }
        xhr.send();
        searchAddress(map, marker);
        marker.on('dragend', onDragEnd);
    
        map.on('idle', function () {
            map.resize()
        })
    
        // document.getElementById('mapWrapper').style.display = 'block';
    }
    
    function searchAddress(map, marker) {
    
        var geocoder = new MapboxGeocoder({
            // Initialize the geocoder
            accessToken: mapboxgl.accessToken, // Set the access token
            placeholder: 'Search or drag the pointer', // Placeholder text for the search bar
            bbox: [120.761717655071,
                14.349279656227,
                121.131416898506,
                14.7813118777518]
        });
    
        // After the map style has loaded on the page,
        // add a source layer and default styling for a single point
        map.on('load', function () {
    
            // Listen for the `result` event from the Geocoder // `result` event is triggered when a user makes a selection
            //  Add a marker at the result's coordinates
            geocoder.on('result', function (e) {
                console.log(e);
                marker.setLngLat([e.result.geometry.coordinates[0], e.result.geometry.coordinates[1]]);
                var xhr = new XMLHttpRequest();
                var lngLat = marker.getLngLat();
                xhr.open("GET", "https://us1.locationiq.com/v1/reverse.php?key=pk.d88d529910dc274215d4880e78558a0e&lat=" + lngLat.lat + "&lon=" + lngLat.lng + "&format=json", true);
                xhr.onload = function () {
                    if (this.status == 200) {
    
                        var data = JSON.parse(this.responseText);
    
                        document.getElementById("addressField").value = data.display_name;
                        document.getElementById('longitude').value = lngLat.lng;
                        document.getElementById('latitude').value = lngLat.lat;
                    }
                }
                xhr.send();
            });
        });
    
        // Add the geocoder to the map
        map.addControl(geocoder);
    }
});
