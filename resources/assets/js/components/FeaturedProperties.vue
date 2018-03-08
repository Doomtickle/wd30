<template>
    <div>
        <mini-listing
            class="w-full md:w-1/2 lg:w-1/3 px-2 py-2"
            v-for="listing in properties"
            :key="listing.id"
            :listing="listing"
        />
    </div>
</template>
<script>
    export default {
        props: {
            properties: {
                type: Array,
                default: this.properties
            }
        }
    }
</script>
