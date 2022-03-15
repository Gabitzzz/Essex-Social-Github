<template>
    <BreezeAuthenticatedLayout>
        <div class="pb-1 mx-auto sm:mx-24 md:mx-30 lg:mx-72 xl:mx-60 2xl:mx-80">
            <div class="mt-5 font-bold  overflow-hidden max-w-7xl ">
                <div class=" max-2 overflow-hidden rounded-xl font-bold">
                    <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                        News Feed
                    </h1>
                </div>

                <AddTab></AddTab>
                <Posts :posts="posts" :likes="likes" :likeToggle="likeToggle"></Posts>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
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
