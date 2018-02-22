<template>
    <div class="container mx-auto bg-white flex flex-wrap justify-center mb-8">
        <p class="w-full justify-between flex font-bold items-center text-secondary p-4 border-b border-secondary">
            <span class="text-left w-auto text-3xl font-brand font-bold text-secondary">
                BIO
            </span>
            <small class="text-xs w-auto flex-grow text-right">Click on the text you want to edit</small>
        </p>
        <div class="w-full py-2 bg-white flex flex-wrap items-center border-b">
            <div class="font-bold w-1/3 sm:w-1/4 md:w-1/6 py-2 px-4 text-left">
                Name:
            </div>
            <input
                    type="text"
                    class="border border-transparent md:text-xl py-2 md:px-2 bg-white w-auto flex-grow text-left"
                    :class="{
                    'border-secondary': name
                }"
                    ref="name"
                    v-model="user.name"
                    @focus="edit('name')"
                    @blur="submit('name')"
            >
        </div>
        <div class="w-full py-2 bg-white flex flex-wrap items-center border-b">
            <div class="font-bold w-1/3 sm:w-1/4 md:w-1/6 py-2 px-4 text-left">
                Email:
            </div>
            <input
                    type="text"
                    class="border border-transparent md:text-xl py-2 md:px-2 bg-white w-auto flex-grow text-left"
                    :class="{
                    'border-secondary': email
                }"
                    ref="email"
                    v-model="user.email"
                    @focus="edit('email')"
                    @blur="submit('email')"
            >
        </div>
        <div class="w-full py-2 bg-white flex flex-wrap items-center border-b">
            <div class="font-bold w-1/3 sm:w-1/4 md:w-1/6 py-2 px-4 text-left">
                Cell Phone:
            </div>
            <input
                    type="text"
                    class="border border-transparent md:text-xl py-2 md:px-2 bg-white w-auto flex-grow text-left"
                    :class="{
                    'border-secondary': cell_phone
                }"
                    ref="cell_phone"
                    v-model="user.cell_phone"
                    @focus="edit('cell_phone')"
                    @blur="submit('cell_phone')"
            >
        </div>
        <div class="w-full py-2 bg-white flex flex-wrap items-center border-b">
            <div class="font-bold w-1/3 sm:w-1/4 md:w-1/6 py-2 px-4 text-left">
                Office Phone:
            </div>
            <input
                    type="text"
                    class="border border-transparent md:text-xl py-2 md:px-2 bg-white w-auto flex-grow text-left"
                    :class="{
                    'border-secondary': office_phone
                }"
                    ref="office_phone"
                    v-model="user.office_phone"
                    @focus="edit('office_phone')"
                    @blur="submit('office_phone')"
            >
        </div>
        <div class="w-full py-2 bg-white flex flex-wrap items-center border-b">
            <div class="font-bold w-full sm:w-1/4 md:w-1/6 py-2 px-4 text-left">
                Primary Phone:
            </div>
            <div class="w-auto primary-phone-switch flex px-4">
                <input
                        type="radio"
                        id="switch_left"
                        :value="user.cell_phone"
                        v-model="user.primary_phone"
                        @change="submit('cell_phone')"
                        :checked="primary('cell_phone')"
                />
                <label for="switch_left">Cell Phone</label>
                <input
                        type="radio"
                        id="switch_right"
                        :value="user.office_phone"
                        v-model="user.primary_phone"
                        @change="submit('office_phone')"
                        :checked="primary('office_phone')"
                />
                <label for="switch_right">Office Phone</label>
            </div>
        </div>
        <div class="w-full py-2 bg-white flex flex-wrap items-center border-b">
            <div class="font-bold w-1/3 sm:w-1/4 md:w-1/6 py-2 px-4 text-left">
                MLS&nbsp;IDs:
            </div>
            <input
                    type="text"
                    class="border border-transparent md:text-xl py-2 md:px-2 bg-white w-auto flex-grow text-left"
                    :class="{
                    'border-secondary': mls_id
                }"
                    ref="mls_id"
                    v-model="user.mls_id"
                    @focus="edit('mls_id')"
                    @blur="submit('mls_id')"
            >
        </div>
        <div class="w-full py-2 bg-white flex flex-wrap items-center border-b">
            <div class="font-bold w-1/3 sm:w-1/4 md:w-1/6 py-2 px-4 text-left">
                Company:
            </div>
            <input
                    type="text"
                    class="border border-transparent md:text-xl py-2 md:px-2 bg-white w-auto flex-grow text-left"
                    :class="{
                    'border-secondary': company
                }"
                    ref="company"
                    v-model="user.company"
                    @focus="edit('company')"
                    @blur="submit('company')"
            >
        </div>
        <div class="w-full py-2 bg-white flex flex-wrap items-start border-b">
            <div class="font-bold w-full sm:w-1/4 md:w-1/6 py-2 px-4 text-left">
                Address:
            </div>
            <textarea
                    class="border border-transparent md:text-xl py-2 px-4 md:px-2 bg-white w-full md:w-auto flex-grow text-left"
                    :class="{
                    'border-secondary': address
                }"
                    ref="address"
                    v-model="user.address"
                    @focus="edit('address')"
                    @blur="submit('address')"
                    rows="4"
            />
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            dataUser: {
                type: Object,
                default: () => {
                }
            }
        },
        data() {
            return {
                name: false,
                email: false,
                primary_phone: false,
                cell_phone: false,
                office_phone: false,
                company: false,
                mls_id: false,
                address: false,
            }
        },
        computed: {
            user: function () {
                return this.dataUser;
            }
        },
        methods: {
            edit(key) {
                this[key] = true;
                this.$refs[key].select();
            },
            submit(key) {
                this[key] = false;
                this.$emit('submit-button-clicked', this.user);
            },
            primary(key) {
                return this.user.primary_phone === this.user[key];
            }
        }
    }
</script>
<style>
    .primary-phone-switch input {
        position: absolute !important;
        clip: rect(0, 0, 0, 0);
        height: 1px;
        width: 1px;
        border: 0;
        overflow: hidden;
    }

    .primary-phone-switch label {
        display: inline-block;
        width: 120px;
        background-color: #e4e4e4;
        color: rgba(0, 0, 0, 0.6);
        font-size: 14px;
        text-align: center;
        text-shadow: none;
        padding: 6px 14px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
        -webkit-transition: all 0.1s ease-in-out;
        -moz-transition: all 0.1s ease-in-out;
        -ms-transition: all 0.1s ease-in-out;
        -o-transition: all 0.1s ease-in-out;
        transition: all 0.1s ease-in-out;
    }

    .primary-phone-switch label:hover {
        cursor: pointer;
    }

    .primary-phone-switch input:checked + label {
        background-color: #A5DC86;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .primary-phone-switch label:first-of-type {
        border-radius: 4px 0 0 4px;
    }

    .primary-phone-switch label:last-of-type {
        border-radius: 0 4px 4px 0;
    }
</style>

