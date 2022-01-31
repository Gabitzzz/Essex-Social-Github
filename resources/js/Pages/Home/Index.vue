<template>
    <div>
        <BreezeAuthenticatedLayout>
                <div class="mx-2 sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">

                <div class=" max-2 overflow-hidden rounded-xl font-bold">
                    <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                        News Feed
                    </h1>
                </div>

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
