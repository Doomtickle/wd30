<template>
  <div>
    <div class=" relative flex flex-col bg-white shadow-md md:rounded overflow-hidden border-b-4 border-brand hover:border-secondary h-full">
      <a 
        :href="'/blog/' + post.id" 
        class="absolute pin hover:shadow-inner z-20"
      />
      <div class="md:overflow-hidden">
        <img 
          :src="post.featured_photo_path"
          class="w-auto h-auto min-h-full min-w-full"
        >
      </div>
      <div class="bg-white flex flex-col justify-between flex-grow">
        <div class="title-area">
          <p class="p-4 px-6 text-center text-brand font-brand text-4xl">
            {{ post.title }}
          </p>
          <p class="text-xs text-center text-grey">posted {{ postDate }} </p>
        </div>
        <div class="article-area">
          <p class="py-4 px-6 text-center text-grey-dark font-normal text-lg leading-normal">
            {{ article }}
          </p>
        </div>
        <div class="cta-area">
          <p class="text-center w-full pb-4 text-white" >
              <a 
                :href="'/blog/' + post.id" 
                class="facebook text-center w-full no-underline text-brand" 
                target="_blank"
              >
              Read more...
              </a>
          </p> 
        </div>       
      </div>
    </div>
  </div>
</template>
<script>
let moment = require('moment');

export default {
  props: {
    post: {
      type: Object,
      default: () => {}
    }
  },
  computed: {
    article: function () {
      let limit = 200;
      let string = this.post.body;
      let truncated = '';
      let stripedHtml = string.replace(/<[^>]+>/g, '');

      if (stripedHtml.length > limit) {
        truncated = stripedHtml.substring(0, limit - 9);
        return truncated + '...';
      }

      return stripedHtml;
    },
    postDate: function () {
      let date = this.post.updated_at
      return moment(date).format('MMMM D, YYYY');
    }
  }
}
</script>
