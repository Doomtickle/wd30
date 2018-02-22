<template>
    <div>
        <div class="switch-container flex justify-center items-center w-full px-4 py-1">
            <label class="active-toggle text-white flex-grow w-8 text-right px-2"
                   :class="{ 'font-bold': activeFilter }" for="activeToggle">
                Active
            </label>
            <div class="switch-box w-8">
                <label class="sudo-switcher bg-brand-darker" :class="{ 'checked': !activeFilter }" >
                    <input
                            type="checkbox"
                            id="activeToggle"
                            :checked="!activeFilter"
                            @change="toggle('activeFilter')"
                    />
                </label>
            </div>
            <label class="active-toggle text-white flex-grow w-8 px-2" :class="{ 'font-bold': !activeFilter }"
                   for="activeToggle">
                Archived
            </label>
        </div>
        <div class="switch-container flex justify-center items-center w-full px-4 py-1">
            <label class="important-toggle text-white flex-grow w-8 text-right px-2"
                   :class="{ 'font-bold': !importantFilter }" for="importantToggle">
                All
            </label>
            <div class="switch-box w-8">
                <label class="sudo-switcher bg-brand-darker" :class="{ 'checked': importantFilter }" >
                    <input
                            type="checkbox"
                            id="importantToggle"
                            :checked="importantFilter"
                            @change="toggle('importantFilter')"
                    />
                </label>
            </div>
            <label class="important-toggle text-white flex-grow w-8 px-2" :class="{ 'font-bold': importantFilter }"
                   for="importantToggle">
                Important
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            activeFilter: {
                type: Boolean,
                default: true
            },
            importantFilter: {
                type: Boolean,
                default: false
            }
        },
        methods: {
            toggle(attribute) {
                this.$emit('toggle', attribute);
            }
        }
    }
</script>

<style>
    .switch-box {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }

    .switch-box input {
        display: none;
    }

    .switch-box .sudo-switcher {
        font-size: 30px;
        width: 2.5em;
        height: 1em;
        border-radius: 3em;
        position: relative;
        cursor: pointer;
        outline: none;
        -webkit-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
    }

    .switch-box .sudo-switcher:after {
        position: absolute;
        content: "";
        width: 1em;
        height: 1em;
        border-radius: 50%;
        background: #fff;
        -webkit-box-shadow: 0 0 .25em rgba(0, 0, 0, .3);
        box-shadow: 0 0 .25em rgba(0, 0, 0, .3);
        -webkit-transform: scale(.7);
        transform: scale(.7);
        left: 0;
        -webkit-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
    }

    .switch-box .sudo-switcher.checked:after {
        left: calc(100% - 1em);
    }
</style>

