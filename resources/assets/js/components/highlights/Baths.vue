<template>
    <div v-if="show" class="beds w-auto px-2">
        <div class="icon">
            <svg class="h-6" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 203.2 156.3" style="enable-background:new 0 0 203.2 156.3; width: 40px;" xml:space="preserve">
            <path fill="none"
                  class="text-brand stroke-current"
                  stroke-width="4"
                  stroke-miterlimit="10"
                  d="M49.9,39.5v-11h-25v30h171c0,0,0,29-15.8,46.3c-22.4,24.6-49.8,24.8-49.8,24.8H73.9c0,0-32.5-2.8-51-26.3 C7.7,83.9,7.2,58.5,7.2,58.5h17.8" ></path>
            <polyline fill="none" class="stroke-brand" stroke-width="4" stroke-miterlimit="10" points="47.9,134.8 65.2,129.8 142.9,129.7 161.2,134.8"></polyline>
        </svg>
        </div>
        <p class="text-grey-darkest text-lg">{{ value }}</p>
        <p class="text-grey-dark text-xs text-uppercase">baths</p>
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