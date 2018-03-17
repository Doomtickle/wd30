<template>
    <div class="relative flex flex-col min-h-64">
        <div class="z-20 flex justify-center items-center bg-white opacity-75"
             :class="{
                 'hidden': !isLoading,
                 'absolute': isLoading,
                 'pin': isLoading
            }">
            <ring-loader :loading="isLoading" :color="'bg-brand'" :size="'150px'"></ring-loader>
        </div>
        <a
            class="font-brand block w-full px-4 py-2 cursor-pointer border-white justify-center items-center bg-brand-light text-2xl rounded-t text-white no-underline text-center md:hidden"
            :href="'https://www.google.com/maps/dir/?api=1&destination=' + latitude + ',' + longitude"
        >
            GET DIRECTIONS
        </a>
        <div
            ref="directionsButton"
            class="font-brand w-auto px-4 py-2 cursor-pointer border-white justify-center items-center absolute z-50 bg-brand-light text-2xl rounded-br text-white invisible md:visible text-center"
            :class="{'hidden': showDirections}"
            @click="getUserLocation"
        >
            GET DIRECTIONS
        </div>
        <div ref="map" class="relative w-full h-64 z-10"></div>
        <div
            class="w-full bg-white text-brand-darket p-8 overflow-auto h-auto overflow-y-scroll"
            :class="{'hidden': !showDirections}"
        >
            <a class="font-brand w-auto px-4 py-2 cursor-pointer border-white justify-center items-center bg-brand-light text-2xl rounded text-white text-center"
               @click="closeDirections">CLOSE DIRECTIONS</a>
            <div class="directions" ref="directionsPanel">
            </div>
        </div>
    </div>
</template>

<script>
import GeoLocator from '../services/geolocator.service.js';
import GoogleMap from '../services/google-maps.service.js';

    export default {
        props: {
            latitude: {
                type: Number,
                default: this.latitude
            },
            longitude: {
                type: Number,
                default: this.longitude
            },
            zoom: {
                type: Number,
                default: this.zoom
            },
            api: {
                type: String,
                default: this.api
            }
        },
        data() {
            return {
                renderedMap: {},
                showDirections: false,
                config: {},
                isLoading: false,
                errors: []
            }
        },
        mounted() {
            this.config = {
                zoom: this.zoom,
                origin: {}, //we don't know this yet
                mapElement: this.$refs.map,
                center: {
                    latitude: this.latitude,
                    longitude: this.longitude
                },
                directionsButton: this.$refs.directionsButton,
                directionsPanel: this.$refs.directionsPanel,
                markers: [
                    {
                        latitude: this.latitude,
                        longitude: this.longitude,
                        icon: 'http://mt.googleapis.com/vt/icon/name=icons/spotlight/spotlight-poi.png&scale=1'
                    }
                ]
            };
            this.renderMap();
        },
        methods: {
            renderMap() {
                let vm = this;
                new GoogleMap(vm.config, vm.api)
                    .load()
                    .then(rendered => {
                        vm.renderedMap = rendered;
                    })
                    .catch(e => {
                        this.errors.push(e)
                    });
            },
            getUserLocation() {
                this.isLoading = true;
                let vm = this;
                let geo = new GeoLocator();
                if (Object.keys(vm.config.origin).length === 0) {
                    geo.getLocation()
                        .then(position => {
                            vm.config.origin = position;
                            vm.openDirections();
                        })
                        .catch(e => {
                            this.errors.push(e)
                        })
                } else {
                    vm.openDirections();
                }
            },
            openDirections() {
                this.isLoading = false;
                this.showDirections = true;
                let vm = this;

                console.log(this.errors);

                new GoogleMap(vm.config, vm.api)
                    .getDirections(this.$refs.directionsButton, this.$refs.directionsPanel);
            },
            closeDirections() {
                this.showDirections = false;
                this.$refs.directionsPanel.innerHTML = "";
                this.renderMap();
            }
        }
    }
</script>