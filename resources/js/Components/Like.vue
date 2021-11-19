<template>
    <div>


        <inertia-link
            preserve-scroll
            method="POST"
            as="button"
            :href="route('likes.toggle', post.id)"
            class="h-6 w-6 rounded-full bg-green-500 hover:bg-green-500 text-white">

        </inertia-link>

        <inertia-link v-if="$page.props.likeToggle"
                      as="button"
                      class="follow button shadow-2xl  items-center px-3 py-1 bg-white border border-transparent
                                                        rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-red-600 hover:text-white
                                                        active:bg-green-700 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray
                                                        transition ease-in-out duration-150 w-40"
                      style="font-size: 80%;"
                      :href="`/users/${$page.props.auth.user.username}/followings/${user.id}`"
                      preserve-scroll
                      method="DELETE">

        </inertia-link>
    </div>
</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
    name: "Like",
    props: {
        post: Object,
        method: Function,

    },
    components: {
        InertiaLink,
    },

    // methods: {
    //     toggleLike() {
    //     }
    //
    // }
}
</script>

<style scoped>

</style>
