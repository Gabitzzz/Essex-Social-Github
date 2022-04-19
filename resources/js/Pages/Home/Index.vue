<template>
    <Head title="News Feed"/>

    <BreezeAuthenticatedLayout>
            <div class="pb-1 mx-auto sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">

            <div class="mt-5 font-bold  overflow-hidden max-w-7xl ">
                <div class=" max-2 overflow-hidden rounded-xl font-bold">
                    <h1 class="text-4xl p-2" style="font-family: 'Poppins', sans-serif;">
                        News Feed
                    </h1>
                </div>

                <AddTab></AddTab>

                <Posts :posts="posts"
                       :likes="likes"
                       :comments="comments"
                       :commments="comments"
                       :likeToggle="likeToggle">
                </Posts>

            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import AddTab from "@/Components/AddTab";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';


import Posts from "@/Pages/Posts/Posts";

export default {
    name: "Index",
    components: {
        Posts,
        AddTab,
        BreezeAuthenticatedLayout,
        Head,
    },

    props: {
        posts: Array,
        likes: Array,
        comments: Array,
        likeToggle: Boolean,
        user: Array,
    },


    // created() {
    //     debugger
    // }
}
</script>

<style scoped>


</style>
