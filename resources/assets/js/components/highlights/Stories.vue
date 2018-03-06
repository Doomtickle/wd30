<template>
    <div v-if="show" class="beds w-auto px-2">
        <div class="icon">
            <svg class="h-6" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 195 110" x="0px" y="0px" style="enable-background:new 0 0 203.2 156.3; width: 40px;" xml:space="preserve">
            <polygon fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" points="2 2 173.11 2 173.11 88.17 104.03 88.17 103.72 64.83 71.09 64.83 71.39 88.17 2 88.17 2 2" ></polygon>
            <rect fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" x="119.58" y="23.47" width="38.98" height="17.29" ></rect>
            <rect fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" x="67.7" y="23.47" width="38.98" height="17.29" ></rect>
            <rect fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" x="16.18" y="23.47" width="38.98" height="17.29" ></rect>
            <rect fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" x="119.58" y="55.5" width="38.98" height="17.29" ></rect>
            <rect fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" x="16.18" y="55.5" width="38.98" height="17.29" ></rect>
        </svg>
        </div>
        <p class="text-grey-darkest text-lg">{{ value }}</p>
        <p class="text-grey-dark text-xs text-uppercase">stories</p>
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