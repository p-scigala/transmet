<script
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo acf_get_setting('google_api_key'); ?>&callback=googleMapsCallback"
    async defer></script>
<script defer>
  class GMap {
        constructor(element) {
            this.element = element
            this.map = null
            this.mapMarkers = []
            this.markerIcon = "<?php echo get_template_directory_uri() . '/assets/images/pin.svg'; ?>"
            this.disableDefaultUI = true
            this.mapStyles = [
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f7f7f7"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f7f7f7"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e5e5e5"
                        },

                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e5e5e5"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e5e5e5"
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
                            "color": "#e5e5e5"
                        }
                    ]
                }
            ]
        }

        readMarkers() {
            // TODO replace the selector if you've changed it in the markup
            this.element.querySelectorAll('.my-map__marker').forEach((markerElement) => {
                let lat = markerElement.dataset.hasOwnProperty('lat') ?
                    markerElement.dataset['lat'] :
                    0
                let lng = markerElement.dataset.hasOwnProperty('lng') ?
                    markerElement.dataset['lng'] :
                    0
                let name = markerElement.dataset.hasOwnProperty('name') ?
                    markerElement.dataset['name'] :
                    ''
                let street = markerElement.dataset.hasOwnProperty('street') ?
                    markerElement.dataset['street'] :
                    ''
                let city = markerElement.dataset.hasOwnProperty('city') ?
                    markerElement.dataset['city'] :
                    ''

                this.mapMarkers.push({

                    lat: parseFloat(lat),
                    lng: parseFloat(lng),
                    name: name || '',
                    street: street || '',
                    city: city || '',
                })

                markerElement.remove()
            })
        }

        createMap() {
            let mapArgs = {
                zoom: parseInt(this.element.dataset.hasOwnProperty('zoom') ?
                    this.element.dataset['zoom'] :
                    16),
                mapTypeId: window.google.maps.MapTypeId.ROADMAP,
                styles: this.mapStyles,
                disableDefaultUI: this.disableDefaultUI,
            }
            this.map = new window.google.maps.Map(this.element, mapArgs)
        }

        createMarkers() {
            this.mapMarkers.forEach((marker) => {
                const createdMarker = new window.google.maps.Marker({
                    position: marker,
                    map: this.map,
                    icon: this.markerIcon,
                })

                this.createMarkerPopup(createdMarker, marker)
            })
        }

        createMarkerPopup(marker, markerDataObj) {
            const infowWindow = new window.google.maps.InfoWindow({
                content: this.createMarkerContent(markerDataObj),
            })
            google.maps.event.addListener(marker, 'click', function () {
                infowWindow.open(this.map, marker)
            })
        }

        createMarkerContent(marker) {
            
            let content = '<div class="my-map__marker-popup-content">'
            content += '<div class="my-map__marker-popup-content__name fw-bold">' + marker.name + '</div>'
            content += '<div class="my-map__marker-popup-content__street">' + marker.street + '</div>'
            content += '<div class="my-map__marker-popup-content__city">' + marker.city + '</div>'
            content += '</div>'
            return content
        }

        centerMap() {
            // Create map boundaries from all map markers.
            let bounds = new window.google.maps.LatLngBounds()

            this.mapMarkers.forEach((marker) => {
                bounds.extend({
                    lat: marker.lat,
                    lng: marker.lng,
                })
            })

            if (1 === this.mapMarkers.length) {
                this.map.setCenter(bounds.getCenter())
            } else {
                this.map.fitBounds(bounds)
            }
        }

        init() {
            if (!window.hasOwnProperty('google') ||
                !window.google.hasOwnProperty('maps') ||
                !window.google.maps.hasOwnProperty('Map') ||
                !window.google.maps.hasOwnProperty('Marker') ||
                !window.google.maps.hasOwnProperty('LatLngBounds') ||
                !window.google.maps.hasOwnProperty('MapTypeId') ||
                !window.google.maps.MapTypeId.hasOwnProperty('ROADMAP')) {
                console.log('Google maps isn\'t available')
                return
            }

            // before the map initialization, because during creation HTML is changed
            this.readMarkers()
            this.createMap()
            this.createMarkers()
            this.centerMap()
        }
    }

    class Maps {
        constructor() {
            this.isMapsLoaded = false
            this.mapsToInit = []

            // TODO change to yours if you've defined own callback (for https://maps.googleapis.com/maps/api...)
            window.googleMapsCallback = this.mapsLoadedCallback.bind(this)

            'loading' !== document.readyState ?
                this.setup() :
                window.addEventListener('DOMContentLoaded', this.setup.bind(this))
        }

        setup() {
            const observer = new MutationObserver((records, observer) => {
                for (let record of records) {
                    record.addedNodes.forEach((addedNode) => {
                        this.addListeners(addedNode)
                    })
                }
            })
            observer.observe(document.body, {
                childList: true,
                subtree: true,
            })

            this.addListeners(document.body)
        }

        mapsLoadedCallback() {
            this.isMapsLoaded = true

            this.mapsToInit.forEach((map) => {
                map.init()
            })

            this.mapsToInit = []
        }

        addListeners(element) {
            if (Node.ELEMENT_NODE !== element.nodeType) {
                return
            }

            // TODO replace the selector if you've changed it in the markup

            element.querySelectorAll('.my-map').forEach((mapElement) => {
                let map = new GMap(mapElement)

                if (!this.isMapsLoaded) {
                    this.mapsToInit.push(map)

                    return
                }

                map.init()
            })
        }

    }

    new Maps()

</script>
