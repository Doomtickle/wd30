<template>
    <div>
        <div class="grid-container">
            <div class="container mx-auto">
                <div class="flex flex-wrap justify-center items-start min-h-full">
                    <mini-listing
                        class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-2 py-2"
                        v-for="listing in properties.data"
                        :key="listing.id"
                        :listing="listing"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            dataParams: {
                type: Object,
                default: {}
            }
        },
        data() {
            return {
                properties: [],
                params: ''
            }
        },
        mounted() {
            let params = this.dataParams;
            let numParams = Object.keys(params).length

            for (let i = 0; i < numParams; i++) {
                let key = Object.keys(params)[i]
                let value  = Object.values(params)[i]
                this.params += key + '=' + (value !== null ? value : '');
                if(i < numParams - 1){
                    this.params += '&';
                }
            }

            window.axios.get('/search?' + this.params)
                .then(response => {
                    this.properties = response.data
                })
                .catch(error => {
                    console.log(error)
                });
        }
    }
</script>
