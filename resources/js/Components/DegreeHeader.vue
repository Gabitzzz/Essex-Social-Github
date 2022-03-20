<template>
<!--        <Head title="Degree"/>-->


        <div class="mx-auto sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">
            <div class=" ">
                <div class="rounded-xl  border-gray-200" style="position: relative;">
                    <div v-if="degree.degreePicture === null">
                        <img :src="degreePicture" class="w-full cover rounded-b-xl" alt="degree_picture"
                             style="max-height: 350px; ">
                    </div>

                    <div v-else>
                        <img :src="showImage() + degree.degreePicture" class="w-full cover rounded-lg" alt="degree_picture"
                             style="max-height: 350px;">
                    </div>

                    <div class="flex justify-center">

                        <p style="text-align: center;" class="text-3xl sm:text-4xl title">
                            {{ degree.title }}
                        </p>

                        <p style="text-align: center;" class="text-md sm:text-2xl description">
                            {{ degree.description }}
                        </p>

                    </div>
                </div>
            </div>
        </div>



</template>

<script>
import {Head} from '@inertiajs/inertia-vue3';
import {InertiaLink} from "@inertiajs/inertia-vue3";
import DegreePosts from "@/Pages/DegreePosts/DegreePosts";
import degreePicture from "/img/Degree/degreePicture.jpg";


export default {
    name: "DegreeHeader",
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
        Head,
        InertiaLink,
        DegreePosts,
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
