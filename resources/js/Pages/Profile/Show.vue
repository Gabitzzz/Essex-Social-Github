<template>
    <div>
        <BreezeAuthenticatedLayout>
            <div class="bg-gray-100">
                <div class="mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                    <div class="rounded-lg shadow-md border-gray-200" style="position: relative;">
                        <img :src="cover" class="cover rounded-lg" alt="cover"
                             style="min-height: 350px;">
                        <div class="flex justify-center">
<!--                            <img :src="avatar" class="rounded-full avatar w-32 h-32" alt="avatar">-->
                            <!--                            <img :src="$page.props.user.profile_photo_url" alt="">-->

                            <img
                                :src="showImage() + user.avatar"
                                class="rounded-full avatar w-32 h-32"
                                alt="avatar"
                            />

                            <p style="text-align: center;" class="text-2xl username">
                                {{ $page.props.user.username }}
                            </p>

                            <div v-if="$page.props.auth.user.id === $page.props.user.id" class="flex justify-center">
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
                                    <a :href="route('followings', user)">
                                        {{ followings.data.length }}
                                        <br>
                                        Following
                                    </a>
                                </div>

                                <div class="text-white text-center px-5">
                                    <a :href="route('followers', user)">
                                        {{ followers.data.length }}
                                        <br>
                                        Followers
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
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
                <div v-show="feed" class="py-2 mx-2 mb-2">
                    <div class="mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                        <div class="max-2 feed overflow-hidden shadow-sm rounded-xl shadow-xl">
                            <h1 class="text-3xl text-white px-6 py-4 ">
                                FEED
                            </h1>
                        </div>
                    </div>

                    <div class="pb-20 mt-5">
                        <div v-for="post in posts" :posts="posts">
                            <div class="mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">

                                <div class="max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
                                    <div class="flex">
                                        <div class="flex justify-items-start mx-4 mt-4 mb-2 ">
                                            <p class="mt-2 ml-2">
                                                {{ post.user.username }}
                                            </p>
                                        </div>
                                        <inertia-link preserve-scroll
                                                      v-if="post.user.id === $page.props.auth.user.id"
                                                      class="mt-2"
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

                                        <!--                                                    LIKES-->

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
                                        </div>

                                        <hr>

                                        <div class="flex justify-between">
                                            <!-- ... -->
                                            <div class="flex justify-self-star mt-2">
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

                        </div>
                    </div>
                </div>

                <!--    ABOUT   -->
                <div v-show="about" class="py-2 mx-2 mb-2">
                    <div class="mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                        <div class="max-2 feed overflow-hidden shadow-sm rounded-xl shadow-xl">
                            <h1 class="text-3xl text-white px-6 py-4 ">
                                ABOUT
                            </h1>
                        </div>
                    </div>

                    <div class="mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96 mt-5">
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

                    <div class="mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96 mt-5">
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
                </div>
            </div>
        </BreezeAuthenticatedLayout>
    </div>

</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import cover from "/img/background/forrest.jpg";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import FollowButton from "@/Components/FollowButton";
import Like from "@/Components/Like";
import Dislike from "@/Components/Dislike";


export default {
    name: "Show",
    data() {
        return {
            cover: cover,
            about: false,
            feed: true,
            gallery: false,


        }
    },

    props: {
        // username: Object,
        users: Array,
        user: Object,
        posts: Array,
        followers: Object,
        followings: Object,
        followToggle: Boolean,
        likes: Array,
        dislikes: Array,

    },

    components: {
        BreezeAuthenticatedLayout,
        InertiaLink,
        FollowButton,
        Like,
        Dislike,
    },

    methods: {
        showImage() {
            return "/storage/";
        },
    }
    // created() {
    //     debugger
    // },


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
    top: 45%;
    color: white;
    font-weight: bolder;
}

@media (min-width: 1280px) {
    .username {
        top: 45%;
    }
}

.follow {
    position: absolute;
    top: 60%;
}

.count {
    position: absolute;
    top: 80%;
}

.feed {
    background-image: linear-gradient(to right, #0362fc, #11479e);
}

</style>
