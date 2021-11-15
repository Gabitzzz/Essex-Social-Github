<template>
    <BreezeAuthenticatedLayout>
        <div v-for="post in posts.data" :key="post.id" >
            <div class="mx-auto sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">
                <div class="max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
                    <div class="flex justify-items-start mx-4 mt-4 mb-2 ">
                        <img :src="avatar" class="rounded-full avatar w-12 h-12" alt="avatar">
                        <p class="mt-2 ml-2">
<!--                            {{ // post.user.username }}-->

                            {{post}}
                        </p>
                    </div>


                    <div class="px-4 pb-4 border-b border-gray-200">
                        <!--                                <hr>-->
                        <p class="text-xl px-4 py-2">
                            {{ post.body }}
                        </p>

                        <hr>
                        <!--                                                                <button @click="toggleLike(post.id)">Like</button>-->
<!--                        <inertia-link preserve-scroll-->
<!--                                      method="POST"-->
<!--                                      as="button"-->
<!--                                      :href="`/posts/${post.id}/like`">-->
<!--                            Like-->
<!--                        </inertia-link>-->


                        <div class="flex justify-between">
                            <!-- ... -->
                            <div class="flex justify-self-star mt-2">
                                <img :src="avatar" class="rounded-full avatar w-8 h-8 mt-1" alt="avatar">
                                <p class="mt-2 ml-2">
                                    {{ $page.props.auth.user.username }}
                                </p>
                            </div>

                            <div class="flex justify-end mt-4">
                                <div class="flex   ">
                                    <button class=" h-6 w-6 rounded-full bg-red-600">
                                    </button>

                                    <button class="ml-1  h-6 w-6 rounded-full bg-blue-400">
                                    </button>

                                    <button class="ml-1  h-6 w-6 rounded-full bg-green-700">
                                    </button>
                                </div>
                            </div>
                            <!-- ... -->
                            <!-- ... -->
                            <!-- ... -->
                            <!-- ... -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {InertiaLink} from "@inertiajs/inertia-vue3";
import {debounce} from "lodash/function";
import avatar from "/img/background/human.jpg";


export default {
    name: "Posts",
    props: {
        posts: Object,
        post: Object,
        user: Object,
    },
    data() {
        return {
            userPosts: this.posts,
            avatar: avatar,


        }
    },
    components: {
        InertiaLink,
        BreezeAuthenticatedLayout
    },
    watch: {
        posts(newPosts) {
            this.userPosts = newPosts;
        }
    },


}
</script>

<style scoped>

</style>
