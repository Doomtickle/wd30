<template>
    <div>
        <my-property
            v-for="listing in properties"
            :key="listing.id"
            :listing="listing"
        />
    </div>
</template>
<script>
export default {
    data () {
        return {
            properties: []
        }
    },
    mounted () {
        window.axios.get('/my-properties')
            .then(response => {
                this.properties = response.data
            });
    }
}
</script>
