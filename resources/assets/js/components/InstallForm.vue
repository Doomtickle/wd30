<template>
    <div class="container mx-auto bg-white flex flex-wrap justify-center">
        <p class="w-full justify-center flex font-bold items-center text-secondary p-4 border-b border-secondary">
            <span
                class="text-center w-auto text-2xl text-brand"
                v-if="! building"
            >
                Welcome to your new site! <br/> We just need a couple of things to get started.
            </span>
            <span
                class="text-center w-auto text-2xl text-brand"
                v-if="duplicatesFound"
            >
                <span class="underline font-bold text-secondary">Awesome!</span> <br/> <br/> We noticed some duplicate values in your MLS data, select the most accurate choice for each field below. If you're not sure, you can always change this later.

            </span>
            <span
                class="text-center w-auto text-2xl text-brand"
                v-if="! duplicatesFound && building"
            >
                <span class="underline font-bold text-secondary">All set!</span> <br/> <br/> Easy, huh? Click the button below to login to your site. Happy Selling!

            </span>
        </p>
        <div v-if="! building" class="w-full">
            <div class="w-full py-4 bg-white flex flex-wrap items-center justify-center border-b">
                <div class="font-bold w-1/3 sm:w-1/4 md:w-1/6 py-2 text-right">
                    Your Name:
                </div>
                <input
                    type="text"
                    class="border border-brand ml-4 md:text-xl py-2 md:px-2 bg-white w-1/2 text-left"
                    v-model="name"
                >
            </div>
            <div class="w-full py-4 bg-white flex flex-wrap items-center justify-center border-b">
                <div class="font-bold w-1/3 sm:w-1/4 md:w-1/6 py-2 text-right">
                    Your Email:
                </div>
                <input
                    type="text"
                    class="border border-brand ml-4 md:text-xl py-2 md:px-2 bg-white w-1/2 text-left"
                    v-model="email"
                >
            </div>
            <div class="w-full py-4 bg-white flex flex-wrap items-center justify-center border-b">
                <div class="font-bold w-1/3 sm:w-1/4 md:w-1/6 text-right">
                    Company/Broker:
                </div>
                <input
                    type="text"
                    class="border border-brand ml-4 md:text-xl py-2 md:px-2 bg-white w-1/2 text-left"
                    v-model="company"
                >
            </div>
            <div class="w-full py-4 bg-white flex flex-wrap items-center justify-center border-b">
                <div class="font-bold w-1/3 sm:w-1/4 md:w-1/6 py-2 text-right">
                    Create Password:
                </div>
                <input
                    type="password"
                    class="border border-brand ml-4 md:text-xl py-2 md:px-2 bg-white w-1/2 text-left"
                    v-model="password"
                >
            </div>
            <div class="w-full py-4 bg-white flex flex-wrap items-center justify-center border-b">
                <div class="font-bold w-1/3 sm:w-1/4 md:w-1/6 py-2 text-right">
                    Confirm Password:
                </div>
                <input
                    type="password"
                    class="border border-brand ml-4 md:text-xl py-2 md:px-2 bg-white w-1/2 text-left"
                    v-model="password_confirmation"
                >
            </div>
            <div class="w-full bg-white flex flex-wrap h-16 items-center">
                <button
                    class="bg-brand-dark text-white shadow appearance-none inline-block border-brand-darkest .px-3 .py-2 w-full h-16 text-3xl font-bold"
                    @click="install"
                >
                    BUILD MY SITE
                </button>
            </div>
        </div>
        <div
            class="w-full py-4 bg-white flex flex-wrap items-center justify-center border-b"
            v-if="duplicatesFound"
        >
            <div class="w-full py-4 bg-white flex flex-wrap items-center justify-between">
                <div
                    class="font-bold w-1/3 text-right py-4"
                    v-if="chooseOfficePhone"
                >
                    Office Phone:
                </div>
                <div
                    class="w-2/3 flex flex-wrap items-center justify-around py-4"
                    v-if="chooseOfficePhone"
                >
                    <button
                        class="button-secondary w-1/3"
                        v-for="op in office_phone"
                        @click="select('office_phone', op)"
                    >
                        {{ op }}
                    </button>
                </div>
                <div
                    class="font-bold w-1/3 text-right py-4"
                    v-if="chooseCellPhone"
                >
                    Cell Phone:
                </div>
                <div
                    class="w-2/3 flex flex-wrap items-center justify-around py-4"
                    v-if="chooseCellPhone"
                >
                    <button
                        class="button-secondary w-1/3"
                        v-for="cp in cell_phone"
                        @click="select('cell_phone', cp)"
                    >
                        {{ cp }}
                    </button>
                </div>
                <div
                    class="font-bold w-1/3 text-right py-4"
                    v-if="chooseStreet1"
                >
                    Street 1:
                </div>
                <div
                    class="w-2/3 flex flex-wrap items-center justify-around py-4"
                    v-if="chooseStreet1"
                >
                    <button
                        class="button-secondary w-1/3"
                        v-for="s1 in street_1"
                        @click="select('street_1', s1)"
                    >
                        {{ s1 }}
                    </button>
                </div>
                <div
                    class="font-bold w-1/3 text-right py-4"
                    v-if="chooseStreet2"
                >
                    Street 2:
                </div>
                <div
                    class="w-2/3 flex flex-wrap items-center justify-around py-4"
                    v-if="chooseStreet2"
                >
                    <button
                        class="button-secondary w-1/3"
                        v-for="s2 in street_2"
                        @click="select('street_2', s2)"
                    >
                        {{ s2 }}
                    </button>
                </div>
                <div
                    class="font-bold w-1/3 text-right py-4"
                    v-if="chooseCity"
                >
                    City:
                </div>
                <div
                    class="w-2/3 flex flex-wrap items-center justify-around py-4"
                    v-if="chooseCity"
                >
                    <button
                        class="button-secondary w-1/3"
                        v-for="c in city"
                        @click="select('city', c)"
                    >
                        {{ c }}
                    </button>
                </div>
                <div
                    class="font-bold w-1/3 text-right py-4"
                    v-if="chooseState"
                >
                    State:
                </div>
                <div
                    class="w-2/3 flex flex-wrap items-center justify-around py-4"
                    v-if="chooseState"
                >
                    <button
                        class="button-secondary w-1/3"
                        v-for="st in state"
                        @click="select('state', st)"
                    >
                        {{ st }}
                    </button>
                </div>
                <div
                    class="font-bold w-1/3 text-right py-4"
                    v-if="chooseZip"
                >
                    Zip:
                </div>
                <div
                    class="w-2/3 flex flex-wrap items-center justify-around py-4"
                    v-if="chooseZip"
                >
                    <button
                        class="button-secondary w-1/3"
                        v-for="z in zip"
                        @click="select('zip', z)"
                    >
                        {{ z }}
                    </button>
                </div>
            </div>
        </div>
        <div
            class="w-1/2 flex flex-wrap items-center justify-around"
            v-if="! duplicatesFound && building"
        >
            <button
                class="button-secondary w-1/3"
                @click="finishInstall"
            >
                GO!
            </button>
        </div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            name: '',
            email: '',
            company: '',
            mls_id: [],
            cell_phone: [],
            office_phone: [],
            street_1: [],
            street_2: [],
            city: [],
            state: [],
            zip: [],
            photos: [],
            building: false,
            password: '',
            password_confirmation: ''
        }
    },
    computed: {
        duplicatesFound: function () {
            return (
                this.chooseOfficePhone ||
                this.chooseCellPhone   ||
                this.chooseStreet1     ||
                this.chooseStreet2     ||
                this.chooseCity        ||
                this.chooseState       ||
                this.chooseZip
            );
        },
        chooseOfficePhone: function () {
            return (this.office_phone.length > 1)
        },
        chooseCellPhone: function () {
            return (this.cell_phone.length > 1)
        },
        chooseStreet1: function () {
            return (this.street_1.length > 1);
        },
        chooseStreet2: function () {
            return (this.street_2.length > 1);
        },
        chooseCity: function () {
            return (this.city.length > 1);
        },
        chooseState: function () {
            return (this.state.length > 1);
        },
        chooseZip: function () {
            return (this.zip.length > 1);
        }
    },
    methods: {
        install () {
            this.building = true;
            window.axios.post('/configure-install', {
                name: this.name,
                email: this.email,
                company: this.company,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
                .then(response => {
                    let data = response.data;
                    this.zip          = data.zip;
                    this.city         = data.city;
                    this.state        = data.state;
                    this.photos       = data.photos;
                    this.mls_id       = data.mls_id;
                    this.street_1     = data.street_1;
                    this.street_2     = data.street_2;
                    this.cell_phone   = data.cell_phone;
                    this.office_phone = data.office_phone;
                });
        },
        select (key, value) {
            this[key] = [value];
        },
        finishInstall () {
            window.axios.post('/finish-install', {
                mls_id: this.mls_id,
                cell_phone: this.cell_phone[0],
                office_phone: this.office_phone[0],
                street_1: this.street_1[0],
                street_2: this.street_2[0],
                city: this.city[0],
                state: this.state[0],
                zip: this.zip[0],
                photo: this.photos[0]
            })
                .then(response => {
                    window.location = '/login';
                });
        }
    }
}
</script>
