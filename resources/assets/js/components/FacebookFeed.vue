<template>
    <div class="w-full">
        <mini-article
            v-for="post in posts"
            :key="post.id"
            :post="post"
            class="w-full md:w-1/2 lg:w-1/3 px-2 py-2"
        />
    </div>
</template>

<script>
export default {
    data () {
        return {
            posts: []
        }
    },
    mounted () {
        window.axios.get('/facebook-feed')
            .then(response => {
                this.posts = response.data.posts;
            })
    }
}

</script>
