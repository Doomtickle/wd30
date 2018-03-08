<template>
    <div class="search-bar">
        <div class="container mx-auto">
            <form class="flex flex-wrap pt-4 pb-2 mt-4" action="/property-search" method="GET">
                <omni-bar class="relative px-2 py-2 w-full sm:w-1/2 md:w-3/5 lg:w-1/3"></omni-bar>
                <property-type class="relative px-2 py-2 w-full sm:w-1/2 md:w-2/5 lg:w-1/4"></property-type>
                <div class="flex flex-auto relative justify-end w-full lg:w-1/8" v-if="dataMapModule">
                    <div class="relative px-2 py-2 w-full">
                        <button @click="switchView($event)" class="button-grey-darker h-10 block w-full" >{{ viewText }} view</button>
                    </div>
                </div>
                <div class="flex flex-auto relative justify-end w-full sm:w-1/2 lg:w-1/8">
                    <div class="relative px-2 py-2 w-full">
                        <button class="button-grey-darker h-10 block w-full" type="button" @click="toggleAdvanced($event)" >Advanced</button>
                    </div>
                </div>
                <div class="flex-auto advanced-menu w-full" :class="{ 'hidden': !this.advancedOpen  }" >
                    <div class="my-4">
                        <div class="flex border-grey-lighter border-t border-b py-3 flex-wrap">
                            <div class="flex-auto w-full md:w-1/3 lg:w-1/2">
                                <div class="flex py-1 flex-wrap">
                                    <min-price-field class="flex-auto relative p-2 w-full sm:w-1/2 md:w-full lg:w-1/2"></min-price-field>
                                    <max-price-field class="flex-auto relative p-2 w-full sm:w-1/2 md:w-full lg:w-1/2"></max-price-field>
                                    <total-sqft-field class="flex-auto relative p-2 w-full sm:w-1/2 md:w-full lg:w-1/2"></total-sqft-field>
                                    <acreage-field class="flex-auto relative p-2 w-full sm:w-1/2 md:w-full lg:w-1/2"></acreage-field>
                                    <status-field class="flex mt-2 mx-2 w-full border border-grey-light shadow rounded flex-wrap h-auto sm:h-10 align-middle overflow-hidden"></status-field>
                                </div>
                            </div>
                            <div class="flex-auto relative p-2 w-full md:w-3/4 lg:w-1/2">
                                <bedrooms-field class="flex my-1 border border-grey-light shadow rounded flex-wrap h-auto sm:h-10 align-middle overflow-hidden"></bedrooms-field>
                                <bathrooms-field class="flex mt-4 border border-grey-light shadow rounded flex-wrap h-auto sm:h-10 align-middle overflow-hidden"></bathrooms-field>
                                <features-field class="flex mt-4 border border-grey-light shadow rounded flex-wrap h-auto sm:h-10 align-middle overflow-hidden"></features-field>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex relative justify-end w-full" :class="{
                    'sm:w-1/2': !this.advancedOpen,
                    'lg:w-1/8': !this.advancedOpen
                }">
                    <div class="relative px-2 py-2 w-full" :class="{
                    'sm:w-1/2': this.advancedOpen,
                    'lg:w-1/8': this.advancedOpen
                }" >
                        <button class="button-secondary h-10 w-full" type="submit" >Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            view: {
                type: String,
                default: ''
            },
            dataMapModule: {
                type: String,
                default: this.dataMapModule === 'true'
            }
        },
        data(){
            return {
                advancedOpen: false
            };
        },
        computed: {
            viewText: function () {
                return (this.view === 'map' ? 'Grid' : 'Map');
            }
        },
        created(){
            this.advancedOpen = false;
        },
        methods: {
            toggleAdvanced(event){
                if (event) event.preventDefault();
                this.advancedOpen = !this.advancedOpen;
            },
            switchView(event){
                if (event) event.preventDefault();
                this.$emit('switch-view');
            }
        }
    }
</script>