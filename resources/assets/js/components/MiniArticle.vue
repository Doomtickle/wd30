<template>
    <div>
        <div class="relative bg-white shadow-md md:rounded overflow-hidden border-b-4 border-brand hover:border-secondary h-full">
            <a :href="post.permalink_url" class="absolute pin hover:shadow-inner z-20" v-if="post.type !== 'video'"></a>
            <div v-if="!textFeatured">
                <div class="md:h-52 md:overflow-hidden" v-if="post.type !== 'video'">
                    <img v-if="post.full_picture != null" class="w-auto h-auto min-h-full min-w-full"
                         :src="post.full_picture">
                </div>
                <div class="md:h-52 md:overflow-hidden w-full" v-if="post.type === 'video'">
                    <iframe
                            :src="post.link"
                            style="border:none;overflow:hidden"
                            scrolling="no"
                            frameborder="0"
                            allowTransparency="true"
                            allowFullScreen="true"
                            width="100%"
                            height="225">
                    </iframe>
                </div>
            </div>
            <div class="pb-2"
                 :class="{
                    'grey-gradient': textFeatured
                 }"
            >
                <div class="flex flex-col justify-center align-middle mb-2"
                     :class="{
                        'h-24': !textFeatured,
                        'h-72': textFeatured
                     }"
                >
                    <p class="p-4 px-6 text-left"
                       :class="{
                          'text-sm': !textFeatured,
                          'text-3xl': textFeatured,
                          'text-grey-darker': !textFeatured,
                          'text-white': textFeatured
                       }"
                    >
                        {{ message }}
                    </p>
                </div>
                <div class="flex flex-wrap items-center justify-center">
                    <a class="facebook text-center w-full no-underline" :href="post.permalink_url" target="_blank">
                        <p class="text-xs text-center w-full pb-2"
                           :class="{
                                'text-grey-darker': !textFeatured,
                                'text-white': textFeatured
                             }">
                            {{ cta }}
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.02 34.02" class="h-4" style="enable-background:new 0 0 50 50; width: 50px;" xml:space="preserve">
                            <path fill="#43609C" d="M17,34A17,17,0,1,0,0,17,17,17,0,0,0,17,34"></path>
                            <path fill="#FFF" d="M12.9,14.13h1.76V12.42a4.57,4.57,0,0,1,.57-2.64A3.13,3.13,0,0,1,18,8.5a11.05,11.05,0,0,1,3.15.32l-.44,2.6a5.94,5.94,0,0,0-1.42-.21c-.68,0-1.3.25-1.3.93v2h2.8l-.2,2.54H18v8.84h-3.3V16.67H12.9Z"></path>
                        </svg>
                    </a>
                </div>
                <div class="mls text-center mt-3 opacity-75"
                     :class="{
                        'text-grey-darker': !textFeatured,
                        'text-white': textFeatured
                     }">
                    <p class="text-xs">Posted {{ post.diff }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            post: {
                type: Object,
                default: this.post
            }
        },
        computed: {
            textFeatured: function () {
                return this.post.type !== 'video' && this.post.full_picture === undefined;
            },
            message: function () {
                let limit = 200;
                let truncated = '';

                if (this.post.message.length > limit) {
                    truncated = this.post.message.substring(0, limit - 9);
                    return truncated + '...';
                }

                return this.post.message;
            },
            cta: function () {
                if (this.post.type === 'video') {
                    return 'View on Facebook';
                }

                return 'Read on Facebook';
            }
        }
    }
</script>
