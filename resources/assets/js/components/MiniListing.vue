<template>
    <div>
        <div class="property relative bg-white shadow-md md:rounded overflow-hidden border-b-4 border-brand hover:border-secondary h-full">
            <a :href="'/listing/' + listing.mls_account + '/'" class="absolute pin hover:shadow-inner z-20" ></a>
            <div class="property-image md:h-48 md:overflow-hidden">
                <div
                    class="inline-block absolute flag pin-t pin-l w-auto bg-secondary text-white p-1 px-4 mt-2 z-10 font-brand text-xl"
                    v-if="listing.has_open_houses"
                >
                    OPEN HOUSE
                </div>
                <div
                    class="inline-block absolute flag pin-t pin-l w-auto bg-secondary text-white p-1 px-4 mt-2 z-10 font-brand text-xl"
                    v-if="listing.status !== 'Active'"
                >
                    {{ listing.status }}
                </div>
                <img v-if="listing.preferred_image !== null" class="w-auto h-auto min-h-full min-w-full" :src="listing.preferred_image" >
                <div v-if="listing.preferred_image === null" class="text-grey-lighter w-full h-full bg-white text-center">
                    <svg class="h-full " version="1.1" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px" y="0px" viewBox="0 0 1000 1000"
                         enable-background="new 0 0 1000 1000" xml:space="preserve">
                        <path class="fill-current stroke-current opacity-75" d="M200.9,489.4L163.5,444L500,167.2L836.5,444l-37.4,45.4L500,243.4L200.9,489.4z M853.9,645.6h-96.8v93.6H244.2v-93.6h-98.1L10,832.6h54.3c2.5,0,5,0.1,7.5,0.1c120.5,0,240.9,0,361.4,0c6.4,0,12.8,0,19.1,0h111.2c1.2,0,2.2,0,3.4,0c120.5,0,240.9,0.1,361.4,0c2.5,0,5,0,7.5-0.1H990L853.9,645.6z M500,300.2l217.2,179.9v163.7v56.1v6H282.8v-6.7v-55.5V479.4L500,300.2z M496.7,544.3h-80.5v75.2h80.5V544.3z M496.7,459.3h-80.5v75.2h80.5V459.3z M507.2,534.5h80.5v-75.2h-80.5V534.5z M507.2,619.6h80.5v-75.2h-80.5V619.6z" ></path>
                    </svg>
                </div>
            </div>
            <div class="property-details py-2 px-2">
                <div class="address h-12 flex flex-col justify-center align-middle">
                    <p class="p-2 text-grey-darker text-sm text-center">
                        {{ listing.street_number }} {{ listing.street_name }}
                        <span v-if="listing.unit_number != ''">
                            Unit {{ listing.unit_number }}
                        </span>
                        <br>
                        {{ listing.city }}, {{ listing.state }}
                    </p>
                </div>
                <div class="price">
                    <p class="py-2 text-center text-brand text-3xl font-brand">${{ price }}</p>
                </div>
                <div class="prop-type">
                    <p class="pb-2 text-grey-darkest text-center text-xs text-grey-dark text-uppercase">{{ listing.property_type }}</p>
                </div>
                <div v-if="listing.class === 'A' || listing.class === 'G' || listing.class === 'H'"
                     class="attributes flex text-center justify-around py-2" >
                    <beds :value="listing.bedrooms.toString()"></beds>
                    <baths :value="listing.bathrooms.toString()"></baths>
                    <sqft :value="listing.sq_ft.toString()"></sqft>
                </div>
                <div v-if="listing.class === 'J' || listing.class === 'C'"
                     class="attributes flex text-center justify-around py-2" >
                    <lot-dimensions :value="listing.lot_dimensions.toString()"></lot-dimensions>
                    <acreage :value="listing.acreage.toString()"></acreage>
                    <sqft :value="listing.sq_ft.toString()"></sqft>
                </div>
                <div v-if="listing.class === 'F' || listing.class === 'E'"
                     class="attributes flex text-center justify-around py-2" >
                    <acreage :value="listing.acreage.toString()"></acreage>
                    <lot-dimensions :value="listing.lot_dimensions.toString()"></lot-dimensions>
                    <stories :value="listing.stories.toString()"></stories>
                    <sqft :value="listing.sq_ft.toString()"></sqft>
                </div>
                <div class="mls text-center mt-3">
                    <p class="text-grey-dark text-xs">MLS# {{ listing.mls_account }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
Vue.component('beds', require('./highlights/Beds.vue'));
Vue.component('baths', require('./highlights/Baths.vue'));
Vue.component('acreage', require('./highlights/Acreage.vue'));
Vue.component('sqft', require('./highlights/Sqft.vue'));
Vue.component('stories', require('./highlights/Stories.vue'));
Vue.component('lot-dimensions', require('./highlights/LotDimensions.vue'));

export default {
    props: {
        listing: {
            type: Object,
            default: () => {}
        }
    },
    computed: {
        price: function(){
            return this.listing.price.toLocaleString();
        }
    }
}
</script>
