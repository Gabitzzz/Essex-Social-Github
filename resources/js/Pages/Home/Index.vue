<template>
    <div>
        <Posts :posts="posts" :likes="likes" :likeToggle="likeToggle"></Posts>

    </div>
</template>

<script>
import Posts from "@/Pages/Posts/Posts";

export default {
    name: "Index",
    components: {
        Posts
    },
    props: {
        posts: Array,
        likeToggle: Boolean,
    },
    // created() {
    //     debugger
    // }
}
</script>

<style scoped>

</style>
