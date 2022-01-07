<template>
    <BreezeAuthenticatedLayout>
        <!--        <div>-->
        <div class="mx-auto sm:mx-16 md:mx-24  lg:mx-72 xl:mx-96">
            <FollowingHeader :profile="profile"></FollowingHeader>

            <div v-for="user in followings.data" :key="user.id" class="flex p-4 border-b border-gray-200">
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
    // created() {
    //     debugger
    // }
}
</script>

<style scoped>

</style>
