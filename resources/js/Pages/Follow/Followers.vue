<template>
    <BreezeAuthenticatedLayout>
        <Head title="Followers"/>

        <!--        <div>-->
            <div class="pb-1 mx-auto sm:mx-24 md:mx-30 lg:mx-72 xl:mx-60 2xl:mx-80">


            <FollowingHeader :profile="profile"></FollowingHeader>

            <div v-for="user in followers.data" :key="user.id" class="flex py-4 mx-2 border-b border-gray-200">
                <div class="flex justify-between w-full">

                    <div class="flex">

                        <img
                            :src="showImage() + user.avatar"
                            class="avatar rounded-full avatar w-12 h-12 mr-4 "
                            alt="avatar"
                        />

                        <div class="flex flex-col">
                            <a :href="route('profile', user.username)" class="text-md">
                                {{ user.name }}
                            </a>

                            <a :href="route('profile', user.username)" class="text-xs">
                                {{ user.username }}
                            </a>
                        </div>
                    </div>

                    <div v-if="$page.props.auth.user.id !== user.id" class="flex justify-center">
                        <a
                            :href="('/chatify/' + user.id )"
                            class="  shadow-2xl bg-white
                                 border border-transparent rounded-full font-light
                                   hover:bg-green-700 hover:text-white active:bg-gray-900 focus:outline-none
                                  focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 mr-2"
                            style="font-size: 80%;"
                        >
                            <img :src="chat" alt="" class="w-10 h-10 mx-2 p-2 ">
                        </a>

                        <FollowButton :user="user"></FollowButton>
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

export default {
    name: "Followers",
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
    methods:{
        showImage() {
            return "/storage/";
        },
    }
}
</script>

<style scoped>

</style>
