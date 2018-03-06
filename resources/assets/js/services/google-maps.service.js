import GoogleMapsLoader from 'google-maps';
import GeoLocator from './geolocator.service';
import MarkerClusterer from 'marker-clusterer-plus';

export default class GoogleMap {
    constructor(config, pins, api) {
        this.config = config;
        this.map = {};
        this.apiKey = api;
        this.pins = pins;
    }

    load() {
        return new Promise((resolve, reject = null) => {
            resolve(this.render());
        });
    }

    render() {
        GoogleMapsLoader.KEY = this.apiKey;
        let config = this.config;
        let mapData = this.map;
        let pins = this.pins;
        GoogleMapsLoader.load(google => {
            mapData.map = new google.maps.Map(config.mapElement, {
                zoom: config.zoom,
                center: new google.maps.LatLng(config.destination.latitude, config.destination.longitude),
                disableDefaultUI: true,
                zoomControl: true,
                scaleControl: true,
                maxZoom: 18
            });

            let control = config.directionsButton;
            mapData.map.controls[google.maps.ControlPosition.TOP_LEFT].push(control);
            mapData.bounds = new google.maps.LatLngBounds(mapData.position);
            mapData.markers = [];
            mapData.selected = {};

            let markerShape = {
                path: 'M0-48c-9.8 0-17.7 7.8-17.7 17.4 0 15.5 17.7 30.6 17.7 30.6s17.7-15.4 17.7-30.6c0-9.6-7.9-17.4-17.7-17.4z',
                scale: .7,
                strokeWeight: 3,
                strokeColor: '#FFF',
                strokeOpacity: .5,
                fillColor: '#555',
                fillOpacity: 1,
                rotation: 0
            };

            let selectedShape = {
                path: 'M0-48c-9.8 0-17.7 7.8-17.7 17.4 0 15.5 17.7 30.6 17.7 30.6s17.7-15.4 17.7-30.6c0-9.6-7.9-17.4-17.7-17.4z',
                scale: .7,
                strokeWeight: 3,
                strokeColor: '#55ff00',
                strokeOpacity: .5,
                fillColor: '#555',
                fillOpacity: 1,
                rotation: 0
            };

            let instance = this;

            for (let i = 0; i < pins.length; i++) {
                let obj = pins[i];
                if (obj.latitude < 31 &&
                    obj.latitude > 29 &&
                    obj.longitude > -90 &&
                    obj.longitude < -80
                ) {
                    let position = new google.maps.LatLng(obj.latitude, obj.longitude);
                    let marker = new google.maps.Marker({
                        position: position,
                        map: mapData.map,
                        icon: markerShape,
                    });

                    marker.addListener('click', function () {
                        instance.resetIcons(mapData.markers);
                        mapData.selected = obj;
                        this.setIcon(selectedShape);
                        window.dispatchEvent(new CustomEvent('marker_updated', {
                            detail: obj
                        }));
                    });

                    mapData.markers.push(marker);
                    mapData.bounds.extend(position);
                    mapData.map.fitBounds(mapData.bounds);
                }
            }

            // window.map = mapData.map;

            mapData.markerCluster = new MarkerClusterer(window.map, mapData.markers, {
                maxZoom: 14,
                gridSize: 60
            });
        });

        return mapData;
    }

    resetIcons(markers) {
        for (let i = 0; i < markers.length; i++) {
            markers[i].setIcon({
                path: 'M0-48c-9.8 0-17.7 7.8-17.7 17.4 0 15.5 17.7 30.6 17.7 30.6s17.7-15.4 17.7-30.6c0-9.6-7.9-17.4-17.7-17.4z',
                scale: .7,
                strokeWeight: 3,
                strokeColor: '#FFF',
                strokeOpacity: .5,
                fillColor: '#555',
                fillOpacity: 1,
                rotation: 0
            });
        }
    }

    getDirections(locations, mapData, button, panel) {
        GoogleMapsLoader.KEY = this.apiKey;
        GoogleMapsLoader.load(google => {
            let directionsDisplay = new google.maps.DirectionsRenderer({
                origin: new google.maps.LatLng(locations.origin.latitude, locations.origin.longitude),
                destination: new google.maps.LatLng(locations.destination.latitude, locations.destination.longitude),
                travelMode: 'DRIVING',
            });

            mapData.bounds.extend(directionsDisplay.destination);

            let directionsService = new google.maps.DirectionsService();
            directionsDisplay.setPanel(panel);
            directionsService.route({
                origin: directionsDisplay.origin,
                destination: directionsDisplay.destination,
                travelMode: 'DRIVING'
            }, function (response, status) {
                if (status === 'OK') {
                    return directionsDisplay.setDirections(response);
                } else {
                    return window.alert('Directions request failed due to ' + status);
                }
            });
            mapData.map.fitBounds(mapData.bounds);
            directionsDisplay.setMap(mapData.map);
        });
    }
}