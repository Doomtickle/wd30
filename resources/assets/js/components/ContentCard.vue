<template>
    <div class="container mx-auto bg-white flex flex-wrap justify-center mb-8">
        <p class="w-full justify-between flex font-bold items-center text-secondary p-4 border-b border-secondary">
            <span class="text-left w-auto text-3xl font-brand font-bold text-secondary">
                CONTENT
            </span>
            <small class="text-xs w-auto flex-grow text-right">Click on the text you want to edit</small>
        </p>
        <div class="w-full py-2 bg-white flex flex-wrap items-center border-b">
            <div class="font-bold w-full sm:w-1/4 md:w-1/6 py-2 px-4 text-left">
                Tagline:
            </div>
            <input
                type="text"
                class="font-brand text-brand border border-transparent text-3xl py-2 px-4 md:px-2 bg-white w-full md:w-auto flex-grow text-left"
                :class="{
                    'border-secondary': tagline
                }"
                ref="tagline"
                v-model="content.title"
                @focus="edit('tagline')"
                @blur="submit('tagline')"
            >
        </div>
        <div class="w-full py-2 bg-white flex flex-wrap items-start border-b pr-2">
            <div class="font-bold w-full sm:w-1/4 md:w-1/6 py-2 px-4 text-left">
                Body:
            </div>
            <textarea
                class="border border-transparent flex items-center py-4 px-4 md:px-2 bg-white w-full md:w-auto flex-grow text-left leading-normal text-grey-darker"
                :class="{
                    'border-secondary': body
                }"
                ref="body"
                v-model="content.body"
                @focus="edit('body')"
                @blur="submit('body')"
                rows="5"
            />
        </div>
        <div class="w-full py-2 bg-white flex flex-wrap items-center border-b">
            <div class="font-bold w-1/3 sm:w-1/4 md:w-1/6 py-2 px-4 text-left">
                Header Photo:
            </div>
            <div class="px-12 lg:px-4">
            <header-photo-upload :header-photo-path="content.header_photo_path" />
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        dataContent: {
            type: Object,
            default: () => {}
        }
    },
    data() {
        return {
            tagline: false,
            body: false,
        }
    },
    computed: {
        content: function () {
            return this.dataContent;
        }
    },
    methods: {
        edit(key) {
            this[key] = true;
            this.$refs[key].select();
        },
        submit (key) {
            this[key] = false;
            this.$emit('content-edited', this.content);
        }
    }
}
</script>
