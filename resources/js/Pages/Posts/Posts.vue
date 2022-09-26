<template>

        <div v-for="(post, key) in posts"
             :key="key">
            <Post :post="post"
                  :likeToggle="likeToggle">

            </Post>
        </div>


</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3";
import Post from "@/Pages/Posts/Post";

export default {
    name: "Posts",

    components: {
        Post,
        InertiaLink,
    },


    props: {
        posts: Array,
        likeToggle: Boolean,
    },

    data() {
        return {

        }
    },

}
</script>

<style scoped>

</style>
