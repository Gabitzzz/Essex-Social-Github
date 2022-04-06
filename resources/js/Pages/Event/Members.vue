<template>
    <BreezeAuthenticatedLayout>
            <div class="my-4 mx-auto sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">
            <div class="mx-2 mb-4 shadows-lg  ">
                <div class="rounded-lg shadow-md bg-white border-gray-20 pb-6" style="position: relative;">
                    <img v-if="event.eventImg"
                         :src="showImage() + event.eventImg"
                         class="object-cover rounded-t-lg w-full" alt="cover"
                         style="max-height: 150px;  filter: brightness(30%);">
                    <img v-else
                         class="object-cover rounded-t-lg w-full" alt="cover"
                         :src="eventCover"
                         style="max-height: 150px;  filter: brightness(30%);">

                    <figcaption class="absolute text-lg text-white px-4 -mt-32 " style="left:0;  right: 0;">
                        <div v-if="event.user_id === $page.props.auth.user.id" class="absolute mr-5 -mt-6" style="right: 0;">
                            <inertia-link preserve-scroll class="-mt-6" :href="route('event.edit', event.id)">
                                ...
                            </inertia-link>
                        </div>

                        <div class="text-right text-lg ">
                            <p class="">
                                {{ event.day }}
                            </p>

                            <p class="text-3xl text-red-600 ">
                                <strong>
                                    {{ event.time }}
                                </strong>
                            </p>
                        </div>



                        <div>
                            <h1 class="text-center">
                                {{ event.body }}
                            </h1>

                            <div class="flex justify-center  ">
                                <inertia-link v-if="!$page.props.inviteToggle"
                                              as="button"
                                              class="follow button shadow-2xl  items-center px-3 py-1 bg-white border border-transparent rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-green-700 hover:text-white w-40 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                                              style="font-size: 80%;"
                                              preserve-scroll
                                              :href="`/events/${event.id}/invites/${event.id}`"
                                              method="POST">
                                    Join
                                </inertia-link>

                                <inertia-link v-if="$page.props.inviteToggle"
                                              as="button"
                                              @mouseover="showLeave = true"
                                              @mouseleave="showLeave = false"
                                              class="follow button shadow-2xl  items-center px-3 py-1 bg-white border border-transparent
                                                        rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-red-600 hover:text-white
                                                        active:bg-green-700 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray
                                                        transition ease-in-out duration-150 w-40"
                                              style="font-size: 80%;"
                                              :href="`/events/${event.id}/invites/${event.id}`"
                                              preserve-scroll
                                              method="DELETE">
                                    {{ showLeave ? 'Cancel' : '✓ Joining' }}
                                </inertia-link>


                            </div>


                            <div class="flex justify-center  text-sm mt-2">
                                <div v-if="invites.length === 0">
                                    <!--                                    {{party.invites.length}}-->

                                </div>
                                <div v-else-if="invites.length === 1">
                                    {{ invites.length }} person is coming
                                </div>
                                <div v-else>
                                    {{ invites.length }} people are coming
                                </div>
                            </div>

                        </div>
                    </figcaption>

                    <div>
                        <h3 class=" text-3xl text-center mt-6 "
                            style="font-family: 'Poppins', sans-serif;">
                            {{ event.title }}
                        </h3>
                    </div>
                </div>
            </div>

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
                    <div v-for="invite in invites" :key="invite" class="mt-5  items-center border-b border-gray-200 ">
                        <inertia-link class="-mt-6" :href="route('profile', invite.user.username)">
                            <div class="flex items-center justify-between my-2">
                                <div class="flex items-center  ">
                                    <div v-if="invite.user.avatar === null">
                                        <img :src="defaultProfile" class="cover rounded-lg w-8" alt="cover">
                                    </div>

                                    <div v-else>
                                        <img :src="showImage() + invite.user.avatar" class="cover rounded-full w-8"
                                             alt="cover">
                                    </div>

                                    <p class="mx-2">
                                        {{ invite.user.username }}
                                    </p>
                                </div>

                                <a
                                    class="avatar  w-8 h-8  bg-gray-100 border-2 border-gray-200 border-opacity-25"
                                    :href="('/chatify/' + invite.user.id )" style="border-radius: 15px;">
                                    <img :src="chat" width="15" height="15" class="absolute z-10 mx-1 my-2" alt="search">

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
import Parties from "@/Pages/Party/Parties";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import pin from "/img/Posts/pin.png";
import quote from "/img/Party/quote.png";
import dj from "/img/Party/dj.png";
import backButton from "/img/Tab/left-arrow.png";
import defaultProfile from "/img/Posts/defaultProfile.png";
import eventCover from "/img/Party/eventCover.jpg";
import chat from "/img/Chat/chat-img.png";

export default {
    name: "Members",
    components: {
        BreezeAuthenticatedLayout,
        Parties,
        InertiaLink,
        Event,
    },
    data() {
        return {
            pin: pin,
            eventCover: eventCover,
            quote: quote,
            dj: dj,
            backButton: backButton,
            defaultProfile: defaultProfile,
            chat: chat,

        }
    },
    props: {
        inviteToggle: Boolean,
        event:Object,
        invites: Array,
        showLeave: Boolean,

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

</style>
