<template>


    <BreezeAuthenticatedLayout>
        <div class="mt-5">
            <!--        <div class="mt-5 mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">-->
            <div class="mx-2 max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
                <div class="flex">
                    <inertia-link :href="route('profile', post.user.username)">
                        <div class="flex justify-items-start m-2">
                            <img
                                :src="showImage() + post.user.avatar"
                                class="avatar rounded-full avatar w-10 h-10 ml-2 my-2"
                                alt="avatar"
                            />

                            <div>
                                <p class="ml-2 mt-2">
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

                <div class="px-2 pb-1 border-b border-gray-200">
                    <p class="text-sm px-4">
                        {{ post.body }}
                    </p>

                    <div v-if="post.image" class="flex justify-center">
                        <img
                            :src="showImage() +  post.image"
                            class="avatar  avatar w-2/3 h-2/3"
                            alt="avatar"
                        />
                    </div>

                    <!--                LIKES   -->
                    <inertia-link preserve-scroll
                                  method="POST"
                                  as="button"
                                  :href="route('likes.toggle', post.id)"
                    >
                        <div class="flex text-xs px-4 mt-2">
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
                        </div>
                    </inertia-link>

                    <hr>

                    <div class="flex justify-between">
                    </div>

                    <div>
                        <div class="flex">
                            <img
                                :src="showImage() + $page.props.auth.user.avatar"
                                class="avatar rounded-full avatar w-8 h-8 mt-2 ml-2"
                                alt="avatar"
                            />

                            <div
                                class="h-8 w-full rounded-full  mt-2 text-xs ml-2 mr-2 ">
                                <p class="mt-2 ml-4 text-gray-700">
                                </p>
                            </div>

                            <div class="flex mt-3">

                                <InertiaLink @click="back"
                                             class="ml-1  h-6 w-6 rounded-full  text-center text-white font-extrabold">
                                    <img :src="backButton" alt="">

                                </InertiaLink>

                                <Like :post="post" class="ml-1"></Like>

                                <Dislike :post="post" class="ml-1 mr-1"></Dislike>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-2 max-2 rounded-xl ">
                <form @submit.prevent="submit" class="w-full">
                    <div class="flex mt-5">
                        <!--                        <img-->
                        <!--                            :src="showImage() + $page.props.auth.user.avatar"-->
                        <!--                            class="avatar rounded-full avatar md:ml-4 mr-1 md:mr-2 w-10 h-10"-->
                        <!--                            alt="avatar"-->
                        <!--                        />-->

                        <BreezeInput id="body" type="text" class="block w-full h-10 mx-1" v-model="form.body"
                                     placeholder="Say something.."
                                     required autofocus autocomplete="name"/>

                        <button type="submit"
                                class="button px-6 shadow-2xl  md:mx-2"
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

            </div>

            <div v-for="(comment, index) in comments" :key="index">
                <CommentItem :comment="comment"></CommentItem>
            </div>
        </div>
    </BreezeAuthenticatedLayout>

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
import backButton from "/img/Tab/left-arrow.png";


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
        likes: Array,
    },
    data() {
        return {
            imageError: false,
            defaultImage: require("/storage/default-avatar.png"),

            avatar: avatar,
            backButton: backButton,
            form: this.$inertia.form({
                body: null,

            }),
        }
    },
    computed: {
        creatorImage() {
            return this.imageError ? this.defaultImage : '/storage/default-avatar.png';
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
