<template>
    <div>
        <BreezeAuthenticatedLayout>
            <div class="mt-5 mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                <AddTab></AddTab>
                <Posts :posts="posts" :likes="likes" :likeToggle="likeToggle"></Posts>
            </div>
        </BreezeAuthenticatedLayout>
    </div>
</template>

<script>
import Posts from "@/Pages/Posts/Posts";
import AddTab from "@/Components/AddTab";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';


export default {
    name: "Index",
    components: {
        Posts,
        AddTab,
        BreezeAuthenticatedLayout
    },
    props: {
        posts: Array,
        likes: Array,
        likeToggle: Boolean,
    },
    // created() {
    //     debugger
    // }
}
</script>

<style scoped>


</style>
