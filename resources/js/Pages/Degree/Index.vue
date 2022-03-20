<template>
    <BreezeAuthenticatedLayout>
        <Head title="Degree"/>


        <div class="mx-auto sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">
            <div class=" ">
                <div class="rounded-xl  border-gray-200" style="position: relative;">
                    <div v-if="degree.degreePicture === null">
                        <img :src="degreePicture" class="w-full cover rounded-b-xl" alt="cover"
                             style="max-height: 350px; ">
                    </div>

                    <div v-else>
                        <img :src="showImage() + degree.cover" class="w-full cover rounded-lg" alt="cover"
                             style="max-height: 350px;">
                    </div>

                    <div class="flex justify-center">

                        <p style="text-align: center;" class="text-3xl sm:text-4xl title">
                            {{ degree.title }}
                        </p>

                        <p style="text-align: center;" class="text-md sm:text-2xl description">
                            {{ degree.description }}
                        </p>

                        <div class="attendance text-sm">
                            <div v-if="$page.props.users.length === 0">

                            </div>


                            <div v-else-if="$page.props.users.length === 1">
                                1 person is attending
                            </div>

                            <div v-else-if="$page.props.users.length > 1">
                                {{ $page.props.users.length }} people are attending
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <inertia-link :href="route('degree.posts.create', degree)" :degree="degree"  class="w-full">
                ssss
            </inertia-link>

            <div class="mt-8">
                <DegreePosts :posts="posts" :degree="degree"></DegreePosts>

            </div>

        </div>



    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import {InertiaLink} from "@inertiajs/inertia-vue3";
import degreePicture from "/img/Degree/degreePicture.jpg";
import DegreePosts from "@/Pages/DegreePosts/DegreePosts";
import DegreeDislike from "@/Components/DegreeDislike";
import DegreeLike from "@/Components/DegreeLike";
export default {
    name: "Index",
    data() {
        return {
            degreePicture: degreePicture,
        }
    },
    props: {
        degree: Object,
        users: Array,
        posts: Array,
    },


    components: {
        BreezeAuthenticatedLayout,
        Head,
        InertiaLink,
        DegreePosts,
        DegreeDislike,
        DegreeLike,
    },
    methods: {
        showImage() {
            return "/storage/";
        },
    }
}
</script>

<style scoped>
.cover {
    filter: brightness(35%);
}

.title {
    position: absolute;
    top: 35%;
    color: white;
    font-weight: bolder;
}


.description {
    position: absolute;
    top: 50%;
    color: white;
}

.attendance {
    position: absolute;
    top: 70%;
    color: white;
}
</style>
