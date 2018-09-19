<template>
  <div class="justify-center">
    <div class="add-blog bg-white flex flex-wrap mb-8">
      <add-blog-form 
        @submitted="submitted"
      />
    </div>
    <div class="blog-list bg-white flex flex-wrap mb-8">
      <p class="w-full justify-between flex flex-wrap font-bold items-center text-secondary p-4 border-b border-secondary">
        <span class="text-left w-full md:w-1/2 text-3xl font-brand font-bold text-secondary">
          PUBLISHED BLOGS
        </span>
        <small class="text-xs w-full md:w-1/2 flex-grow md:text-right">Click on the blog you want to edit</small>
      </p>
      <div v-for="blog in blogs" :key="blog.id" class="w-full justify-between flex font-bold items-center text-secondary p-4 border-b border-secondary">
        <blog-item :blog="blog" @submitted="submitted" @delete-blog="deleteBlog" />
      </div>
    </div>
  </div>

</template>

<script>
import AddBlogForm from './AddBlogForm.vue';
import BlogItem from './BlogItem.vue';
export default {
  components: {
    AddBlogForm,
    BlogItem
  },
  props: {
    dataBlogs: {
      default: () => [],
      type: Array
    }
  },
  data () {
    return {
      blogs: this.dataBlogs
    }
  },
  watch: {
    dataBlogs: function (newValue) {
      this.blogs = newValue;
    }
  },
  methods: {
    submitted() {
      this.$emit('blog-submitted');
    },
    deleteBlog(id) {
      this.$emit('delete-blog', id);
    }
  }
}

</script>  
<style lang="scss" >
.editr--toolbar {
  flex-wrap: wrap;
  height: auto;

  a.vw-btn-separator {
    i.vw-separator {
      height: 32px;
    }
  }
}
</style>

