<template>
    <inertia-link
        :href="route('degree.post.show', [degree.id, post])"
    >
        <div class="mb-4 mx-2 max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
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

<!--                <div class="mr-4" style="">-->
<!--                    <inertia-link :href="route('degree.posts.edit', post)"-->
<!--                                  v-if="post.user.id === $page.props.auth.user.id"-->
<!--                                  class=" -mt-6  "-->
<!--                                  as="button"-->
<!--                                  :post="post"-->
<!--                    >-->
<!--                        ...-->
<!--                    </inertia-link>-->
<!--                </div>-->
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
                <inertia-link
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

        <!--        <div class="mb-4 max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">-->
        <!--            <div class="flex">-->
        <!--                <inertia-link :href="route('profile', post.user.username)" class="w-full">-->
        <!--                    <div class="flex justify-items-start m-2 items-center">-->
        <!--                        <div v-if="post.user.avatar === null">-->
        <!--                            <img-->
        <!--                                :src="defaultProfile"-->
        <!--                                class="avatar  avatar w-10 h-10 ml-2 my-2"-->
        <!--                                alt="default"-->
        <!--                            />-->
        <!--                        </div>-->

        <!--                        <div v-else>-->
        <!--                            <img-->
        <!--                                :src="showImage() + post.user.avatar || showImage() + 'default-avatar.png'"-->
        <!--                                class="avatar rounded-full avatar w-10 h-10 ml-2 my-2 "-->
        <!--                                alt="avatar"-->
        <!--                            />-->
        <!--                        </div>-->

        <!--                        <div>-->
        <!--                            <p class="ml-2 mt-2">-->
        <!--                                {{ post.user.username }}-->
        <!--                            </p>-->
        <!--                            <span class="italic ml-2 align-text-top" style="font-size: 10px;">-->
        <!--                                       {{ post.timeAgo }}-->
        <!--                                </span>-->
        <!--                        </div>-->


        <!--                    </div>-->
        <!--                </inertia-link>-->

        <!--                <div class="w-full mt-4 ">-->
        <!--                    <div v-if="post.location" class="flex text-right ml-8 items-center">-->
        <!--                        <img-->
        <!--                            :src="location"-->
        <!--                            class="avatar  avatar w-4 h-4 ml-2 "-->
        <!--                            alt="default"-->
        <!--                        />-->

        <!--                        <p class="text-center text-sm text-gray-600 ml-1 ">-->
        <!--                            {{ post.location }}-->
        <!--                        </p>-->
        <!--                    </div>-->
        <!--                </div>-->

        <!--                <div class="mr-4" style="">-->
        <!--                    <inertia-link preserve-scroll-->
        <!--                                  v-if="post.user.id === $page.props.auth.user.id"-->
        <!--                                  class=" -mt-6  "-->
        <!--                                  as="button"-->
        <!--                                  :href="route('posts.edit', post.id)"-->
        <!--                    >-->
        <!--                        ...-->
        <!--                    </inertia-link>-->
        <!--                </div>-->
        <!--            </div>-->

        <!--            <div class="px-4 border-b border-gray-200">-->
        <!--                <p class="text-sm px-4">-->
        <!--                    {{ post.body }}-->
        <!--                </p>-->

        <!--                <div v-if="post.image" class="mt-2 flex justify-center">-->
        <!--                    <img-->
        <!--                        :src="showImage() +  post.image"-->
        <!--                        class="avatar w-2/3 h-2/3"-->
        <!--                        alt="avatar"-->
        <!--                    />-->
        <!--                </div>-->

        <!--                                &lt;!&ndash;                LIKES   &ndash;&gt;-->
        <!--                                <inertia-link preserve-scroll-->
        <!--                                              method="POST"-->
        <!--                                              as="button"-->
        <!--                                              :href="route('likes.toggle', post.id)"-->
        <!--                                >-->
        <!--                                    <div class="flex text-xs px-4 mt-2">-->
        <!--                                        <div v-if="post.likes.length === 0">-->
        <!--                                        </div>-->

        <!--                                        <div v-else-if="post.likes.length === 1">-->
        <!--                                            {{ post.likes.length }} Like &nbsp;-->
        <!--                                        </div>-->

        <!--                                        <div v-else>-->
        <!--                                            {{ post.likes.length }} Likes &nbsp;-->
        <!--                                        </div>-->

        <!--                                        &lt;!&ndash;                DISLIKES    &ndash;&gt;-->
        <!--                                        <div v-if="post.dislikes.length === 0">-->
        <!--                                        </div>-->

        <!--                                        <div v-else-if="post.dislikes.length === 1">-->
        <!--                                            {{ post.dislikes.length }} Dislike &nbsp;-->
        <!--                                        </div>-->

        <!--                                        <div v-else>-->
        <!--                                            {{ post.dislikes.length }} Dislikes &nbsp;-->
        <!--                                        </div>-->
        <!--                                    </div>-->
        <!--                                </inertia-link>-->

        <!--                <hr>-->

        <!--                <div>-->
        <!--                    <div class="flex">-->
        <!--                        <div class="flex-auto w-12">-->
        <!--                            <img v-if="$page.props.auth.user.avatar === null"-->
        <!--                                 :src="defaultProfile"-->
        <!--                                 class="avatar w-8 h-8 mt-2 "-->
        <!--                                 alt="default"-->
        <!--                            />-->

        <!--                            <img v-else-->
        <!--                                 :src="showImage() + $page.props.auth.user.avatar"-->
        <!--                                 class="avatar rounded-full avatar w-8 h-8 mt-2"-->
        <!--                            />-->
        <!--                        </div>-->

        <!--                        <div-->
        <!--                            class="bg-white h-8 rounded-full shadow-md my-2 text-xs  border border-gray-300 flex-auto w-full ">-->
        <!--                            <p class="mt-2 ml-4 text-gray-700">-->
        <!--                                leave a comment-->
        <!--                            </p>-->
        <!--                        </div>-->

        <!--                        <div class="flex mt-3 flex-auto w-16">-->
        <!--                            <DegreeLike :post="post" :degree="degree" class="ml-1"></DegreeLike>-->
        <!--                            <DegreeDislike :post="post" :degree="degree" class="ml-1"></DegreeDislike>-->

        <!--                        </div>-->


        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
    </inertia-link>
</template>

<script>
import avatar from "/img/background/human.jpg";
import Like from "@/Components/Like.vue";
import Dislike from "@/Components/Dislike";
import DegreeLike from "@/Components/DegreeLike";
import DegreeDislike from "@/Components/DegreeDislike";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import CombinedComments from "@/Components/CombinedComments";
import PostForm from "@/Components/PostForm";
import defaultProfile from "/img/Posts/defaultProfile.png";
import location from "/img/Posts/location3.png";

export default {
    name: "Degree Post",
    data() {
        return {
            avatar: avatar,
            location: location,
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
            defaultProfile: defaultProfile,
        }
    },
    components: {
        Like,
        Dislike,
        InertiaLink,
        CombinedComments,
        PostForm,
        DegreeDislike,
        DegreeLike,
    },
    props: {
        post: Object,
        user: Object,
        degree: Object,
        comments: Array,
    },
    methods: {
        showImage() {
            return "/storage/";
        },
    }
}
</script>


