<template>
    <div>
        <BreezeAuthenticatedLayout>
            <form @submit.prevent="submit">
                <div class="mb-2">
                    <div class="mx-2 sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">


                        <div class="mt-5 max-2 overflow-hidden rounded-xl font-bold">
                            <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                                <!--                        DASHBOARD-->
                                Organize a party
                            </h1>
                        </div>

                        <BreezeInput id="body" type="text" class="mt-1 block w-full bg-gray-100 "
                                     style="border: none !important;"
                                     v-model="form.title"
                                     placeholder="Party Name"
                                     required autofocus autocomplete="title"/>

                        <BreezeInput id="body" type="text" class="mt-4 pb-10 block w-full bg-gray-100 "
                                     style="border: none !important;"
                                     v-model="form.body"
                                     placeholder="Party Description"
                                     required autofocus autocomplete="body"/>
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

                <div class="mx-2 sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">
                    <p class="mx-4 my-2 text-lg" style="font-family: 'Poppins', sans-serif;">Select date</p>

                    <DatePicker
                        v-model="form.date"
                        is-expanded
                        is24hr
                        format="YYYY-MM-DD"
                        :masks="{ L: 'YYYY-MM-DD' }"
                        mode="dateTime"
                        :min-date='new Date()'

                    >
                    </DatePicker>


                    <div class="flex mt-4 lg:mx-4 ">
                        <img :src="location2" width="40" alt="plus">

                        <BreezeInput id="body" type="text" class=" ml-2 block w-full bg-gray-100 "
                                     style="border: none !important;"
                                     v-model="form.location"
                                     placeholder="Location"
                                     required autofocus autocomplete="location"/>
                    </div>

                    <!--                    PUBLIC OR PRIVATE SWITCH        -->
                    <div class="flex justify-center mt-5" style="font-family: 'Poppins', sans-serif;">
                        <div class="form-check form-check-inline">
                            <input
                                v-model.number="typeOfTask" :value="1" id="defaultCheck1"
                                type="radio"
                                class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-black checked:border-black focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer">

                            <label class="form-check-label inline-block text-gray-800" for="defaultCheck1">
                                PUBLIC
                            </label>

                        </div>
                        <div class="form-check form-check-inline ml-4">
                            <input
                                v-model.number="typeOfTask" type="radio" :value="2" id="scheduleCheck"
                                class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer">

                            <label class="form-check-label inline-block text-gray-800" for="scheduleCheck">
                                PRIVATE
                            </label>
                        </div>
                    </div>

                    <div v-if="typeOfTask === 1">
                        <div class="mt-5 max-2 overflow-hidden rounded-xl font-bold">
                            <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                                <!--                        DASHBOARD-->
                                Public Party
                            </h1>
                            <p class="text-sm px-2 " style="font-family: 'Poppins', sans-serif; font-weight: 100;">
                                <i>
                                    Public parties can be seen and joined by everyone.
                                    Your party will appear on the activity page.
                                    <br>
                                </i>
                            </p>

                        </div>
                    </div>

                    <div v-if="typeOfTask === 2">

                        <div class="mt-5 max-2 overflow-hidden rounded-xl font-bold">
                            <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                                <!--                        DASHBOARD-->
                                Private Party
                            </h1>
                            <p class="text-sm px-2" style="font-family: 'Poppins', sans-serif; font-weight: 100;">
                                <i>
                                    Private parties work only with invitation.
                                    <br>
                                    Select friends that you want to attend the party.
                                </i>
                            </p>

                        </div>

                        <div v-for="follower in $page.props.followers.data" :key="follower.id">

                            <inertia-link class="px-6 py-4 flex items-center"
                                          :href="route('profile', follower.username)"
                                          tabindex="-1">
                                {{ follower.name }}
                            </inertia-link>
                        </div>
                    </div>


                    <!--                    <pagination class="mt-6" :links="followers.links" />-->

                </div>


                <div class=" mb-10 grid justify-items-center">
                    <loading-button :loading="form.processing"
                                    class="button px-8 py-2 " type="submit">
                        ADD POST
                    </loading-button>
                </div>
            </form>

            <!--            ADD TAB     -->
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
import location2 from "/img/Party/location2.png";


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
            modelConfig: {
                type: 'string',
                masks: {

                    L: 'YYYY-MM-DD HH:MM', // Uses 'iso' if missing
                }
            },
            // avatar: avatar,
            post: post,
            party: party,
            event: event,
            location2: location2,
            url: null,
            userPosts: this.posts,
            form: this.$inertia.form({
                body: null,
                title: null,
                date: null,
                partyImg: null,
                location: null,

            }),
            date: new Date(),
            checked: null,
            items: [
                {name: 'Public'},
                {name: 'Private'},
            ],
            typeOfTask: null, // 1 = recurring, 2 = scheduled
        }
    },


    methods: {


        submit() {
            if (this.$refs.photo) {
                this.form.partyImg = this.$refs.photo.files[0];
            }

            this.form.post(this.route('party.store'))
        },

        previewAvatar(e) {
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file);
        },
        check_one: function () {
            this.additional = [];
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
