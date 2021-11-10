<template>
    <BreezeAuthenticatedLayout>
<!--        <div>-->
            <div class="mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">

            <FollowingHeader :profile="profile"></FollowingHeader>

            <div v-for="user in followers.data" :key="user.id" class="flex p-4 border-b border-gray-200">
                <!--                <img src="" alt="">-->
                <div class="flex justify-between w-full ml-4">
                    <div class="flex flex-col">
                        <a :href="route('profile', user.username)">
                            {{ user.name }}
                        </a>

                        <a :href="route('profile', user.username)">
                            {{ user.username }}
                        </a>
                    </div>

                    <div v-if="$page.props.auth.user.id !== user.id" class="flex justify-center">
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

export default {
    name: "Followers",
    components: {
        BreezeAuthenticatedLayout,
        FollowingHeader,
        InertiaLink,
        FollowButton,
    },
    props: {
        profile: Object,
        user: Object,
        followers: Object,
        followings: Object,
    },
    // created() {
    //     debugger
    // }
}
</script>

<style scoped>

</style>
