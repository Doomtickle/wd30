<template>
    <div
        class="container relative mx-auto flex flex-wrap py-4 px-8 bg-tan-lightest mb-2 shadow border-l-4 border-grey-light"
        :class="{
            'border-red': lead.important
        }"
    >
        <div class="w-full pr-8 text-grey-darkest">
            <small class="text-smoke-lighter"><em>{{ lead.diff }}</em></small>
            <p class="w-full py-3 text-3xl">{{ lead.name }}</p>
            <p class="w-full text-sm">
                <a class="text-brand no-underline w-1/2 pr-2" :href="`mailto:${lead.email}`">{{ lead.email }}</a>
                <a class="text-brand no-underline w-1/2 pr-2" :href="`tel:${lead.email}`">{{ lead.phone }}</a>
            </p>
        </div>    
        <div class="w-full md:w-5/6 lg:w-5/6 xl:w-5/6 flex flex-wrap items-around justify-center text-grey-darkest">
            <p class="w-full pt-4 pb-2">{{ lead.message }}</p>
        </div>
        <div class="w-full xl:w-1/4 lg:w-1/3 xl:mt-2 lg:mt-1 py-4 lg:p-4 xl:p-4  xl:pin-r xl:pin-t lg:pin-r lg:pin-t flex justify-between relative lg:absolute xl:absolute items-center text-grey-darker">
            <a
                @click="toggleImportant(lead.id)"
                class="cursor-pointer text-center mr-4 w-16 h-16"
                :class="{'text-red': lead.important}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current h-8 w-8">
                    <path class="heroicon-ui" d="M6.1 21.98a1 1 0 0 1-1.45-1.06l1.03-6.03-4.38-4.26a1 1 0 0 1 .56-1.71l6.05-.88 2.7-5.48a1 1 0 0 1 1.8 0l2.7 5.48 6.06.88a1 1 0 0 1 .55 1.7l-4.38 4.27 1.04 6.03a1 1 0 0 1-1.46 1.06l-5.4-2.85-5.42 2.85zm4.95-4.87a1 1 0 0 1 .93 0l4.08 2.15-.78-4.55a1 1 0 0 1 .29-.88l3.3-3.22-4.56-.67a1 1 0 0 1-.76-.54l-2.04-4.14L9.47 9.4a1 1 0 0 1-.75.54l-4.57.67 3.3 3.22a1 1 0 0 1 .3.88l-.79 4.55 4.09-2.15z"/>
                </svg>
                <span class="block text-xs">Important</span>
            </a>
            <a
                class="cursor-pointer hover:text-green text-center mr-4 w-16 h-16"
                @click="getNotes(lead.id)"
                v-if="!notesExpanded"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current h-8 w-8">
                    <path class="heroicon-ui" d="M6 2h9a1 1 0 0 1 .7.3l4 4a1 1 0 0 1 .3.7v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2zm9 2.41V7h2.59L15 4.41zM18 9h-3a2 2 0 0 1-2-2V4H6v16h12V9zm-5 4h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2H9a1 1 0 0 1 0-2h2v-2a1 1 0 0 1 2 0v2z"/>
                </svg>
                <span class="block text-xs">Show Notes</span>
            </a>
            <a
                class="cursor-pointer text-green hover:text-grey-darker text-center mr-4 w-16 h-16"
                @click="notesExpanded = false"
                v-if="notesExpanded"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current h-8 w-8">
                    <path class="heroicon-ui" d="M6 2h9a1 1 0 0 1 .7.3l4 4a1 1 0 0 1 .3.7v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2zm9 2.41V7h2.59L15 4.41zM18 9h-3a2 2 0 0 1-2-2V4H6v16h12V9zm-2 4a1 1 0 0 1-1 1H9a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1z"/>
                </svg>
                <span class="block text-xs">Hide Notes</span>
            </a>
            <a
                @click="archive(lead.id)"
                class="cursor-pointer hover:text-red text-center mr-4 w-16 h-16"
                v-if="lead.active"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current h-8 w-8">
                    <path class="heroicon-ui" d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z"/>
                </svg>
                <span class="block text-xs">Archive</span>
            </a>
            <a
                @click="unarchive(lead.id)"
                class="cursor-pointer hover:text-red text-center mr-4 w-16 h-16"
                v-else
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="fill-current h-8 w-8">
                    <path class="heroicon-ui" d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z"/>
                </svg>
                <span class="block text-xs">Unarchive</span>
            </a>
        </div>
        <notes
            :lead="lead"
            :notes="notes"
            v-if="notesExpanded"
            @note-added="getNotes"
        />
    </div>
</template>

<script>
export default {
    props: {
        lead: {
            type: Object,
            default: () => { return this.lead }
        },
        currentPage: {
            type: Number,
            default: this.currentPage
        }
    },
    data () {
        return {
            notes: [],
            notesExpanded: false,
            leadPath: '/leads/' + this.lead.id
        }
    },
    methods: {
        archive(id) {
            axios.patch(this.leadPath, { active: 0 })
                .then(response => {
                    this.$emit('archived', this.viewActiveLeads, this.viewImportantLeads, this.currentPage);
                });
        },
        unarchive(id) {
            axios.patch(this.leadPath, { active: 1 })
                .then(response => {
                    this.$emit('unarchived', this.viewActiveLeads, this.viewImportantLeads, this.currentPage);
                });
        },
        toggleImportant(id) {
            this.lead.important = ! this.lead.important;
            axios({
                method: 'patch',
                url: '/leads/' + id,
                data: {
                    important: this.lead.important
                }
            })
                .then(() => {
                    let status = this.lead.active === 1;
                    this.$emit('important', status, this.currentPage);
                })
        },
        getNotes(id) {
            let url = this.leadPath + '/notes';
            axios.get(url)
                .then(response => {
                    this.notes = response.data;
                });
            this.notesExpanded = true;
        }
    }
}
</script>
