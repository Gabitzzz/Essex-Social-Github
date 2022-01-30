<template>
        <div v-for="(post, key) in posts" :key="key">
            <Post :post="post" :likeToggle="likeToggle" ></Post>
        </div>
</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3";
import Post from "@/Pages/Posts/Post";

export default {
    name: "Posts",
    props: {
        posts: Array,
        likeToggle: Boolean,
    },
    data() {
        return {

        }
    },
    components: {
        InertiaLink,
        Post,
    },
}
</script>

<style scoped>

</style>
