<template>
<div>
    <span
        class="text-sm -my-3 w-full cursor-pointer block text-right"
        @click="deleteNumber"
    >
        x
    </span>
    <span class="w-full block text-center">{{ mlsNumber.mls_id }}</span>
</div>
</template>

<script>
export default {
    props: {
        mlsNumber: {
            type: Object,
            default: () => {}
        }
    },
    methods: {
        deleteNumber () {
            this.$emit('delete-number', this.mlsNumber.id);
        }
    }
}
</script>
