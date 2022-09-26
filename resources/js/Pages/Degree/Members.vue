<template>
    <BreezeAuthenticatedLayout>

        <div class="mx-auto mb-4 sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">

            <div class="rounded-xl  border-gray-200" style="position: relative;">
                <div v-if="degree.degreePicture === null">
                    <img :src="degreePicture" class="w-full cover rounded-b-xl" alt="degree_cover"
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


                    <inertia-link :href="route('degree.members', degree)" class="flex justify-center">

                        <div class="members  mt-12 text-sm">
                            <div v-if="users.length === 0">
                                <!--                                    {{party.invites.length}}-->

                            </div>
                            <div v-else-if="users.length === 1">
                                {{ users.length }} person is enrolled
                            </div>
                            <div v-else>
                                {{ users.length }} people are enrolled
                            </div>
                        </div>

                    </inertia-link>

                    <!--                        <div class="attendance text-sm">-->
                    <!--                            <div v-if="$page.props.users.length === 0">-->

                    <!--                            </div>-->


                    <!--                            <div v-else-if="$page.props.users.length === 1">-->
                    <!--                                1 person is attending-->
                    <!--                            </div>-->

                    <!--                            <div v-else-if="$page.props.users.length > 1">-->
                    <!--                                {{ $page.props.users.length }} people are attending-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                </div>
            </div>
        </div>

        <div class="mx-auto mb-4 sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">

            <div class="flex justify-between mx-4 ">
                <h2 class="text-2xl font-bold " style="font-family: 'Poppins', sans-serif;">
                    Members
                </h2>

                <InertiaLink @click="back"
                             class="ml-1 h-6 w-6 rounded-full">
                    <img :src="backButton" alt="">
                </InertiaLink>
            </div>

            <div class="  mt-8">
                <div class=" bg-white p-4  rounded-xl">
                    <div v-for="user in users" :key="user" class="mt-5  items-center border-b border-gray-200 ">
                        <inertia-link class="-mt-6" :href="route('profile', user.username)">
                            <div class="flex items-center justify-between my-2">
                                <div class="flex items-center  ">
                                    <div v-if="user.avatar === null">
                                        <img :src="defaultProfile" class=" rounded-lg w-8" alt="cover">
                                    </div>

                                    <div v-else>
                                        <img :src="showImage() + user.avatar" class=" rounded-full w-8"
                                             alt="cover">
                                    </div>

                                    <p class="mx-2">
                                        {{ user.username }}
                                    </p>
                                </div>

                                <a
                                    class="avatar  w-8 h-8  bg-gray-100 border-2 border-gray-200 border-opacity-25"
                                    :href="('/chatify/' + user.id )" style="border-radius: 15px;">
                                    <img :src="chat" width="15" height="15" class="absolute z-10 mx-1 my-2"
                                         alt="search">
                                </a>
                            </div>
                        </inertia-link>
                    </div>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import degreePicture from "/img/Degree/degreePicture.jpg";
import backButton from "/img/Tab/left-arrow.png";
import chat from "/img/Chat/chat-img.png";
import defaultProfile from "/img/Posts/defaultProfile.png";

export default {
    name: "Members",
    components: {
        BreezeAuthenticatedLayout,
    },

    data() {
        return {
            degreePicture: degreePicture,
            backButton: backButton,
            chat: chat,
            defaultProfile: defaultProfile,
        }
    },

    props: {
        users: Array,
        degree: Object,
    },

    methods: {
        showImage() {
            return "/storage/";
        },
        back() {
            window.history.back();
        },

    },
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

.members {
    position: absolute;
    top: 70%;
    color: white;
}
</style>
