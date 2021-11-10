<template>
    <div>
        <BreezeAuthenticatedLayout>
            <div class="pb-20">
                <div v-for="post in posts.data" :key="post.id">
                    <div class="mx-auto sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">
                        <div class="max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
                            <div class="flex justify-items-start mx-4 mt-4 mb-2 ">
                                <img :src="avatar" class="rounded-full avatar w-12 h-12" alt="avatar">
                                <p class="mt-2 ml-2">
                                    {{ post.user.username }}
                                </p>

                            </div>

                            <div class="px-4 pb-4 border-b border-gray-200">
                                <p class="text-xl">
                                    {{ post.body }}
                                </p>

                                <hr>

<!--                                <button @click="toggleLike(post.id)">Like</button>-->
                                <inertia-link preserve-scroll
                                              method="POST"
                                              as="button"
                                              :href="`/posts/${post.id}/like`">
                                    Like
                                </inertia-link>


                                <div class="flex justify-items-start mt-2 mx-2">
                                    <img :src="avatar" class="rounded-full avatar w-8 h-8 mt-1" alt="avatar">
                                    <p class="mt-2 ml-2">
                                        {{ $page.props.auth.user.username }}
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </BreezeAuthenticatedLayout>


    </div>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import avatar from "/img/background/human.jpg";
import {InertiaLink} from "@inertiajs/inertia-vue3";



export default {
    name: "Index",




    components: {
        BreezeAuthenticatedLayout,
        InertiaLink,
    },
    props: {
        posts: Object,
        user: Object,

    },

    data() {
        return {
            avatar: avatar,
            userPosts: this.posts,
        }
    },


    // created() {
    //     debugger
    // },
}
</script>

<style scoped>

</style>
