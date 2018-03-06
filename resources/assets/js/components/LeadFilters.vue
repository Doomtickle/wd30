<template>
    <div>
        <div class="w-auto pt-2">
            <div class="lead-switch flex px-4">
                <input
                        type="radio"
                        id="switch_active"
                        value="active"
                        @change="toggle('activeFilter')"
                        :checked="activeFilter"
                />
                <label for="switch_active">Active</label>
                <input
                        type="radio"
                        id="switch_archived"
                        value="archived"
                        @change="toggle('activeFilter')"
                        :checked="!activeFilter"
                />
                <label for="switch_archived">Archived</label>
            </div>
        </div>
        <div class="w-auto pt-2">
            <div class="lead-switch flex px-4">
                <input
                        type="radio"
                        id="switch_all"
                        value="all"
                        @change="toggle('importantFilter')"
                        :checked="!importantFilter"
                />
                <label for="switch_all">All</label>
                <input
                        type="radio"
                        id="switch_important"
                        value="important"
                        @change="toggle('importantFilter')"
                        :checked="importantFilter"
                />
                <label for="switch_important">Important</label>
            </div>
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
    .lead-switch input {
        position: absolute !important;
        clip: rect(0, 0, 0, 0);
        height: 1px;
        width: 1px;
        border: 0;
        overflow: hidden;
    }

    .lead-switch label {
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

    .lead-switch label:hover {
        cursor: pointer;
    }

    .lead-switch input:checked + label {
        background-color: #A5DC86;
        -webkit-box-shadow: none;
        box-shadow: none;
    }

    .lead-switch label:first-of-type {
        border-radius: 4px 0 0 4px;
    }

    .lead-switch label:last-of-type {
        border-radius: 0 4px 4px 0;
    }
</style>
