<template>
    <div class="fixed pin bg-smoke-darkest z-50" v-if="modalOpen">
        <div class="fixed inline-block p-4 pin-t pin-r bg-brand text-white cursor-pointer" @click="closeModal" >X</div>
        <slot />
    </div>
</template>
<script>
export default {
    props: {
        modalOpen: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        closeModal(){
            this.$parent._data.modalOpen = false;
        }
    }
}
</script>