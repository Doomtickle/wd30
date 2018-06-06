<template>
<div>
    <search-bar
        :data-map-module="hasMapModule"
        :searchTerms="searchTerms"
        v-on:view-changed="onViewChange"
        v-on:form-submitted="onSubmit"
    />
    <div v-if="! mapView" class="properties grid pb-4">
        <div class="container mx-auto">
            <sortbar
                :data-from="searchResults.from"
                :data-to="searchResults.to"
                :data-total="searchResults.total"
                v-on:new-sort="onSort"
            />
            <vue-progress-bar></vue-progress-bar>
            <property-search-results
                :searchResults="searchResults"
                :fetchingProperties="fetchingProperties"
            />
            <property-pagination
                :searchResults="searchResults"
                v-on:first-page="firstPage"
                v-on:prev-page="prevPage"
                v-on:next-page="nextPage"
                v-on:last-page="lastPage"
            />
        </div>
    </div>
    <div v-if="mapView">
        <div v-if="dataMapModule" >
            <map-search
                :latitude="searchResults.data[0].latitude"
                :longitude="searchResults.data[0].longitude"
                :data-params="searchTerms"
                ref="map"
                :zoom="16"
                :api="googleKey"
                class="border-b-2 border-secondary-light"
            />
        </div>
    </div>
</div>
</template>

<script>
import VueProgressBar from '../../../../node_modules/vue-progressbar';
import SearchResults from '../models/search-results';
export default {
    props: {
        dataMapModule: {
            type: String,
            default: this.dataMapModule === 'true'
        },
        initialSearchTerms: {
            type: Array,
            default: this.initialSearchTerms
        },
        initialSearchResults: {
            type: Object,
            default: this.initialSearchResults
        },
        googleKey: {
            type: String,
            default: ''
        }
    },
    data () {
        return {
            hasMapModule: false,
            mapView: false,
            fetchingProperties: false,
            searchTerms: {
                omni: 'Panama City Beach',
                propertyType: 'Single Family Home',
                minPrice: '200000',
                maxPrice: '',
                sq_ft: '',
                acreage: '',
                status: ['active'],
                bedrooms: '',
                bathrooms: '',
                openHouses: 0,
                waterFront: 0,
                pool: 0,
                sortBy: 'date_modified',
                orderBy: 'DESC',
                page: 1
            },
            searchResults: new SearchResults()
        }
    },
    created () {
        this.getMapAvailability();
        // Determine if the page is loaded with search criteria (i.e. from the homepage or a hyperlink).
        // If so, use the data provided in the request. Otherwise, use the default seed data from the searchterms object
        this.searchTerms = this.initialSearchTerms != '' ? this.initialSearchTerms : this.searchTerms;
        // Since the user can't specify a status from the quick search, we'll seed the status of active
        this.searchTerms.status = ['active'];
        this.searchResults = this.initialSearchResults;
    },
    methods: {
        getMapAvailability () {
            axios.get('/modules/map')
                 .then(response => {
                     this.hasMapModule = response.data;
                })
                 .catch(() => {
                     this.hasMapModule = false;
                 })
        },
        onSubmit (form) {
            // TODO: Clean this with a loop
            this.searchTerms.omni         = form.omni.value;
            this.searchTerms.propertyType = form.propertyType.value;
            this.searchTerms.minPrice     = form.minPrice.value;
            this.searchTerms.maxPrice     = form.maxPrice.value;
            this.searchTerms.bedrooms     = form.bedrooms.value;
            this.searchTerms.bathrooms    = form.bathrooms.value;
            this.searchTerms.sq_ft        = form.sq_ft.value;
            this.searchTerms.acreage      = form.acreage.value;
            this.searchTerms.openHouses   = form.openHouses.checked ? 1: 0;
            this.searchTerms.waterFront   = form.waterFront.checked ? 1: 0;
            this.searchTerms.pool         = form.pool.checked       ? 1: 0;
            this.searchTerms.status       = [];
            this.searchTerms.page         = 1;
            this.searchTerms.sortBy       = '',
            this.searchTerms.orderBy      = ''

            if (form.active.checked) {
                this.searchTerms.status.push('active');
            }
            if (form.sold.checked) {
                this.searchTerms.status.push('sold');
            }
            if (form.pending.checked) {
                this.searchTerms.status.push('pending');
            }
            this.getProperties(this.searchTerms);
        },
        getProperties (searchTerms, sortBy = 'date_modified', orderBy = 'DESC') {
            // loading bar
            this.$Progress.start();
            // this can be an array, so we need to stringify it before building the query string
            searchTerms.sortBy  = sortBy;
            searchTerms.orderBy = orderBy;
            searchTerms.status  = Array.isArray(searchTerms.status) ? searchTerms.status.join('|') : searchTerms.status;

            let queryString     = this.buildQueryString(searchTerms);

            window.axios.get('/search' + queryString)
                .then(response => {
                    this.searchResults = new SearchResults(response.data);
                });

            this.$Progress.finish();
        },
        buildQueryString(searchTerms) {
            // loop through searchTerms object and build a url query string from it
            let queryString = '?';
            let i = 0;
            Object.keys(searchTerms).forEach(key => {
                queryString += key + '=' + searchTerms[key];
                i++;
                if (i < (Object.keys(searchTerms).length)) {
                    queryString += '&';
                }
            });

            return queryString;
        },
        onSort(sortBy, orderBy) {
            // start the progress bar
            this.getProperties(this.searchTerms, sortBy, orderBy);
        },
        onViewChange (viewingMap) {
            this.mapView = viewingMap;
        },
        firstPage () {
            this.searchTerms.page = 1;
            this.getProperties(this.searchTerms);
        },
        prevPage() {
            this.searchTerms.page -= 1;
            this.getProperties(this.searchTerms);
        },
        nextPage() {
            this.searchTerms.page += 1;
            this.getProperties(this.searchTerms);
        },
        lastPage() {
            this.searchTerms.page = this.searchResults.last_page;
            this.getProperties(this.searchTerms);
        }
    }
}
</script>
