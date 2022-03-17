<template>
    <BreezeAuthenticatedLayout>
        <Head title="Event"/>

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
                        <div v-if="event.user_id === $page.props.auth.user.id" class="absolute mr-5 -mt-6"
                             style="right: 0;">
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

                            <inertia-link :href="route('event.members', event)">

                                <div class="flex justify-center  text-sm mt-2">
                                    <div v-if="event.invites.length === 0">
                                        <!--                                    {{party.invites.length}}-->

                                    </div>
                                    <div v-else-if="event.invites.length === 1">
                                        {{ event.invites.length }} person is coming
                                    </div>
                                    <div v-else>
                                        {{ event.invites.length }} people are coming
                                    </div>

                                </div>
                            </inertia-link>

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

            <div class="flex justify-end mx-4">
                <InertiaLink @click="back"
                             class="ml-1 h-6 w-6 rounded-full">
                    <img :src="backButton" alt="">
                </InertiaLink>
            </div>


            <div class=" mx-4">
                <div class="flex  ">
                    <img
                        :src="pin"
                        class="avatar  avatar w-10 h-10 mt-2  "
                        alt="default"
                    />

                    <div class="bg-white rounded-full my-2 ">
                        <p class="text-center md:text-nd py-2 px-4  ">
                            {{ event.location }}
                        </p>
                    </div>
                </div>

                <div class="flex">
                    <img
                        :src="organizer"
                        class="avatar  avatar w-10 h-10 mt-2  "
                        alt="default"
                    />

                    <div class="bg-white rounded-full my-2 ml-1 ">
                        <p class="text-center text-md py-2 px-4  ">
                            Organized by {{ event.user.username }}
                        </p>
                    </div>
                </div>
            </div>


            <div class=" mx-4 mt-8">
                <div class="text-center bg-white p-4 md:px-8 md:mx-16 rounded-xl">
                    <div class="flex justify-center mb-4">
                        <img
                            :src="quote"
                            class="avatar text-center w-10 h-10 mt-2  "
                            alt="default"
                        />
                    </div>

                    {{ event.description }}
                </div>
            </div>

        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Events from "@/Pages/Event/Events";
import Event from "@/Pages/Event/Event";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import pin from "/img/Posts/pin.png";
import eventCover from "/img/Party/eventCover.jpg";
import quote from "/img/Party/quote.png";
import organizer from "/img/Party/organizer.png";
import backButton from "/img/Tab/left-arrow.png";
import {Head} from '@inertiajs/inertia-vue3';


export default {
    name: "Index",
    components: {
        BreezeAuthenticatedLayout,
        InertiaLink,
        Event,
        Head,
    },
    data() {
        return {
            pin: pin,
            eventCover: eventCover,
            quote: quote,
            organizer: organizer,
            backButton: backButton,

        }
    },
    props: {
        event: Object,
        inviteToggle: Boolean,
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
