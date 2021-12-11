<template>
    <BreezeAuthenticatedLayout>
        <div v-for="(post, key) in posts" :key="key">
            <Post :post="post" :likeToggle="likeToggle" ></Post>
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
        likeToggle: Boolean,
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
