
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: new google.maps.LatLng(23.874813, 90.385773),
        disableDefaultUI: true,
        styles: [
            {
                elementType: 'labels',
                stylers: [{
                    visibility: 'on'
                }]
            },
            {
                elementType: 'geometry',
                stylers: [{
                    color: '#ffffff'
                }]
            },
            {
                featureType: 'administrative.locality',
                elementType: 'labels.text.fill',
                stylers: [{
                    color: '#999999'
                }]
            },
            {
                featureType: 'poi.park',
                elementType: 'geometry',
                stylers: [{
                    color: '#ffffff'
                }]
            },
            {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{
                    color: '#ededed'
                }]
            },
            {
                featureType: 'road',
                elementType: 'geometry.stroke',
                stylers: [{
                    color: '#ffffff'
                }]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{
                    color: '#ededed'
                }]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{
                    color: '#ffffff'
                }]
            },
            {
                featureType: 'water',
                elementType: 'geometry',
                stylers: [{
                    color: '#000'
                }]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{
                    color: '#ededed'
                }]
            },
            {
                featureType: "road",
                elementType: "labels",
                stylers: [
                    { "visibility": "off" }
                ]
            }
        ]
    });
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(23.874813, 90.385773),
        map: map,
        icon: 'assets/images/marker.png',
        animation: google.maps.Animation.DROP,
    });
}
