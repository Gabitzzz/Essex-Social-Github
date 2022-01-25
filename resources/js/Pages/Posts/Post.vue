<template>
    <div class="mt-5 mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
        <inertia-link preserve-scroll
                      :href="route('post.show', post.id)"
        >
            <div class="mx-2 max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
                <div class="flex">
                    <inertia-link :href="route('profile', post.user.username)">
                        <div class="flex justify-items-start mx-2 mt-2 mb-2 ">
                            <img
                                :src="showImage() + post.user.avatar || showImage() + 'default-avatar.png'"
                                class="avatar rounded-full avatar w-10 h-10"
                                alt="avatar"
                            />
                            <div>
                                <p class="ml-2">
                                    {{ post.user.username }}
                                </p>
                                <span class="italic ml-2 align-text-top" style="font-size: 10px;">
                                       {{ post.timeAgo }}
                                </span>
                            </div>
                        </div>
                    </inertia-link>

                    <inertia-link preserve-scroll
                                  v-if="post.user.id === $page.props.auth.user.id"
                                  class="   "
                                  as="button"
                                  :href="route('posts.edit', post.id)"
                    >
                        ...
                    </inertia-link>
                </div>

                <div class="px-2 border-b border-gray-200">
                    <p class="text-xl px-2 py-2">
                        {{ post.body }}
                    </p>

                    <div v-if="post.image" class="flex justify-center">

                        <img
                            :src="showImage() +  post.image"
                            class="avatar w-2/3 h-2/3"
                            alt="avatar"
                        />
                    </div>

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
                        <!--                        <div class="flex justify-self-star mt-1">-->
                        <!--                            &lt;!&ndash;                        <img :src="avatar" class="rounded-full avatar w-8 h-8 mt-1" alt="avatar">&ndash;&gt;-->


                        <!--                            <p class="mt-1 ml-2 text-sm">-->
                        <!--                               7 Likes-->
                        <!--                            </p>-->
                        <!--                        </div>-->

                        <!--                        <div class="flex justify-end mt-2">-->
                        <!--                            <div class="flex">-->
                        <!--                                <Like :post="post"></Like>-->

                        <!--                                <Dislike :post="post" class="ml-1"></Dislike>-->

                        <!--                                <InertiaLink :href="route('post.show', post.id)" :post="post.id"-->
                        <!--                                             class="ml-1  h-6 w-6 rounded-full bg-blue-400">-->
                        <!--                                </InertiaLink>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                    </div>

                    <div>
                        <div class="flex">
                            <img
                                :src="showImage() + $page.props.auth.user.avatar"
                                class="avatar rounded-full avatar w-8 h-8 mt-2 ml-2"
                                alt="avatar"
                            />

                            <!--                            <BreezeInput id="body" type="text" class="block w-full h-10 mx-1" v-model="form.body"-->
                            <!--                                         placeholder="Say something.."-->
                            <!--                                         required autofocus autocomplete="name"/>-->

                            <div class="bg-white h-8 w-full rounded-full shadow-md m-2 text-xs  border border-gray-300">
                                <p class="mt-2 ml-4 text-gray-700">
                                    say something
                                </p>
                            </div>

                            <div class="flex mt-3">
                                <Like :post="post" class="ml-1"></Like>

                                <Dislike :post="post" class="ml-1 mr-1"></Dislike>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

        </inertia-link>
    </div>
</template>

<script>
import avatar from "/img/background/human.jpg";
import Like from "@/Components/Like.vue";
import Dislike from "@/Components/Dislike";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import CombinedComments from "@/Components/CombinedComments";
import PostForm from "@/Components/PostForm";

export default {
    name: "Post",
    data() {
        return {
            avatar: avatar,
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
    methods: {
        showImage() {
            return "/storage/";
        },
    }
}
</script>


