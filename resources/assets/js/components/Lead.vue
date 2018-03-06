<template>
    <div
        class="container relative mx-auto flex flex-wrap py-4 px-8 bg-white mb-2 shadow border-l-4 border-grey-light"
        :class="{
            'border-red': lead.important
        }"
    >
        <div class="w-full pr-8 text-grey-darkest">
            <small class="text-smoke-lighter"><em>{{ lead.diff }}</em></small>
            <p class="w-full block py-3 text-3xl">{{ lead.name }}</p>
            <p class="w-full flex flex-wrap block text-sm justify-start mb-2 md:mb-0">
                <a class="text-brand no-underline pr-4 mb-2" :href="`mailto:${lead.email}`">{{ lead.email }}</a>
                <a class="text-brand no-underline" :href="`tel:${lead.phone}`">{{ lead.phone }}</a>
            </p>
        </div>
        <div class="w-full md:w-5/6 lg:w-5/6 xl:w-5/6 flex flex-wrap items-around justify-center text-grey-darkest">
            <p class="w-full pt-4 pb-2">{{ lead.message }}</p>
        </div>
        <div class="w-full flex flex-wrap text-grey-darker" v-if="lead.listing != null">
            <p class="w-full flex flex-wrap block py-3 text-xl border-b border-grey-lighter">MLS #{{ lead.listing }}</p>
            <div class="w-full md:w-1/2 flex flex-wrap py-3 px-4">
                <p class="block w-full mb-4 text-lg font-bold">Address:</p>
                <p class="block w-full mb-4 pl-4">{{ lead.listing_address }}</p>
                <a
                    :href="'https://www.google.com/maps/dir/?api=1&destination=' + lead.listing_latitude + ',' + lead.listing_longitude"
                    class="text-brand w-full md:w-1/3 block mb-4 pl-4"
                >
                    DIRECTIONS
                </a>
                <a
                    :href="'/listing/' + lead.listing"
                    class="text-brand w-auto block px-4"
                >
                    VIEW PROPERTY
                </a>
            </div>
            <div class="w-full md:w-1/2 flex flex-wrap py-3 px-4">
                <p class="block w-full mb-4 text-lg font-bold">Listing Agent:</p>
                <p class="block w-full mb-4 pl-4">Name: {{ lead.agent }}</p>
                <a href="#" class="text-brand w-full  no-underline md:w-1/2 block pr-4 mb-4 pl-4">Email: {{ lead.agent_email }}</a>
                <a href="#" class="text-brand no-underline w-auto block px-4">Phone: {{ lead.agent_phone }}</a>
            </div>
        </div>
        <div class="w-full xl:w-1/4 lg:w-1/3 xl:mt-2 lg:mt-1 py-4 lg:p-4 xl:p-4  xl:pin-r xl:pin-t lg:pin-r lg:pin-t flex justify-between relative lg:absolute xl:absolute items-center text-grey-darker">
            <a
                @click="toggleImportant(lead.id)"
                class="cursor-pointer text-center mr-4 w-16 h-16"
                :class="{'text-red': lead.important}"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark">
                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                </svg>
                <span class="block text-xs">Important</span>
            </a>
            <a
                class="cursor-pointer hover:text-green text-center mr-4 w-16 h-16"
                @click="getNotes(lead.id)"
                v-if="!notesExpanded"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                <span class="block text-xs">Show Notes</span>
            </a>
            <a
                class="cursor-pointer text-green hover:text-grey-darker text-center mr-4 w-16 h-16"
                @click="notesExpanded = false"
                v-if="notesExpanded"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline>
                </svg>
                <span class="block text-xs">Hide Notes</span>
            </a>
            <a
                @click="archive(lead.id)"
                class="cursor-pointer hover:text-red text-center mr-4 w-16 h-16"
                v-if="lead.active"
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder-plus">
                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="12" y1="11" x2="12" y2="17"></line><line x1="9" y1="14" x2="15" y2="14"></line>
            </svg>
                <span class="block text-xs">Archive</span>
            </a>
            <a
                @click="unarchive(lead.id)"
                class="cursor-pointer hover:text-red text-center mr-4 w-16 h-16"
                v-else
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder-minus">
                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="9" y1="14" x2="15" y2="14"></line>
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
                .then(() => {
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
