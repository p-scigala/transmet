<div class="map-google">
<div id="map-canvas1"></div>
</div>

<script defer>
var cw_lat = 53.11391907933894;
var cw_lng = 20.379523816035128;
var cw_zoom = 12;
var cw_name = "ODSZKODOWANIA EKSPERT";
var cw_address = "Długa 15,";
var cw_postalCode = " 06-500 Mława";
var styles1 = [
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#063d2d"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#1D3557"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#ffffff"
            },
            {
                "lightness": -37
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#dddddd"
            }
        ]
    },
    {
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ffffff"
            },
            {
                "weight": 2
            },
            {
                "gamma": 0.84
            }
        ]
    },
    {
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#555555"
            }
        ]
    },
    {
        "featureType": "administrative",
        "elementType": "geometry",
        "stylers": [
            {
                "weight": 0.6
            },
            {
                "color": "#0a4d3a"
            }
        ]
    },
    {
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [
            {
                "color": "#0a4d3a"
            }
        ]
    }
]
var markersData = [
  {
    lat: cw_lat,
    lng: cw_lng,
    name: cw_name,
    address1: cw_address,
    icon: '// pin icon url',
    postalCode: cw_postalCode
  }
];
function displayMarkers() {
  var bounds = new google.maps.LatLngBounds();
  for (var i = 0; i < markersData.length; i++) {
    var latlng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);
    var name = markersData[i].name;
    var address1 = markersData[i].address1;
    var icon1 = markersData[i].icon;
    var postalCode = markersData[i].postalCode;
    createMarker(latlng, name, icon1, address1, postalCode);
    bounds.extend(latlng);
  }
  // map.fitBounds(bounds);
}

function createMarker(latlng, name, icon1, address1, postalCode) {
  var marker = new google.maps.Marker({
    map: map,
    position: latlng,
    title: name,
    icon: icon1,
    postalCode:postalCode
  });

  google.maps.event.addListener(marker, 'click', function () {
    var iwContent = '<div id="iw_container">' +
      '<div class="iw_title" style="color:#222">' + name + '</div>' +
      '<div class="iw_content" style="color:#222">' + address1 + '<br />'+
      '<div class="iw_title" style="color:#222">' + postalCode + '</div>';
    infoWindow.setContent(iwContent);
    infoWindow.open(map, marker);
  });
}
function initialize() {
  var mapOptions = {
    center: new google.maps.LatLng(cw_lat, cw_lng),
    zoom: cw_zoom,
    styles: styles1,
    disableDefaultUI:true
  };

  map = new google.maps.Map(document.getElementById('map-canvas1'), mapOptions);

  infoWindow = new google.maps.InfoWindow();

  google.maps.event.addListener(map, 'click', function () {
    infoWindow.close();
  });

  displayMarkers();
}
</script>
<script defer id='mapScript' type="text/javascript"
    data-map-src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAduKMIyL0z6t47wbYgtBhCnWxkSLZ_2kQ&callback=initialize" data-loaded='false'></script>
<script defer>
const mapContainer = document.querySelector('.map-google');
const mapScript = document.querySelector('#mapScript');
const mapObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        const isIntersecting = entry.isIntersecting
        if(isIntersecting && mapScript.dataset.loaded !=='true') {
            mapScript.src = mapScript.dataset.mapSrc;
            mapScript.dataset.loaded = true
        }
    })
})
mapObserver.observe(mapContainer);
</script>
