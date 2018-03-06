<template>
    <div v-if="show" class="beds w-auto px-2">
        <div class="icon">
            <svg class="h-6" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 203.2 156.3" style="enable-background:new 0 0 203.2 156.3; width: 40px;" xml:space="preserve">
            <rect fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" x="8.5" y="73.7" width="187" height="37.8" ></rect>
            <rect fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" x="108.1" y="40.8" width="71.5" height="18.9" ></rect>
            <rect fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" x="24.5" y="40.8" width="71.5" height="18.9" ></rect>
            <polyline fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" points="179.6,127.6 179.6,111.5 24.5,111.9 24.5,128" ></polyline>
            <polygon fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" points="11.5,73.3 22.2,59.6 181.9,59.6 192.5,73.3" ></polygon>
        </svg>
        </div>
        <p class="text-grey-darkest text-lg">{{ value }}</p>
        <p class="text-grey-dark text-xs text-uppercase">beds</p>
    </div>
</template>
<script>
export default{
    props: {
       value: {
           type: String,
           default: this.value
       }
    },
    data(){
        return {
            show: ''
        }
    },
    mounted(){
        this.show = this.value !== null && this.value !== '' && this.value !== 0;
    }
}
</script>