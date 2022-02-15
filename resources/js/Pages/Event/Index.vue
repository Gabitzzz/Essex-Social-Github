<template>
    <BreezeAuthenticatedLayout>
        <div class=" my-4 pb-20 mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
            <div class="mx-2 mb-4 shadows-lg  ">
                <div class="rounded-lg shadow-md border-gray-200" style="position: relative;">
                    <img v-if="event.eventImg"
                         :src="showImage() + event.eventImg"
                         class="object-cover rounded-lg w-full" alt="cover"
                         style="max-height: 250px;  filter: brightness(30%);">
                    <img v-else
                         class="object-cover rounded-lg w-full" alt="cover"
                         :src="eventCover"
                         style="max-height: 250px;  filter: brightness(30%);">


                    <figcaption class="absolute text-lg text-white px-4 -mt-56 " style="left:0;  right: 0;">



                        <div v-if="event.user_id === $page.props.auth.user.id" class="absolute mr-5 -mt-6" style="right: 0;">
                            <inertia-link preserve-scroll class="-mt-6" :href="route('event.edit', event.id)">
                                <!--                                      v-if="post.user.id === $page.props.auth.user.id"-->
                                <!--                                      class=" -mt-6  "-->
                                <!--                                      as="button"-->
                                <!--                                      :href="route('posts.edit', post.id)"-->

                                ...
                            </inertia-link>
                        </div>

                        <div class="text-right text-lg ">
                            <p class="">
                                {{ event.date }}
                            </p>

                            <p class="text-3xl text-red-600 ">
                                <strong>
                                    {{ event.time }}
                                </strong>
                            </p>
                        </div>

                        <div>
                            <h3 class=" text-3xl text-center text-white "
                                style="font-family: 'Poppins', sans-serif;">
                                {{ event.title }}
                            </h3>
                        </div>

                        <div>
                            <h1 class="text-center">
                                {{ event.body }}
                            </h1>

                            <div class="flex justify-center mt-4">
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

                            <div class="flex justify-center mt-12 text-sm">
                                <div v-if="event.invites.length === 0">
<!--                                    {{party.invites.length}}-->

                                </div>
                                <div v-else-if="event.invites.length === 1">
                                    {{event.invites.length}} person is coming
                                </div>
                                <div v-else>
                                    {{event.invites.length}} people are coming
                                </div>

                            </div>

                        </div>
                    </figcaption>
                </div>
            </div>

            <div class="flex mx-4 mt-4">
                <div class=" w-1/4 flex ">
                </div>
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
                        :src="dj"
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

           <div class="flex justify-end mx-4 mt-8">
               <InertiaLink @click="back"
                            class="ml-1 h-6 w-6 rounded-full">
                   <img :src="backButton" alt="">
               </InertiaLink>

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

                   {{event.description}}
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
import eventCover from "/img/Party/partyCover.jpg";
import quote from "/img/Party/quote.png";
import dj from "/img/Party/dj.png";
import backButton from "/img/Tab/left-arrow.png";



export default {
    name: "Index",
    components: {
        BreezeAuthenticatedLayout,
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

        }
    },
    props: {
        event: Object,
        inviteToggle: Boolean,
        invites: Array,
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
