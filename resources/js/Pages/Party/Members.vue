<template>
    <BreezeAuthenticatedLayout>
        <div class="my-4 mx-auto sm:mx-24 md:mx-30 lg:mx-72 xl:mx-60 2xl:mx-80">
            <div class="mx-2 mb-4 shadows-lg  ">
                <div class="rounded-lg shadow-md border-gray-200" style="position: relative;">
                    <img v-if="party.partyImg"
                         :src="showImage() + party.partyImg"
                         class="object-cover rounded-lg w-full" alt="cover"
                         style="max-height: 250px;  filter: brightness(30%);">
                    <img v-else
                         class="object-cover rounded-lg w-full" alt="cover"
                         :src="partyCover"
                         style="max-height: 250px;  filter: brightness(30%);">


                    <figcaption class="absolute text-lg text-white px-4 -mt-56 " style="left:0;  right: 0;">


                        <div v-if="party.user_id === $page.props.auth.user.id" class="absolute mr-5 -mt-6"
                             style="right: 0;">
                            <inertia-link preserve-scroll class="-mt-6" :href="route('party.edit', party.id)">
                                <!--                                      v-if="post.user.id === $page.props.auth.user.id"-->
                                <!--                                      class=" -mt-6  "-->
                                <!--                                      as="button"-->
                                <!--                                      :href="route('posts.edit', post.id)"-->

                                ...
                            </inertia-link>
                        </div>

                        <div class="text-right text-lg ">
                            <p class="">
                                {{ party.date }}
                            </p>

                            <p class="text-3xl text-red-600 ">
                                <strong>
                                    {{ party.time }}
                                </strong>
                            </p>
                        </div>

                        <div>
                            <h3 class=" text-3xl text-center text-white "
                                style="font-family: 'Poppins', sans-serif;">
                                {{ party.title }}
                            </h3>
                        </div>

                        <div>
                            <h1 class="text-center">
                                {{ party.body }}
                            </h1>

                            <div class="flex justify-center mt-4">
                                <inertia-link v-if="!$page.props.inviteToggle"
                                              as="button"
                                              class="follow button shadow-2xl  items-center px-3 py-1 bg-white border border-transparent rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-green-700 hover:text-white w-40 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                                              style="font-size: 80%;"
                                              preserve-scroll
                                              :href="`/parties/${party.id}/invites/${party.id}`"
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
                                              :href="`/parties/${party.id}/invites/${party.id}`"
                                              preserve-scroll
                                              method="DELETE">
                                    {{ showLeave ? 'Cancel' : '✓ Joining' }}
                                </inertia-link>


                            </div>

                            <div class="flex justify-center mt-12 text-sm">
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

            <div class=" mx-4 mt-8">
                <div class=" bg-white p-4 md:px-8 md:mx-16 rounded-xl">



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
                                   class="follow button shadow-2xl  items-center text-center  py-1 bg-white border border-transparent rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-green-700 hover:text-white w-40 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                                   :href="('/chatify/' + invite.user.id )" >
                                   TEXT
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
import Party from "@/Pages/Party/Party";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import pin from "/img/Posts/pin.png";
import partyCover from "/img/Party/partyCover.jpg";
import quote from "/img/Party/quote.png";
import dj from "/img/Party/dj.png";
import backButton from "/img/Tab/left-arrow.png";
import defaultProfile from "/img/Posts/defaultProfile.png";


export default {
    name: "Members",
    components: {
        BreezeAuthenticatedLayout,
        Parties,
        InertiaLink,
        Party,
    },
    data() {
        return {
            pin: pin,
            partyCover: partyCover,
            quote: quote,
            dj: dj,
            backButton: backButton,
            defaultProfile: defaultProfile,

        }
    },
    props: {
        party: Object,
        inviteToggle: Boolean,
        invites: Array,
        showLeave: Boolean,
        followToggle: Boolean,


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
