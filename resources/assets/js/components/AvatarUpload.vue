<template>
    <div class="relative">
        <img
            :src="src"
            class="max-w-full mx-auto rounded border"
            @mouseover="imageHover = true"
        >
        <form
            action="/avatar"
            method="POST"
            enctype="multipart/form-data"
            v-if="imageHover"
        >
            <label
                for="avatar"
                class="bg-brand absolute w-full font-semibold text-xl text-white opacity-0 border p-8 text-center flex items-center justify-center rounded shadow"
                :class="{'pin': imageHover, 'opacity-75': imageHover}"
                @mouseout="imageHover = false"
            >
                <span class="opacity-100 text-sm cursor-pointer">Click here to upload a new photo</span>
                <input
                    type="file"
                    name="avatar"
                    class="hidden"
                    id="avatar"
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
import { upload } from '../services/file-upload.service.js';
const STATUS_INITIAL = 0, STATUS_SAVING = 1, STATUS_SUCCESS = 2, STATUS_FAILED = 3;

export default {
    props: {
        avatarPath: {
            type: String,
            default: ''
        }
    },
    data () {
        return {
            uploadedFiles: [],
            uploadError: null,
            currentStatus: null,
            uploadFieldName: 'avatar',
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
        this.src = 'storage/' + this.avatarPath;
    },
    methods: {
        reset() {
            this.currentStatus = STATUS_INITIAL;
            this.uploadedFiles = [];
            this.uploadError   = null;
        },
        save(formData) {
            this.currentStatus = STATUS_SAVING;
            upload(formData)
                .then(response => {
                    this.uploadedFiles = [].concat(response);
                    this.currentStatus = STATUS_SUCCESS;
                    this.src = 'storage/' + response;
                })
                .catch(err => {
                    this.uploadError = err;
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
