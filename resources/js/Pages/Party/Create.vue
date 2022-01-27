<template>
    <div>
        <BreezeAuthenticatedLayout>
            <form @submit.prevent="submit">
                <div class="mb-2">
                    <div class="mx-2 sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">


                        <div class="mt-5 max-2 overflow-hidden rounded-xl font-bold">
                            <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                                <!--                        DASHBOARD-->
                                Create New Party
                            </h1>
                        </div>

                        <BreezeInput id="body" type="text" class="mt-1 pb-10 block w-full bg-gray-100 "
                                     v-model="form.body"
                                     placeholder="Add new post"
                                     required autofocus autocomplete="name"/>
                    </div>
                </div>
                <div class="mx-2 sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">
                    <input
                        type="file"
                        @change="previewAvatar"
                        ref="photo"
                        class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                    />

                    <div class="flex flex-col justify-center items-center">
                        <img
                            v-if="url"
                            :src="url"
                            class="w-full mx-2 md:w-1/2 mt-4 h-80"
                        />
                    </div>
                </div>

                <!--                <Calendar />-->
                <!--                <DatePicker v-model="date" />-->
                <div class="mx-2 sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">

                    <DatePicker v-model="date" mode="dateTime" is-expanded/>

                    <div class="mt-5 max-2 overflow-hidden rounded-xl font-bold">
                        <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                            <!--                        DASHBOARD-->
                            Invite people
                        </h1>
                    </div>

                    <div v-for="follower in $page.props.followers.data" :key="follower.id" >

                        <inertia-link class="px-6 py-4 flex items-center" :href="route('profile', follower.username)" tabindex="-1">
                            {{ follower.name }}
                        </inertia-link>
                    </div>

                    <pagination class="mt-6" :links="followers.links" />

                </div>



                <div class=" mb-10 grid justify-items-center">
                    <loading-button :loading="form.processing"
                                    class="button px-8 py-2 " type="submit">
                        ADD POST
                    </loading-button>
                </div>
            </form>

            <div class="mx-2 sm:mx-16 md:mx-24 pb-24 lg:mx-72 xl:mx-96">

                <div class=" grid grid-cols-3 gap-4 content-center ...">
                    <div class="bg-white rounded-2xl hover:bg-gray-300">
                        <a :href="route('posts.create', $page.props.auth.user.username )"
                           class="w-full justify-center inline-block text-center pt-2 pb-1"
                        >
                            <img :src="post" width="40" height="40" class="inline-block" alt="plus">
                        </a>
                    </div>
                    <div class="bg-white rounded-2xl bg-gray-300">

                        <a :href="route('party.create', $page.props.auth.user.username )"
                           class="w-full  justify-center inline-block text-center pt-2 pb-1"
                        >
                            <img :src="party" width="40" height="40" class="inline-block" alt="plus">
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl hover:bg-gray-300">
                        <a :href="route('posts.create', $page.props.auth.user.username )"
                           class="w-full justify-center inline-block text-center pt-2 pb-1"
                        >
                            <img :src="event" width="40" height="40" class="inline-block" alt="plus">
                        </a>
                    </div>
                </div>
            </div>
        </BreezeAuthenticatedLayout>
    </div>
</template>

<script>
import FileInput from "@/Components/FileInput";
import TextInput from "@/Components/TextInput";
import LoadingButton from "@/Components/LoadingButton";
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import post from "/img/Posts/post.png";
import party from "/img/Posts/party.png";
import event from "/img/Posts/event.png";
import Datepicker from 'vuejs-datepicker';
import {Calendar, DatePicker} from 'v-calendar';
import Pagination from '@/Components/Pagination';
import {InertiaLink} from "@inertiajs/inertia-vue3";


export default {
    name: "Create",


    components: {
        BreezeAuthenticatedLayout,
        FileInput,
        TextInput,
        LoadingButton,
        BreezeInput,
        BreezeLabel,
        Calendar,
        DatePicker,
        Pagination,
        InertiaLink,
    },
    props: {
        // users: Object,
        followers: Object,
    },

    data() {
        return {
            // avatar: avatar,
            post: post,
            party: party,
            event: event,
            url: null,
            userPosts: this.posts,
            form: this.$inertia.form({
                body: null,
                image: null,

            }),
            date: new Date(),
        }
    },


    methods: {

        submit() {
            if (this.$refs.photo) {
                this.form.image = this.$refs.photo.files[0];
            }

            this.form.post(this.route('posts.store'))
        },

        previewAvatar(e) {
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file);
        },

    },

    // created() {
    //     debugger
    // },
}


</script>

<style scoped>
.button {
    border-radius: 25px;
    color: ghostwhite;
    background-color: black;
    /*width: 100%;*/
    /*display: inline;*/
    text-align: center;
    font-size: 12px;
    font-family: 'Nunito', sans-serif;
}
</style>
