<template>
    <div>
        <div class="relative flex flex-col md:flex-row min-h-64">
            <div class="z-20 flex justify-center items-center bg-white opacity-75"
                 :class="{
                 'hidden': !isLoading,
                 'absolute': isLoading,
                 'pin': isLoading
            }">
                <ring-loader :loading="isLoading" :color="'bg-brand'" :size="'150px'"></ring-loader>
            </div>
            <div ref="map" class="relative w-full flex-grow md:w-3/4 h-48 md:h-64 z-10"></div>
            <div v-if="propOpen"
                 class="prop-panel relative w-full md:w-1/4 md:h-64 z-10 bg-white border-t-2 border-grey-lightest">
                <mini-listing
                    class="w-full p-6"
                    :listing="selectedProperty"
                />
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
        dataParams: {
            type: Array,
            default: []
        },
        api: {
            type: String,
            default: this.api
        }
    },
    data () {
        return {
            renderedMap: {},
            error: '',
            config: {},
            isLoading: true,
            propOpen: false,
            selectedProperty: {},
            searchData: {},
            pins: [],
            params: '',
        }
    },
    mounted () {
        let params = this.dataParams;
        let numParams = Object.keys(params).length

        // TODO: make Query Builder Object
        ////////////////////////////////

        for (let i = 0; i < numParams; i++) {
            let key = Object.keys(params)[i];
            let value = Object.values(params)[i];
            this.params += key + '=' + (value !== null ? value : '');
            if (i < numParams - 1) {
                this.params += '&';
            }
        }

        ///////////////////////////////////

        this.config = {
            zoom: this.zoom,
            destination: {
                latitude: this.latitude,
                longitude: this.longitude
            },
            mapElement: this.$refs.map
        };

        let vm = this;
        // TODO: Use a service to perform this action
        /////////////////////////////////////////////

        window.axios.get('/map-search?' + this.params)
            .then(response => {
                vm.searchData = response.data;
                vm.pins = response.data.data;
                vm.renderMap();
                vm.isLoading = false;
            })
            .catch(error => {
                console.log(error)
            });

        /////////////////////////////////////////////
    },
    methods: {
        renderMap() {
            let vm = this;
            new GoogleMap(vm.config, vm.pins, vm.api)
                .load()
                .then(rendered => {
                    vm.renderedMap = rendered;
                    window.addEventListener('marker_updated', function (event) {
                        vm.getProperty(event.detail.mls_account)
                    });
                });
        },
        getProperty(mlsAccount) {
            let vm = this;
            window.axios.get('/full-listing/' + mlsAccount)
                .then(response => {
                    vm.selectedProperty = response.data;
                    vm.propOpen = true;
                })
                .catch(error => {
                    console.log(error)
                });
        }
    }
}
</script>
<style>

</style>