import GoogleMapsLoader from 'google-maps';

export default class GoogleMap {
    constructor(config, api) {
        this.config = config;
        this.map = {};
        this.apiKey = api;
        this.visibleMarkers = [];
        this.google = {};
    }

    load() {

        return new Promise((resolve, reject = null) => {
            resolve(this.init());
        });
    }

    init() {
        GoogleMapsLoader.KEY = this.apiKey;
        GoogleMapsLoader.load(google => {
            this.google = google;
            this.renderMap();
        });

        window.markers = [];

        console.log('initiated');
    }

    renderMap() {
        window.mapData = this.map;
        
        mapData.map = new google.maps.Map(document.getElementById('adventuremap'), {
            zoom: this.config.zoom,
            center: new google.maps.LatLng(parseFloat(this.config.center.latitude), parseFloat(this.config.center.longitude)),
            disableDefaultUI: true,
            zoomControl: true,
            scaleControl: true,
            maxZoom: 20
        });

        console.log('rendering map');

    }

    clearMarkers() {
        for (let i = 0; i < window.markers.length; i++) {
            window.markers[i].setMap(null);
        }
    }

    drawMarkers() {
        let markers = this.config.markers;
        this.clearMarkers();

        console.log('drawing markers');

        for (let i = 0; i < markers.length; i++) {

            let latLng = new google.maps.LatLng(parseFloat(markers[i].latitude), parseFloat(markers[i].longitude));
            let marker = new google.maps.Marker({
                position: latLng,
                map: window.mapData.map,
                draggable: false,
                flat: true
            });
            window.markers.push(marker);

            let infowindow = new google.maps.InfoWindow({
                content: '<div class="infowindow">' +
                '<h3>' + markers[i].title + '</h3>' +
                '<p>' + markers[i].address + '</p>' +
                '<p><a class="btn btn-primary mr-1" href="' + markers[i].link + '" >more info</a>' + 
                '<a class="btn btn-primary" target="_blank" href="https://www.google.com/maps/dir//' + markers[i].address + '" >get directions</a></p>' +
                '</div>'
            });

            marker.addListener('click', function () {
                window.mapData.selected = markers[i];
                infowindow.open(mapData, marker);
                window.dispatchEvent(new CustomEvent('marker_updated', {
                    detail: markers[i]
                }));
            });
        }

    }

}