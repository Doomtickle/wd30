<template>
    <div class="flex w-full text-center mb-4 flex-wrap">
        <div class="w-full md:w-1/5">
            <avatar-upload :avatar-path="avatarPath" />
            <p class="block px-2 mt-2 text-xl text-smoke-dark" v-if="! boilerplate">{{ user.name }}</p>
            <p class="block px-2 mt-2 text-xl text-smoke-dark" v-else>Your Name</p>
            <p class="block px-2 text-xs text-smoke-light">Beachy Beach Real Estate</p>
        </div>
        <div class="flex w-full md:w-4/5 items-center justify-around leading-tighter mx-auto pt-6 md:pt-0 flex-wrap"><!--leading-tighter is a custom utility. Compensates for <br>.-->
            <div class="w-full sm:w-1/3 items-center justify-center mx-auto py-2">
                <p class="block text-5xl text-smoke-darker">
                    <span class="text-5xl text-brand font-brand">{{ animatedClicks.toLocaleString() }}</span>
                    <br>
                    <span class="text-lg font-brand text-smoke">Property Clicks</span>
                </p>
            </div>
            <div class="w-full sm:w-1/3 items-center justify-center mx-auto py-2">
                <p class="block text-5xl text-smoke-darker">
                    <span class="text-5xl text-brand font-brand">{{ animatedImpressions.toLocaleString() }}</span>
                    <br>
                    <span class="text-lg font-brand text-smoke">Property Impressions</span>
                </p>
            </div>
            <div class="w-full sm:w-1/3 items-center justify-center mx-auto py-2">
                <p class=" block text-5xl text-smoke-darker">
                    <span class="text-5xl text-brand font-brand">{{ animatedLeads }}</span>
                    <br>
                    <span class="text-lg font-brand text-smoke">Active Leads</span>
                </p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        dataUser: {
            type: Object,
            default: () => {}
        },
        avatarPath: {
            type: String,
            default: ''
        },
        boilerplate: {
            type: Boolean,
            default: false
        },
        activeLeadsCount: {
            type: Number,
            default: 0
        }
    },
    data () {
        return {
            impressions: 0,
            animatedImpressions: 0,
            clicks: 0,
            animatedClicks: 0,
            leads: 0,
            animatedLeads: 0,
            properties: []
        }
    },
    computed: {
        user: function () {
            return this.dataUser;
        }
    },
    watch: {
        impressions: function (newValue, oldValue) {
            let vm = this;
            function animate () {
                if (window.TWEEN.update()) {
                    requestAnimationFrame(animate)
                }
            }
            new window.TWEEN.Tween({ tweeningNumber: oldValue })
                .easing(window.TWEEN.Easing.Quadratic.Out)
                .to({ tweeningNumber: newValue }, 1000)
                .onUpdate(function () {
                    vm.animatedImpressions = this._object.tweeningNumber.toFixed(0);
                })
                .onComplete(function () {
                    vm.animatedImpressions = vm.impressions.toLocaleString();
                })
                .start();

            animate()
        },
        clicks: function (newValue, oldValue) {
            let vm = this;
            function animate () {
                if (window.TWEEN.update()) {
                    requestAnimationFrame(animate)
                }
            }

            new window.TWEEN.Tween({ tweeningNumber: oldValue })
                .easing(window.TWEEN.Easing.Quadratic.Out)
                .to({ tweeningNumber: newValue }, 500)
                .onUpdate(function () {
                    vm.animatedClicks = this._object.tweeningNumber.toFixed(0);
                })
                .onComplete(function () {
                    vm.animatedClicks = vm.clicks.toLocaleString();
                })
                .start();

            animate()
        },
        leads: function (newValue, oldValue) {
            let vm = this;
            function animate () {
                if (window.TWEEN.update()) {
                    requestAnimationFrame(animate)
                }
            }

            new window.TWEEN.Tween({ tweeningNumber: oldValue })
                .easing(window.TWEEN.Easing.Quadratic.Out)
                .to({ tweeningNumber: newValue }, 750)
                .onUpdate(function () {
                    vm.animatedLeads = this._object.tweeningNumber.toFixed(0);
                })
                .onComplete(function () {
                    vm.animatedLeads = vm.leads.toLocaleString();
                })
                .start();

            animate()
        },
        activeLeadsCount: function (newValue) {
            this.leads = newValue;
        }
    },
    mounted () {
        this.getAnalytics();
    },
    methods: {
        getAnalytics () {
            window.axios.get('my-properties')
                .then(response => {
                    this.properties = response.data;
                    this.properties.map(property => {
                        this.impressions += property.impressions;
                        this.clicks += property.clicks;
                    }, self);
                });

            window.axios.get('leads/count')
                .then(response => {
                    this.leads = response.data;
                });
        }
    }
}
</script>
