<template>
    <div v-if="show" class="beds w-auto px-2">
        <div class="icon">
            <svg class="h-6" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 203.2 156.3" style="enable-background:new 0 0 203.2 156.3; width: 40px;" xml:space="preserve">
            <polygon fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" points="44.4,25 15.7,62.5 29.9,62.5 10.2,101.5 27.9,101.5 7.4,137.5 97.9,137.5 72.9,100.5 92.9,100.5 61.9,61.5 77.9,61.5"></polygon>
            <polygon fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" points="84.5,6.5 60,41.6 68.6,51.3 77.9,61.5 61.9,61.5 92.9,100.5 72.9,100.5 97.9,137.5 101.5,137.5 119.9,98.5 102.2,98.5 121.9,50.5 107.7,50.5 112,42"></polygon>
            <polygon fill="none" class="text-brand stroke-current" stroke-width="4" stroke-miterlimit="10" points="136.4,7.5 107.7,50.5 121.9,50.5 102.2,98.5 119.9,98.5 99.4,144.5 189.9,143.5 164.9,97.5 184.9,97.5 153.9,48.5 169.9,48.5"></polygon>
        </svg>
        </div>
        <p class="text-grey-darkest text-lg">{{ value }}</p>
        <p class="text-grey-dark text-xs text-uppercase">acres</p>
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