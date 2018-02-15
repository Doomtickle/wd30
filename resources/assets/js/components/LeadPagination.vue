<template>
<div>
    <ul class="list-reset flex justify-center md:justify-start flex-wrap">
        <li class="mr-2 w-auto">
            <button class="text-grey-darker px-4 py-2 text-center cursor-pointer shadow rounded-sm"
               :disabled="pagination.prev_page_url == null"
               :class="{
                   'cursor-not-allowed': pagination.prev_page_url == null,
                   'bg-brand-lightest': pagination.prev_page_url == null,
                   'bg-tan-lightest': pagination.prev_page_url != null
                   }"

               @click="page(pagination.prev_page_url)"
            >
                   Prev
            </button>
        </li>
        <li class="mr-2 w-auto">
            <a class="text-grey-darker bg-brand-lightest px-4 py-2 text-center flex shadow items-center rounded-sm"
            >
            {{ pagination.current_page }}
            </a>
        </li>
        <li class="mr-2 w-auto">
            <button class="text-grey-darker bg-tan-lightest px-4 py-2 text-center cursor-pointer shadow rounded-sm"
               :disabled="pagination.next_page_url == null"
               :class="{
                   'cursor-not-allowed': pagination.next_page_url == null,
                   'opacity-50': pagination.next_page_url == null
                   }"

               @click="page(pagination.next_page_url)"
            >
                   Next
            </button>
        </li>
        <li class="w-full md:w-auto text-center md:text-left mb-8 md:mb-0">
            <p class="m-2 align-middle font-thin text-dbblue-darkest">Showing {{ pagination.from }} - {{ pagination.to }} out of {{ pagination.total }}</p>
        </li>
    </ul>
</div>
</template>

<script>
    export default {
        props: ['pagination'],
        methods: {
            page(url) {
                this.$emit('page', url);
            }
        }
    }
</script>
