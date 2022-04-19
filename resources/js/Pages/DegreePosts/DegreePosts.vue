<template>
    <div v-for="(post, key) in posts" :key="key">
        <DegreePost :post="post" :degree="degree" :users="users" ></DegreePost>
    </div>
</template>

<script>
import DegreePost from "@/Pages/DegreePosts/DegreePost";
export default {
    name: "DegreePosts",
    props:{
        posts: Array,
        degree: Object,
        users: Array,
    },
    components:{
        DegreePost,
    },
}
</script>

<style scoped>

</style>
