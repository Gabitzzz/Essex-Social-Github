<template>
    <inertia-link v-if="!user.following"
                  :href="`/users/${$page.props.auth.user.username}/followings/${user.id}`"
                  as="button"
                  class="follow button shadow-2xl  items-center p-3 bg-white
                         border border-transparent rounded-full font-light text-xs text-black
                         uppercase tracking-widest hover:bg-green-700 hover:text-white active:bg-gray-900 focus:outline-none
                          focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 w-40"
                  style="font-size: 80%;"
                  preserve-scroll
                  method="POST">
        Follow
    </inertia-link>

    <inertia-link v-if="user.following"
                  as="button"
                  @mouseover="showUnfollow = true"
                  @mouseleave="showUnfollow = false"
                  :href="`/users/${$page.props.auth.user.username }/followings/${user.id}`"
                  class="follow button shadow-2xl  items-center p-3 bg-white border border-transparent
                            rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-red-600 hover:text-white
                            active:bg-green-700 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray
                            transition ease-in-out duration-150 w-40"
                  style="font-size: 80%;"
                  preserve-scroll
                  method="DELETE">
        {{ showUnfollow ? 'Unfollow' : '✓ Following'}}
    </inertia-link>
</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
    name: "FollowButton",

    components: {
        InertiaLink,
    },

    props: {
        user: Object,
        followers: Object,
    },
    data() {
        return{
         showUnfollow: false,
        }
    }

    // created() {
    //     debugger
    // }
}
</script>

<style scoped>

</style>
