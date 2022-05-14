var $map = $('#map-default'),
    map,
    lat,
    lng,
    color = "#5e72e4";

function initMap() {
    map = document.getElementById('map-default');
    // lat = map.getAttribute('data-lat');
    lat = 4.60971;
    // lng = map.getAttribute('data-lng');
    lng = -74.08175;

    map = new google.maps.Map(document.getElementById('map-default'), {
        zoom: 12,
        scrollwheel: true,
        center: new google.maps.LatLng(4.60971, -74.08175),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    });

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(4.60971, -74.08175),
        map: map,
        animation: google.maps.Animation.DROP,
        // title: 'Marcador',
        draggable: true
    });

    var infowindow = new google.maps.InfoWindow({
        content: String(marker.getPosition())
    });

    google.maps.event.addListener(marker, 'click', function(evt) {
        infowindow.open(map, marker); 
    });

    google.maps.event.addListener(marker, 'dragend', function(evt){
        $("#lat").val(evt.latLng.lat().toFixed(6));
        $("#lng").val(evt.latLng.lng().toFixed(6));

        map.panTo(evt.latLng);
    });

    map.setCenter(marker.position);

    marker.setMap(map);
}

if($map.length) {
    google.maps.event.addDomListener(window, 'load', initMap);
}   