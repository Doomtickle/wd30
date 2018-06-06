<template>
    <div class="relative h-32 w-48">
        <img
            :src="src"
            class="max-w-full mx-auto rounded border h-32"
            @mouseover="imageHover = true"
        >
        <form
            action="/broker-logo"
            method="POST"
            enctype="multipart/form-data"
            v-if="imageHover"
        >
            <label
                for="broker_logo"
                class="bg-brand absolute w-full font-semibold text-xl text-white opacity-0 border p-8 text-center flex items-center justify-center rounded shadow"
                :class="{'pin': imageHover, 'opacity-75': imageHover}"
                @mouseout="imageHover = false"
            >
                <span class="opacity-100 text-sm cursor-pointer">Click here to upload a new logo</span>
                <input
                    type="file"
                    name="broker_logo"
                    class="hidden"
                    id="broker_logo"
                    @change="fileChanged(
                        $event.target.name,
                        $event.target.files
                    )"
                >
            </label>
        </form>
    </div>
</template>

<script>
const STATUS_INITIAL = 0, STATUS_SAVING = 1, STATUS_SUCCESS = 2, STATUS_FAILED = 3;

export default {
    props: {
        brokerLogoPath: {
            type: String,
            default: ''
        }
    },
    data () {
        return {
            uploadedFiles: [],
            uploadError: null,
            currentStatus: null,
            uploadFieldName: 'broker_logo',
            src: '',
            imageHover: false
        }
    },
    computed: {
        isInitial() {
            return this.currentStatus === STATUS_INITIAL;
        },
        isSaving() {
            return this.currentStatus === STATUS_SAVING;
        },
        isSuccess() {
            return this.currentStatus === STATUS_SUCCESS;
        },
        isFailed() {
            return this.currentStatus === STATUS_FAILED;
        }
    },
    mounted() {
        this.reset();
        this.src = this.brokerLogoPath != null ? this.brokerLogoPath : 'http://via.placeholder.com/250x150';
    },
    methods: {
        reset() {
            this.currentStatus = STATUS_INITIAL;
            this.uploadedFiles = [];
            this.uploadError   = null;
        },
        save(formData) {
            this.currentStatus = STATUS_SAVING;
            window.axios.post('/broker-logo', formData)
                .then(response => {
                    this.uploadedFiles = [].concat(response.data);
                    this.currentStatus = STATUS_SUCCESS;
                    this.src = response.data;
                })
                .catch(err => {
                    this.uploadError = err.data;
                    this.currentStatus = STATUS_FAILED;
                });
        },
        fileChanged(fieldName, fileList) {
            const formData = new FormData();
            if (! fileList.length) {
                return;
            }
            Array.from(Array(fileList.length).keys())
                .map(x => {
                    formData.append(fieldName, fileList[x], fileList[x].name);
                });

            this.save(formData);
        }
    }
}
</script>
