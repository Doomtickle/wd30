<template>
    <div v-if="show" class="beds w-auto px-2">
        <div class="icon">
            <svg class="h-6" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 203.2 156.3" style="enable-background:new 0 0 203.2 156.3; width: 40px;" xml:space="preserve">
            <polyline fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" points="7.9,33.2 7.9,21.5 195.9,21.5 195.9,132.3 7.9,132.3 7.9,61.3" ></polyline>
            <line fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" x1="144.9" y1="21.5" x2="144.9" y2="48.5" ></line>
            <polyline fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" points="196.3,76.8 101.9,78.2 101.9,55.5 101.9,97.5" ></polyline>
        </svg>
        </div>
        <p class="text-grey-darkest text-lg">{{ value }}</p>
        <p class="text-grey-dark text-xs text-uppercase">sqft</p>
    </div>
</template>
<script>
    export default {
        props: {
            value: {
                type: String,
                default: this.value
            }
        },
        data() {
            return {
                show: ''
            }
        },
        mounted() {
            this.show = this.value !== null && this.value !== '' && this.value !== 0;
        }
    }
</script>