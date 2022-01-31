<template>
    <BreezeAuthenticatedLayout>
        <!--        <div>-->
        <div class="mx-auto sm:mx-16 md:mx-24  lg:mx-72 xl:mx-96">
            <FollowingHeader :profile="profile"></FollowingHeader>

            <div v-for="user in followings.data" :key="user.id" class="flex mx-2  py-4 border-b border-gray-200">
                <div class="flex justify-between w-full">


                 <div class="flex">

                     <img
                         :src="showImage() + user.avatar"
                         class="avatar rounded-full avatar w-12 h-12 mr-4 "
                         alt="avatar"
                     />

                     <div class="flex flex-col">
                         <a :href="route('profile', user.username)" class="'text-md">
                             {{ user.name }}
                         </a>

                         <a :href="route('profile', user.username)" class="text-sm">
                             {{ user.username }}
                         </a>
                     </div>
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
import FollowButton from "@/Components/FollowButton";

export default {
    name: "Following",
    props: {
        profile: Object,
        followings: Object,
        user: Object,
    },
    components: {
        BreezeAuthenticatedLayout,
        FollowingHeader,
        FollowButton
    },
    methods:{
        showImage() {
            return "/storage/";
        },
    }
    // created() {
    //     debugger
    // }
}
</script>

<style scoped>

</style>
