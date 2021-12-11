<template>
    <div class="mx-auto sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">
        <div class="max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
            <div class="flex">
                <div class="flex justify-items-start mx-4 mt-4 mb-2 ">
<!--                    <img :src="avatar" class="rounded-full avatar w-12 h-12" alt="avatar">-->
                    <img
                        :src="showImage() + post.user.avatar"
                        class="rounded-full avatar w-12 h-12"
                        alt="avatar"
                    />


                    <p class="mt-2 ml-2">
                        {{ post.user.username }}
                    </p>
                </div>
                <inertia-link preserve-scroll
                              v-if="post.user.id === $page.props.auth.user.id"
                              as="button"
                              :href="route('posts.edit', post.id)"
                >
                    ...
                </inertia-link>


            </div>


            <div class="px-4 pb-4 border-b border-gray-200">
                <p class="text-xl px-4 py-2">
                    {{ post.body }}
                </p>

                <!--                LIKES   -->
                <inertia-link preserve-scroll
                              method="POST"
                              as="button"
                              :href="route('likes.toggle', post.id)"
                >
                    <div class="flex text-xs">

                        <div v-if="post.likes.length === 0">

                        </div>

                        <div v-else-if="post.likes.length === 1">
                            {{ post.likes.length }} Like &nbsp;
                        </div>

                        <div v-else>
                            {{ post.likes.length }} Likes &nbsp;
                        </div>

                        <!--                DISLIKES    -->
                        <div v-if="post.dislikes.length === 0">

                        </div>

                        <div v-else-if="post.dislikes.length === 1">
                            {{ post.dislikes.length }} Dislike &nbsp;
                        </div>

                        <div v-else>
                            {{ post.dislikes.length }} Dislikes &nbsp;
                        </div>


<!--                        <div v-if="post.comments.length === 0">-->

<!--                        </div>-->

<!--                        <div v-else-if="post.comments.length === 1">-->
<!--                            {{ post.comments.length }} Dislike &nbsp;-->
<!--                        </div>-->

<!--                        <div v-else>-->
<!--                            {{ post.comments.length }} Dislikes &nbsp;-->
<!--                        </div>-->
                    </div>
                </inertia-link>

                <hr>

                <div class="flex justify-between">
                    <!-- ... -->
                    <div class="flex justify-self-star mt-2">
<!--                        <img :src="avatar" class="rounded-full avatar w-8 h-8 mt-1" alt="avatar">-->

                        <img
                            :src="showImage() + $page.props.auth.user.avatar"
                            class="rounded-full avatar w-8 h-8 mt-1"
                            alt="avatar"
                        />

                        <p class="mt-2 ml-2">
                            {{ $page.props.auth.user.username }}
                        </p>
                    </div>

                    <div class="flex justify-end mt-4">
                        <div class="flex">
                            <Like :post="post"></Like>

                            <Dislike :post="post" class="ml-1"></Dislike>

                            <InertiaLink :href="route('post.show', post.id)" :post="post.id"
                                         class="ml-1  h-6 w-6 rounded-full bg-blue-400">
                            </InertiaLink>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Like from "@/Components/Like.vue";
import Dislike from "@/Components/Dislike";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import CombinedComments from "@/Components/CombinedComments";
import PostForm from "@/Components/PostForm";

export default {
    name: "Post",
    data() {
        return {
            avatar: null,
            form: this.$inertia.form({
                body: this.body,
                user_id: this.post.user_id,
            }),
            likeForm: this.$inertia.form({
                userPost: this.post
            }),
            dislikeForm: this.$inertia.form({
                userPosts: this.post
            }),
        }
    },
    components: {
        Like,
        Dislike,
        InertiaLink,
        CombinedComments,
        PostForm,
    },
    props: {
        post: Object,
        user: Object,
        comments: Array,
    },
    methods:{
        showImage() {
            return "/storage/";
        },
    },

}
</script>

<style scoped>

</style>
