<template>
    <div class="relative">
        <img
            :src="src"
            class="max-w-full mx-auto rounded border"
            @mouseover="imageHover = true"
        >
        <form
            action="/header-photo"
            method="POST"
            enctype="multipart/form-data"
            v-if="imageHover"
        >
            <label
                for="header_photo"
                class="bg-brand absolute w-full font-semibold text-xl text-white opacity-0 border p-8 text-center flex items-center justify-center rounded shadow"
                :class="{'pin': imageHover, 'opacity-75': imageHover}"
                @mouseout="imageHover = false"
            >
                <span class="opacity-100 text-sm cursor-pointer">Click here to upload a new photo</span>
                <input
                    type="file"
                    name="header_photo"
                    class="hidden"
                    id="header_photo"
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
        headerPhotoPath: {
            type: String,
            default: ''
        }
    },
    data () {
        return {
            uploadedFiles: [],
            uploadError: null,
            currentStatus: null,
            uploadFieldName: 'header_photo',
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
        this.src = this.headerPhotoPath != null ? this.headerPhotoPath : 'http://via.placeholder.com/1920x750';
    },
    methods: {
        reset() {
            this.currentStatus = STATUS_INITIAL;
            this.uploadedFiles = [];
            this.uploadError   = null;
        },
        save(formData) {
            this.currentStatus = STATUS_SAVING;
            window.axios.post('/header-photo', formData)
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
