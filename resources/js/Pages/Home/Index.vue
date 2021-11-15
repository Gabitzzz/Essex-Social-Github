<template>
    <div>
        <Posts :posts="posts"></Posts>

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
    }
}
</script>

<style scoped>

</style>
