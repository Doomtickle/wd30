<template>
    <div class="flex static w-full bg-transparent items-center text-center mx-1 flex-wrap rounded">
        <div class="w-full mx-12 px-12 py-0 md:px-0 md:w-2/5 lg:w-1/5 relative md:pin-l -mb-4 z-40 md:mb-0 md:block md:mx-0 md:py-8 lg:pt-8 md:mx-auto">
            <div class="px-12 lg:px-4">
                <avatar-upload :avatar-path="avatarPath" />
            </div>
            <p class="hidden md:block px-2 mt-2 text-xl text-smoke-dark" v-if="! boilerplate">{{ user.name }}</p>
            <p class="block px-2 mt-2 text-xl text-smoke-dark" v-else>Your Name</p>
            <p class="hidden md:block px-2 text-xs text-smoke-light">{{ user.company }}</p>
        </div>
        <div class="flex py-4 w-full md:w-3/5 bg-white items-center justify-center md:mt-12 mx-auto md:pr-8 flex-wrap rounded shadow md:shadow-none"><!--leading-tighter is a custom utility. Compensates for <br>.-->
            <div class="w-1/3 items-start mx-auto mb-4">
                <p class="block text-5xl text-smoke-darker leading-tightest md:leading-tighter">
                    <span class="text-2xl md:text-5xl text-brand font-brand">{{ animatedClicks.toLocaleString() }}</span>
                    <br>
                    <span class="text-xs md:text-lg font-brand text-smoke">Property Clicks</span>
                </p>
            </div>
            <div class="w-1/3 items-start mx-auto mb-4">
                <p class="block text-5xl text-smoke-darker leading-tightest md:leading-tighter">
                    <span class="text-2xl md:text-5xl text-brand font-brand">{{ animatedImpressions.toLocaleString() }}</span>
                    <br>
                    <span class="text-xs md:text-lg font-brand text-smoke">Property Impressions</span>
                </p>
            </div>
            <div class="w-1/3 items-start mx-auto mb-4">
                <p class="block text-5xl text-smoke-darker leading-tightest md:leading-tighter">
                    <span class="text-2xl md:text-5xl text-brand font-brand">{{ animatedLeads }}</span>
                    <br>
                    <span class="text-xs md:text-lg font-brand text-smoke">Active Leads</span>
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
        boilerplate: {
            type: Boolean,
            default: false
        },
        activeLeadsCount: {
            type: Number,
            default: 0
        },
        avatarPath: {
            type: String,
            default: ''
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
            properties: [],
        }
    },
    computed: {
        user: function () {
            return this.dataUser;
        },
        totalLeads: function () {
            return this.leads + this.archivedLeads;
        },
        clickThruRate: function () {
            return ((this.clicks/this.impressions) * 100).toFixed(2) + '%';
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
