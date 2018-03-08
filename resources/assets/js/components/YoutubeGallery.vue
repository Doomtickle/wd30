<template>
    <div>
        <youtube-video
            v-for="video in videos"
            :key="video.id.videoId"
            :video="video"
            class="w-full md:w-1/2 lg:w-1/3 px-2 py-2"
        />
    </div>
</template>

<script>
export default {
    data () {
        return {
            videos: []
        }
    },

    mounted () {
        window.axios.get('youtube-gallery')
            .then(response => {
                this.videos = response.data;
            });
    }
}

</script>
