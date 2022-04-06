<template>
    <div class="bg-gray-100 ">
        <BreezeAuthenticatedLayout>
            <Head title="Profile"/>

            <div>
                <div class="sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">
                    <div class=" ">
                        <div class="rounded-xl  border-gray-200" style="position: relative;">
                            <div v-if="user.cover === null">
                                <img :src="cover" class="cover rounded-b-xl" alt="cover"
                                     style="min-height: 350px;">
                            </div>

                            <div v-else>
                                <img :src="showImage() + user.cover" class="cover rounded-lg" alt="cover"
                                     style="min-height: 350px;">
                            </div>

                            <div class="flex justify-center">
                                <div v-if="user.avatar === null">
                                    <img
                                        :src="defaultProfile"
                                        class=" avatar w-32 h-32 "
                                        alt="default"
                                    />
                                    <a
                                        class="avatar mt-16 w-8 h-8  bg-gray-100 border-2 border-gray-200 border-opacity-25"
                                        :href="('/chatify/' + user.id )" style="border-radius: 15px;">
                                        <img :src="chat" width="15" height="15" class="absolute z-10 mx-1 my-2"
                                             alt="search">
                                    </a>
                                </div>

                                <div v-else>
                                    <img
                                        :src="showImage() + user.avatar"
                                        class="rounded-full avatar w-32 h-32"
                                        alt="avatar"
                                    />

                                    <a
                                        class="avatar  mt-16 w-8 h-8 bg-gray-100  border-2 border-gray-200"
                                        :href="('/chatify/' + user.id )" style="border-radius: 15px;">
                                        <img :src="chat" width="15" height="15" class="absolute z-10 mx-1 my-2"
                                             alt="search">
                                    </a>
                                </div>

                                <p style="text-align: center;" class="text-2xl username">
                                    {{ $page.props.user.username }}
                                </p>

                                <div v-if="$page.props.auth.user.id === $page.props.user.id"
                                     class="flex justify-center">
                                    <a :href="route('users.edit',$page.props.user.username)"
                                       class="follow button shadow-2xl inline-flex items-center px-3 py-1 bg-white border border-transparent rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                                    >
                                        Edit
                                    </a>
                                </div>

                                <div v-else class="flex justify-center">
                                    <inertia-link v-if="!$page.props.followToggle"
                                                  as="button"
                                                  class="follow button shadow-2xl  items-center px-3 py-1 bg-white border border-transparent rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-green-700 hover:text-white w-40 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                                                  style="font-size: 80%;"
                                                  :href="`/users/${$page.props.auth.user.username}/followings/${user.id}`"
                                                  preserve-scroll
                                                  method="POST">
                                        Follow
                                    </inertia-link>

                                    <inertia-link v-if="$page.props.followToggle"
                                                  as="button"
                                                  @mouseover="showUnfollow = true"
                                                  @mouseleave="showUnfollow = false"
                                                  class="follow button shadow-2xl  items-center px-3 py-1 bg-white border border-transparent
                                                        rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-red-600 hover:text-white
                                                         active:bg-green-700 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray
                                                        transition ease-in-out duration-150 w-40"
                                                  style="font-size: 80%;"
                                                  :href="`/users/${$page.props.auth.user.username}/followings/${user.id}`"
                                                  preserve-scroll
                                                  method="DELETE">
                                        {{ showUnfollow ? 'Unfollow' : '✓ Following' }}
                                    </inertia-link>
                                </div>

                                <div class="count grid grid-cols-3 divide-x divide-white ">
                                    <div class=" text-white text-center px-5 ">
                                        {{ posts.length }} <br>
                                        Posts
                                    </div>

                                    <div class="text-white text-center px-5">
                                        <a :href="route('followers', user)">
                                            {{ followers.data.length }}
                                            <br>
                                            Followers
                                        </a>
                                    </div>

                                    <div class="text-white text-center px-5">
                                        <a :href="route('followings', user)">
                                            {{ followings.data.length }}
                                            <br>
                                            Following
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--                FEED / GALLERY / ABOUT BUTTONS      -->
                    <div class=" ">
                        <div class="flex space-x-4 text-center mx-2 ">
                            <button @click="feed = !feed; gallery=false; about=false"
                                    class="flex-1 my-2  p-2 shadow-md font-semibold border-gray-300 bg-white border border-transparent rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                Feed
                            </button>

                            <button @click="gallery = !gallery; about=false; feed=false"
                                    class="flex-1 my-2 p-2 shadow-md font-semibold border-gray-300 bg-white border border-transparent rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                Gallery
                            </button>

                            <button @click="about = !about; gallery=false; feed=false"
                                    class="flex-1 my-2 p-2 shadow-md font-semibold border-gray-300 bg-white border border-transparent rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                ABOUT
                            </button>
                        </div>
                    </div>

                    <!--    FEED    -->
                    <div v-show="feed" class="py-2  ">
                        <div class="mx-2 max-2 feed overflow-hidden shadow-sm rounded-xl shadow-xl">
                            <h1 class="text-3xl text-white px-6 py-4 ">
                                FEED
                            </h1>
                        </div>

                        <!--                    ADD TAB         -->
                        <div v-if="$page.props.auth.user.id === $page.props.user.id" class="mt-4 ">
                            <AddTab></AddTab>
                        </div>

                        <div class="pb-20 mt-4">
                            <div v-for="post in posts">
                                <div v-if="$page.props.auth.user === $page.props.posts.user_id"></div>
                                <Post :post="post"></Post>
                            </div>
                        </div>
                    </div>

                    <!--  GALLERY -->
                    <div v-show="gallery" class="py-2">
                        <div class="">
                            <div class="mx-2 max-2 feed overflow-hidden shadow-sm rounded-xl shadow-xl">
                                <h1 class="text-3xl text-white px-6 py-4 ">
                                    GALLERY
                                </h1>
                            </div>
                        </div>

                        <div class="pb-20 mt-4">
                            <div v-if="posts.length === 0" class="mx-2 flex justify-center">
                                <h1>
                                    No photos yet
                                </h1>
                            </div>

                            <div v-for="post in posts">
                                <div v-if="post.image.length > 4" class="mx-2">
                                    <img
                                        :src="showImage() +  post.image"
                                        class=""
                                        alt="avatar"
                                    />
                                </div>

                                <div v-else class="mx-2 flex justify-center">
                                    <h1>
                                        No photos yet
                                    </h1>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--    ABOUT   -->
                    <div v-show="about" class="py-2 mx-2 mb-2">
                        <div class="">
                            <div class="max-2 feed overflow-hidden shadow-sm rounded-xl shadow-xl">
                                <h1 class="text-3xl text-white px-6 py-4 ">
                                    ABOUT
                                </h1>
                            </div>
                        </div>

                        <!--                FIRST CARD  -->
                        <div class=" mt-5">
                            <div class="max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
                                <div class="p-6 border-b border-gray-200">
                                    <p>
                                        <strong>Username:</strong> {{ $page.props.user.username }}
                                    </p>
                                    <p>
                                        <strong>Name:</strong> {{ $page.props.user.name }}
                                    </p>
                                    <p>
                                        <strong>Email:</strong> {{ $page.props.user.email }}
                                    </p>
                                    <p>
                                        <strong>Description:</strong> {{ $page.props.user.description }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!--                        SECOND CARD         -->
                        <div class=" mt-5">
                            <div class="max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
                                <div class="p-6 border-b border-gray-200">
                                    <p>
                                        <strong>Degree:</strong> {{ $page.props.user.degree }}
                                    </p>
                                    <p>
                                        <strong>Date of Birth</strong> {{ $page.props.user.name }}
                                    </p>
                                    <p>
                                        <strong>Study Year</strong> {{ $page.props.user.study_year }}
                                    </p>
                                    <p>
                                        <strong>Relationship Status:</strong> {{ $page.props.user.description }}
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
import cover from "/img/background/forrest.jpg";
import defaultProfile from "/img/Posts/defaultProfile.png";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import FollowButton from "@/Components/FollowButton";
import Like from "@/Components/Like";
import Dislike from "@/Components/Dislike";
import Post from "@/Pages/Posts/Post";
import post_img from "/img/Posts/post.png";
import party from "/img/Posts/party.png";
import event from "/img/Posts/event.png";
import AddTab from "@/Components/AddTab";
import {Head} from '@inertiajs/inertia-vue3';
import chat from "/img/Chat/chat-img.png";

export default {
    name: "Show",
    data() {
        return {
            cover: cover,
            about: false,
            feed: true,
            gallery: false,
            post_img: post_img,
            party: party,
            event: event,
            defaultProfile: defaultProfile,
            chat: chat,
        }
    },
    props: {
        users: Array,
        user: Object,
        post: Object,
        posts: Array,
        followers: Object,
        followings: Object,
        followToggle: Boolean,
        likes: Array,
        dislikes: Array,
        galleries: Array,
    },

    components: {
        BreezeAuthenticatedLayout,
        InertiaLink,
        FollowButton,
        Like,
        Dislike,
        Post,
        AddTab,
        Head,
    },

    methods: {
        showImage() {
            return "/storage/";
        },
    }
}
</script>

<style scoped>

.cover {
    filter: brightness(50%);
}

.avatar {
    position: absolute;
    top: 25%;
    left: 50%;
    transform: translate(-50%, -50%);
}


.username {
    position: absolute;
    top: 50%;
    color: white;
    font-weight: bolder;
}

@media (min-width: 1280px) {
    .username {
        top: 45%;
    }

    .follow {
        top: 50%;
    }
}

.follow {
    position: absolute;
    top: 65%;
}

.count {
    position: absolute;
    top: 80%;
}

.feed {
    background-image: linear-gradient(to right, #0362fc, #11479e);
}


</style>
