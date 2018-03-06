<template>
    <div class="text-grey-darkest flex flex-wrap justify-start lg:p-8 w-full">
        <div class="w-full mb-8 flex flex-wrap items-start">
            <div class="w-full">
                <textarea rows="2" v-model="newNote" class="rounded-t border p-4 w-full"></textarea>
                <button class="bg-beachy-green text-white px-8 py-2 rounded-b w-full" @click="addNote">Add Note</button>
            </div>
        </div>
        <note v-for="note in notes" :key="note.id" :note="note"></note>
    </div>
</template>

<script>
export default {
    props: ['notes', 'lead'],
    data () {
        return {
            newNote: ''
        }
    },
    methods: {
        addNote() {
            axios({
                method: 'post',
                url: '/notes',
                data: {
                    lead_id: this.lead.id,
                    message: this.newNote
                }
            })
                .then(response => {
                    this.$emit('note-added', this.lead.id);
                    this.newNote = '';
                })
        }
    }
}
</script>
