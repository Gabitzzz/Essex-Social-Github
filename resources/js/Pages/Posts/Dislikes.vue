<template>
    <BreezeAuthenticatedLayout>
        <div class="mt-5">
            <div class="pb-1 mx-auto sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">

                <div class="mx-2 max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
                    <div class="flex">
                        <inertia-link :href="route('profile', post.user.username)" class="w-full">
                            <div class="flex justify-items-start m-2">
                                <div v-if="post.user.avatar === null">
                                    <img
                                        :src="defaultProfile"
                                        class="avatar w-10 h-10 ml-2 my-2"
                                        alt="default"
                                    />
                                </div>

                                <div v-else>
                                    <img
                                        :src="showImage() + post.user.avatar || showImage() + 'default-avatar.png'"
                                        class="avatar rounded-full avatar w-10 h-10 ml-2 my-2"
                                        alt="avatar"
                                    />
                                </div>

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

                        <div class="w-full mt-4 ">
                            <div v-if="post.location" class="flex ml-8 items-center">
                                <img
                                    :src="location"
                                    class="avatar  avatar w-4 h-4 ml-2 "
                                    alt="default"
                                />

                                <p class="text-center text-sm text-gray-600 ml-1 ">
                                    {{ post.location }}
                                </p>
                            </div>
                        </div>

                        <div class="mr-4" style="">
                            <inertia-link preserve-scroll
                                          v-if="post.user.id === $page.props.auth.user.id"
                                          class=" -mt-6  "
                                          as="button"
                                          :href="route('posts.edit', post.id)"
                            >
                                ...
                            </inertia-link>
                        </div>
                    </div>

                    <div class="pb-1 border-b border-gray-200">
                        <p class="text-sm px-6">
                            {{ post.body }}
                        </p>

                        <div v-if="post.image" class="flex justify-center mt-2">
                            <img
                                :src="showImage() +  post.image"
                                class="avatar">

                        </div>

                        <!--                LIKES   -->
                        <inertia-link preserve-scroll
                                      :href="route('posts.likes', post)"
                                      :likes="post.likes"
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


                        <div class="flex mx-2">
                            <div class="flex-auto w-12">
                                <img v-if="$page.props.auth.user.avatar === null"
                                     :src="defaultProfile"
                                     class="avatar w-8 h-8 mt-2 "
                                     alt="default"
                                />

                                <img v-else
                                     :src="showImage() + $page.props.auth.user.avatar"
                                     class="avatar rounded-full avatar w-8 h-8 mt-2"
                                />
                            </div>

                            <div class="bg-white h-8 my-2 text-xs flex-auto w-full ">
                            </div>

                            <div class="flex mt-3 flex-auto w-24">
                                <InertiaLink @click="back"
                                             class="ml-1  h-6 w-6 rounded-full  text-center text-white font-extrabold">
                                    <img :src="backButton" alt="">
                                </InertiaLink>

                                <Like :post="post" class="ml-1"></Like>
                                <Dislike :post="post" class="ml-1"></Dislike>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-16 pb-1 mx-auto sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80
             flex items-center justify-between max-2 overflow-hidden rounded-xl font-bold">
                <inertia-link preserve-scroll
                              as="button"
                              :href="route('posts.likes', post.id)"
                >
                    <h1 class="text-md px-2 py-2 " style="font-family: 'Poppins', sans-serif;">
                        {{ post.likes.length }} likes
                    </h1>
                </inertia-link>

                <inertia-link preserve-scroll
                              as="button"
                              :href="route('posts.dislikes', post.id)"
                >
                    <h1 class="text-xl px-2 py-2 text-red-700" style="font-family: 'Poppins', sans-serif;">
                        {{ post.dislikes.length }} dislikes
                    </h1>
                </inertia-link>

                <!--                <inertia-link preserve-scroll-->
                <!--                              as="button"-->
                <!--                              :href="route('posts.comments', post.id)"-->
                <!--                >-->
                <!--                    <h1 class="text-md px-2 py-2 " style="font-family: 'Poppins', sans-serif;">-->
                <!--                        {{ comments.length }} comments-->
                <!--                    </h1>-->
                <!--                </inertia-link>-->
            </div>

            <hr class="pb-1 mx-auto  sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">
            <div v-for="dislike in post.dislikes"
                 class="pb-1 px-4 mx-auto sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">
                <inertia-link :href="route('profile', dislike.username)">
                    <div class="flex items-center justify-between ">
                        <div class="flex items-center">
                            <div v-if="dislike.avatar === null">
                                <img
                                    :src="defaultProfile"
                                    class="avatar  avatar w-10 h-10 ml-2 my-2"
                                    alt="default"
                                />
                            </div>

                            <div v-else>
                                <img
                                    :src="showImage() + dislike.avatar || showImage() + 'default-avatar.png'"
                                    class="avatar rounded-full avatar w-10 h-10 ml-2 my-2"
                                    alt="avatar"
                                />
                            </div>

                            <p class="ml-2">{{ dislike.username }}</p>
                        </div>

                        <a
                            class="avatar  w-8 h-8  bg-white border-2 border-gray-200 border-opacity-25"
                            :href="('/chatify/' + dislike.id )" style="border-radius: 15px;">
                            <img :src="chat" width="15" height="15" class="absolute z-10 mx-1 my-2" alt="search">
                        </a>
                    </div>
                </inertia-link>
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
import defaultProfile from "/img/Posts/defaultProfile.png";
import location from "/img/Posts/location3.png";
import chat from "/img/Chat/chat-img.png";


export default {
    name: "Dislikes",
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
        dislike: Array,

    },
    data() {
        return {
            chat: chat,
            imageError: false,
            avatar: avatar,
            backButton: backButton,
            form: this.$inertia.form({
                body: null,

            }),
            defaultProfile: defaultProfile,
            location: location,
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

</style>
