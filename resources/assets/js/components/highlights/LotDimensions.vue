<template>
    <div v-if="show" class="beds w-auto px-2">
        <div class="icon">
            <svg class="h-6" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 203.2 156.3" style="enable-background:new 0 0 203.2 156.3; width: 40px;" xml:space="preserve">
            <polygon fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" points="142.9,37.9 101.3,69.5 59.7,37.9 101.3,6.3" ></polygon>
            <polygon fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" points="89.5,78.3 47.9,109.8 6.3,78.3 47.9,46.7" ></polygon>
            <polygon fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" points="196.3,78.3 154.7,109.8 113.1,78.3 154.7,46.7" ></polygon>
            <polygon fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" points="142.9,118.6 101.3,150.2 59.7,118.6 101.3,87" ></polygon>
        </svg>
        </div>
        <p class="text-grey-darkest text-lg max-w-icon break-words truncate">{{ value }}</p>
        <p class="text-grey-dark text-xs text-uppercase">lot size</p>
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