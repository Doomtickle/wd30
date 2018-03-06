<template>
<div class="w-full md:w-3/4 flex flex-wrap justify-center md:justify-start items-center">
    <mls-number
        v-for="mlsNumber in mlsNumbers"
        :key="mlsNumber.id"
        :mls-number="mlsNumber"
        @delete-number="deleteNumber"
        class="w-1/2 md:w-1/6 flex flex-wrap rounded px-2 py-3 m-2 text-center bg-brand text-white items-center"
    />
    <div class="w-full text-brand flex flex-wrap items-center">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="36"
            height="36"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="feather m-4 feather-plus-circle text-center"
            @click="addingMlsNumber = ! addingMlsNumber"
        >
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="12" y1="8" x2="12" y2="16"></line>
            <line x1="8" y1="12" x2="16" y2="12"></line>
        </svg>
        <input
                type="text"
                class="border border-secondary mx-2 md:text-xl py-2 md:px-2 bg-white w-full md:w-1/4 text-left"
                v-model="mls_id"
                v-if="addingMlsNumber"
                @keydown.enter="addNumber"
                @blur="onBlur"
        />
        <span
            class="block w-auto border border-red p-4 m-2"
            v-if="error != ''"
        >
            {{ error }}
        </span>
    </div>
</div>
</template>

<script>
export default {
    data () {
        return {
            mlsNumbers: [],
            addingMlsNumber: false,
            mls_id: '',
            error: ''
        }
    },
    mounted () {
        this.getMlsNumbers();
    },
    methods: {
        getMlsNumbers () {
            window.axios.get('mls-numbers')
                .then(response => {
                    this.mlsNumbers = response.data;
                })
        },
        deleteNumber(id) {
            let vm = this;
            window.axios.delete('/mls-numbers/' + id)
                .then(() => {
                    vm.getMlsNumbers();
            })
        },
        addNumber () {
            let vm = this;
            vm.error = '';
            window.axios.post('/mls-numbers', {
                mls_id: vm.mls_id.toUpperCase()
            })
            .then(response => {
                vm.addingMlsNumber = false;
                vm.mlsNumbers.push(response.data);
            })
            .catch(err => {
                vm.error = err.response.data.errors.mls_id[0];
            })
        },
        onBlur () {
            this.error = '';
            this.addingMlsNumber = false;
        }
    }
}
</script>
