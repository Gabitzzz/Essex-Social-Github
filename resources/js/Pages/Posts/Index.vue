<template>
    <div>
        <BreezeAuthenticatedLayout>

            <div class="mx-2 sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">
                <div class="max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
                    <div class="flex">

                        <inertia-link :href="route('profile', post.user.username)">
                            <div class="flex justify-items-start mx-2 mt-2 mb-2 ">
                                <!--                    <img :src="avatar" class="rounded-full avatar w-12 h-12" alt="avatar">-->

                                <img
                                    :src="showImage() + post.user.avatar"
                                    class="avatar rounded-full avatar w-10 h-10"
                                    alt="avatar"
                                />

                                <div>
                                    <p class="ml-2">
                                        {{ post.user.username }}
                                    </p>
                                    <span class="italic ml-2 align-text-top" style="font-size: 10px;">{{
                                            post.timeAgo
                                        }}</span>

                                </div>


                            </div>
                        </inertia-link>

                        <inertia-link preserve-scroll
                                      v-if="post.user.id === $page.props.auth.user.id"
                                      class=""
                                      as="button"
                                      :href="route('posts.edit', post.id)"
                        >
                            ...
                        </inertia-link>


                    </div>


                    <div class="px-2 pb-1 border-b border-gray-200">
                        <p class="text-xl px-2">
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
                            <div class="flex justify-self-star mt-1">
                                <!--                        <img :src="avatar" class="rounded-full avatar w-8 h-8 mt-1" alt="avatar">-->
                                <img
                                    :src="showImage() + $page.props.auth.user.avatar"
                                    class="avatar rounded-full avatar w-6 h-6 mt-1"
                                    alt="avatar"
                                />

                                <p class="mt-1 ml-2 text-sm">
                                    {{ $page.props.auth.user.username }}
                                </p>
                            </div>

                            <div class="flex justify-end mt-2">
                                <div class="flex">
                                    <Like :post="post"></Like>

                                    <Dislike :post="post" class="ml-1"></Dislike>

                                    <InertiaLink @click="back"
                                                 class="ml-1  h-6 w-6 rounded-full bg-blue-400 text-center text-white font-extrabold">
                                        <strong>
                                            &#60;
                                        </strong>
                                    </InertiaLink>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <form @submit.prevent="submit" class="w-full">
                    <div class="flex mt-5">
                        <!--                        <img :src="avatar" class="rounded-full avatar w-10 h-10 mx-1" alt="avatar">-->

                        <img
                            :src="showImage() + $page.props.auth.user.avatar"
                            class="avatar rounded-full avatar w-10 h-10"
                            alt="avatar"
                        />


                        <BreezeInput id="body" type="text" class="block w-full h-10 mx-1" v-model="form.body"
                                     placeholder="Say something.."
                                     required autofocus autocomplete="name"/>


                        <!--                    <textarea name="post" rows="3" class="border rounded px-2 py-2 w-full"-->
                        <!--                              :placeholder="`Post something  ...`" v-model="form.body"></textarea>-->
                        <button type="submit" class="button px-6 shadow-2xl"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                            SUBMIT
                        </button>
                    </div>

                    <div class="flex justify-between my-3">
                        <div>

                        </div>
                    </div>
                </form>

                <div v-for="(comment, index) in comments" :key="index">
                    <CommentItem :comment="comment"></CommentItem>
                </div>
            </div>


        </BreezeAuthenticatedLayout>
    </div>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import PostForm from "@/Components/PostForm";
import CombinedComments from "@/Components/CombinedComments";
import CommentItem from "@/Components/CommentItem";
import avatar from "/img/background/human.jpg";
import BreezeInput from '@/Components/Input.vue';
import Like from "@/Components/Like";
import Dislike from "@/Components/Dislike";
import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
    name: "Index",
    components: {
        CombinedComments,
        PostForm,
        BreezeAuthenticatedLayout,
        CommentItem,
        BreezeInput,
        Like,
        Dislike,
        InertiaLink,
    },
    props: {
        post: Object,
        comments: Array,
        // user: Object,
        likes: Array,
    },
    data() {
        return {
            avatar: avatar,
            form: this.$inertia.form({
                body: null,
                image: null,
            }),
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('comments.store', this.post), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.body = null
                }
            })
        },

        showImage() {
            return "/storage/";
        },

        back() {
            window.history.back();
        },
    }
}
</script>

<style scoped>
.button {
    border-radius: 25px;
    color: ghostwhite;
    background-color: black;
    /*width: 100%;*/
    /*display: inline;*/
    text-align: center;
    font-size: 12px;
    font-family: 'Nunito', sans-serif;
}
</style>
