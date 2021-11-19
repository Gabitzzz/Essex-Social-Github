<template>
    <BreezeAuthenticatedLayout>
        <div v-for="post in posts">
            <Post :post="post" ></Post>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {InertiaLink} from "@inertiajs/inertia-vue3";
import Post from "@/Pages/Posts/Post";

export default {
    name: "Posts",
    props: {
        posts: Array,
        post: Object,
        user: Object,
    },
    data() {
        return {

        }
    },
    components: {
        InertiaLink,
        BreezeAuthenticatedLayout,
        Post,
    },



}
</script>

<style scoped>

</style>
