<template>
  <form enctype="multipart/form-data" class="w-full" @submit.prevent>
    <div class="w-full py-2 bg-white flex flex-wrap items-center border-b">
      <div class="font-bold w-full md:w-1/6 py-2 px-4 text-left">
        Title:
      </div>
      <input
        ref="title"
        v-model="title"
        :class="{
          'border-secondary': title
        }"
        type="text"
        class="font-brand text-brand border border-transparent text-3xl py-2 px-4 md:px-2 bg-white w-full md:w-auto flex-grow text-left"
      >
    </div>
    <div class="w-full bg-white flex flex-wrap items-start border-b p-4">
      <div class="font-bold w-full md:w-1/6 text-left mb-2">
        Blog Content:
      </div>
      <div class="w-full md:w-5/6">
      <wysiwyg v-model="body" />
      </div>
    </div>
    <div class="w-full bg-white flex flex-wrap items-start border-b p-4">
      <div class="font-bold w-full md:w-1/6 text-left mb-2">
        Featured Photo:
      </div>
      <div class="w-full md:w-5/6 flex flex-wrap justify-center items-center">
        <label for="file" class="bg-blue-lightest border-4 border-dashed w-full h-auto flex flex-wrap justify-center items-center p-6 md:p-16">
          <img 
            v-if="tmpImage !== ''" 
            :src="tmpImage" 
            alt="Featured photo" 
            class="w-1/2 h-auto my-4"
          >
          <div class="w-full flex items-center justify-center">
            <button 
              v-if="tmpImage !== ''" 
              class="rounded p-4 bg-red font-brand text-white text-xl uppercase" 
              @click.prevent="clearPhoto"
            >
              Remove
            </button>
          </div>
          <input 
            id="file" 
            ref="fileInput"
            type="file" 
            name="file" 
            enctype="multipart/form-data"
            class="hidden"
            @change="loadFile($event.target)"
          >
          <span v-if="tmpImage === ''" class="text-2xl font-brand font-bold text-grey-dark">Click here to upload a featured image</span>
        </label>
      </div>
    </div>
    <div class="w-full py-2 bg-white flex flex-wrap items-center border-b items-center justify-center">
      <button class="bg-brand px-4 py-2 my-2 text-uppercase rounded w-auto text-white font-brand text-3xl" @click.prevent="submit">Create Blog Post</button>
    </div>
  </form>

</template>

<script>
export default {
  props: {
    dataTitle: {
      default: '',
      type: String
    },
    dataBody: {
      default: '',
      type: String
    },
    dataPhotoPath: {
      default: '',
      type: String
    },
    submitMethod: {
      default: () => { 
        return { method: 'POST', route: '/blog' }
      },
      type: Object
    }
  },
  data() {
    return {
      title: this.dataTitle,
      body: this.dataBody,
      photoPath: this.dataPhotoPath,
      blogInfo: new FormData(),
      tmpImage: '',
    }
  },
  methods: {
    loadFile (image) {
      if (! image.files.length) {
        return;
      }
      this.tmpImageName = image.files[0].name;
      this.tmpImage = URL.createObjectURL(image.files[0]);

      this.blogInfo.append(image.name, image.files[0], image.files[0].name);
    },
    submit () {
      this.blogInfo.append('title', this.title);
      this.blogInfo.append('body', this.body);
      this.blogInfo.append('_method', this.submitMethod.method);
      window.axios({
        method: this.submitMethod.method,
        url: this.submitMethod.route,
        data: this.blogInfo
      })
        .then(() => {
          this.title = '';
          this.body = '';
          this.blogInfo = new FormData();
          this.tmpImage = '';
          this.$refs.fileInput.value = null;
          this.$emit('submitted');
        })
        .catch(err => {
          alert(err);
        })
    },
    clearPhoto() {
      this.tmpImage = '';
      this.blogInfo = new FormData();
    }
  }
}

</script>
