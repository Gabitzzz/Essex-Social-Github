<template>
    <BreezeAuthenticatedLayout>

        <DegreeHeader :degree="degree" :users="users"></DegreeHeader>
        <div class="mt-4 mx-auto sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">

            <div class="mx-2 max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
                <div class="flex">
                    <inertia-link :href="route('profile', post.user.username)" class="w-full">
                        <div class="flex justify-items-start m-2">
                            <div v-if="post.user.avatar === null">
                                <img
                                    :src="defaultProfile"
                                    class="avatar  avatar w-10 h-10 ml-2 my-2"
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
                        <inertia-link :href="route('degree.posts.edit', [post, degree])"
                                      v-if="post.user.id === $page.props.auth.user.id"
                                      class=" -mt-6  "
                                      as="button"
                        >
                            ...
                        </inertia-link>
                    </div>
                </div>

                <div class=" pb-1 border-b border-gray-200">
                    <p class="text-sm px-6">
                        {{ post.body }}
                    </p>

                    <div v-if="post.image" class="flex justify-center mt-4">
                        <img
                            :src="showImage() +  post.image"
                            class="avatar"/>
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

                            <!--                        COMMENTS    -->
                            <!--                                <div v-if="comments.length === 0">-->
                            <!--                                </div>-->

                            <!--                                <div v-else-if="comments.length === 1">-->
                            <!--                                    {{ comments.length }} Comment-->
                            <!--                                </div>-->

                            <!--                                <div v-else>-->
                            <!--                                    {{ comments.length }} Comments &nbsp;-->
                            <!--                                </div>-->
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

                            <DegreeLike :post="post" :degree="degree" class="ml-1"></DegreeLike>
                            <DegreeDislike :post="post" :degree="degree" class="ml-1"></DegreeDislike>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-2  rounded-xl ">
                <form @submit.prevent="submit" class="w-full">
                    <div class="flex mt-5">
                        <BreezeInput id="body" type="text" class="block w-full h-10 mx-1" v-model="form.body"
                                     placeholder="  leave a comment"
                                     required autofocus autocomplete="name"/>

                        <button type="submit"
                                class="button px-6 shadow-2xl  md:mx-2"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                            SUBMIT
                        </button>
                    </div>


                </form>
            </div>

            <div class="px-4 pt-4 font-bold">
                <div v-if="comments.length === 0">

                </div>
                <div v-else-if="comments.length === 1">
                    1 Comment

                    <hr>

                </div>

                <div v-else-if="comments.length > 1">
                    {{comments.length}} Comments

                    <hr>

                </div>
            </div>

            <div v-for="(comment, index) in comments" :key="index">
                <DegreeCommentItem :comment="comment"></DegreeCommentItem>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import avatar from "/img/background/human.jpg";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import CombinedComments from "@/Components/CombinedComments";
import PostForm from "@/Components/PostForm";
import location from "/img/Posts/location3.png";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import DegreeHeader from "@/Components/DegreeHeader";
import defaultProfile from "/img/Posts/defaultProfile.png";
import BreezeInput from '@/Components/Input.vue';
import DegreeLike from "@/Components/DegreeLike";
import DegreeDislike from "@/Components/DegreeDislike";
import DegreeCommentItem from "@/Pages/DegreeComments/DegreeCommentItem";
import backButton from "/img/Tab/left-arrow.png";

export default {
    name: "Degree Post",
    data() {
        return {
            form: this.$inertia.form({
                body: null,


            }),
            defaultProfile: defaultProfile,
            avatar: avatar,
            location: location,
            backButton: backButton,
        }
    },

    components: {
        DegreeCommentItem,
        DegreeDislike,
        DegreeLike,
        BreezeInput,
        InertiaLink,
        CombinedComments,
        PostForm,
        BreezeAuthenticatedLayout,
        DegreeHeader,
    },
    props: {
        post: Object,
        user: Object,
        comments: Array,
        degree: Object,
        users: Array,
    },
    methods: {
        showImage() {
            return "/storage/";
        },


        submit() {
            this.form.post(this.route('degree.comments.store', [this.degree.id, this.post.id]), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.body = null

                }
            })
        },
        back() {
            window.history.back();
        },
    }
}
</script>


