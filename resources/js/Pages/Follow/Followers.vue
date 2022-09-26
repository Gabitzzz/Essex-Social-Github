<template>
    <BreezeAuthenticatedLayout>
        <Head title="Followers"/>
        <!--        <div>-->
        <div class="pb-1 mx-auto sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">
            <FollowingHeader :profile="profile"></FollowingHeader>
            <div v-for="user in followers.data" :key="user.id" class="flex py-4 mx-2 border-b border-gray-200">
                <div class="flex justify-between w-full">
                    <div class="flex">
                        <div v-if="user.avatar === null">
                            <img :src="defaultProfile" class=" avatar w-12 h-12 mr-4 " alt="cover">
                        </div>

                        <div v-else>
                            <img
                                :src="showImage() + user.avatar"
                                class="avatar rounded-full avatar w-12 h-12 mr-4 "
                                alt="avatar"
                            />
                        </div>

                        <div class="flex flex-col">
                            <a :href="route('profile', user.username)" class="text-md">
                                {{ user.name }}
                            </a>

                            <a :href="route('profile', user.username)" class="text-sm">
                                {{ user.username }}
                            </a>
                        </div>
                    </div>

                    <div v-if="$page.props.auth.user.id !== user.id" class="flex justify-center">

                        <div class="flex justify-center items-center">
                            <a
                                class="shadow-2xl  items-center px-3"
                                :href="('/chatify/' + user.id )" >
                                <img :src="chat" width="15" height="15" class="" alt="search">
                            </a>
                            <FollowButton :user="user"></FollowButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import FollowingHeader from "@/Components/FollowingHeader";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import FollowButton from "@/Components/FollowButton";
import {Head} from '@inertiajs/inertia-vue3';
import defaultProfile from "/img/Posts/defaultProfile.png";
import chat from "/img/Chat/chat-img.png";


export default {
    name: "Followers",
    data(){
        return{
            chat: chat,
            defaultProfile: defaultProfile,
        }
    },
    components: {
        BreezeAuthenticatedLayout,
        FollowingHeader,
        InertiaLink,
        FollowButton,
        Head,
    },
    props: {
        profile: Object,
        user: Object,
        followers: Object,
        followings: Object,
    },
    methods: {
        showImage() {
            return "/storage/";
        },
    }
}
</script>

<style scoped>

</style>
