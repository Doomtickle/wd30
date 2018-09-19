<template>
  <div class="w-full flex flex-wrap items-center">
    <form class="w-full flex flex-wrap items-center justify-center">
      <label :for="'blog_' + blog.id" class="sm:w-1/2 md:w-1/6 cursor-pointer mb-2">
        <span class="absolute inline-block p-1 px-2 text-sm border border-grey bg-grey-light text-grey-darker">Edit</span>
        <img 
          v-if="updatedImage !== ''" 
          :src="updatedImage" 
          alt="Featured photo" 
          class="w-full h-auto"
        >
        <input 
          :id="'blog_' + blog.id"
          :ref="'blog_' + blog.id"
          type="file" 
          enctype="multipart/form-data"
          class="hidden"
          @change="loadFile($event.target)"
        >
      </label>
      <div class="w-full md:w-5/6 flex flex-wrap md:px-4">
        <input 
          v-if="isExpanded" 
          v-model="blog.title" 
          :class="{'border border-brand': editTitle}"
          type="text"  
          class="w-full text-2xl md:text-3xl text-brand font-brand mb-2" 
          autofocus
        >
        <span 
          v-else 
          class="w-5/6 text-2xl md:text-3xl text-brand font-brand mb-2" 
          @click="toggleEditor" 
        >
          {{ blog.title }}
        </span>
        <span class="w-full text-xs font-normal text-grey-dark py-2 text-left">Last updated: {{ diffForHumans(blog.updated_at) }}</span>
        <div class="w-full rounded flex flex-wrap justify-between items-end bg-grey-lighter p-4">
          <button v-if="isExpanded" class="p-2 border border-brand w-auto bg-secondary text-white text-md" @click.prevent="toggleEditor">Close Editor</button>
          <button v-if="!isExpanded" class="p-2 border border-brand w-auto bg-secondary text-white text-md" @click.prevent="toggleEditor">Edit Post</button>
          <button class="p-2 border border-red w-auto bg-red text-white text-md" @click.prevent="deleteBlog" >Delete</button>
        </div>
      </div>
      
    </form>
    <div v-if="isExpanded" class="w-full font-normal flex text-black flex-wrap items-center py-4" >
      <wysiwyg v-model="blog.body" />
    </div>
    <div v-if="isExpanded" class="w-full flex justify-center items-center my-2">
      <button class="bg-brand px-4 py-2 my-2 text-uppercase rounded w-auto text-white font-brand text-3xl" @click.prevent="updateBlog">Update Blog Post</button>
    </div>
  </div>
</template>

<script>
import moment from 'moment';
export default {
  props: { 
    blog: { 
      type: Object, 
      default: () => {} 
    } 
  },
  data() {
    return {
      isExpanded: false,
      editTitle: false,
      updatedImage: this.blog.featured_photo_path,
      updatedImageName: '',
      updated: new FormData()
    }
  },
  methods: {
    diffForHumans(date) {
      return moment(date).fromNow();
    },
    toggleEditor() {
      this.isExpanded = ! this.isExpanded;
    },
    deleteBlog() {
      this.$emit('delete-blog', this.blog.id);
    },
    updateBlog() {
      this.updated.append('title', this.blog.title);
      this.updated.append('body', this.blog.body);
      this.updated.append('_method', 'PATCH');
      window.axios({
        method: 'POST',
        url: '/blog/' + this.blog.id,
        data: this.updated
      })
        .then(() => {
          this.updated = new FormData();
          this.$emit('submitted');
          this.isExpanded = false;
        })
        .catch(err => {
          alert(err);
        })
    },
    loadFile (image) {
      if (! image.files.length) {
        return;
      }
      
      this.updatedImageName = image.files[0].name;
      this.updatedImage = URL.createObjectURL(image.files[0]);

      this.updated.append('file', image.files[0], image.files[0].name);
    },

  }
}

</script>
