<template>
    <BreezeAuthenticatedLayout>
        <div class=" my-4 pb-20 mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
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



                        <div v-if="party.user_id === $page.props.auth.user.id" class="absolute mr-5 -mt-6" style="right: 0;">
                            <inertia-link preserve-scroll class="-mt-6" :href="route('parties.edit', party.id)">
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
                                <div v-if="party.invites.length === 0">
<!--                                    {{party.invites.length}}-->

                                </div>
                                <div v-else-if="party.invites.length === 1">
                                    {{party.invites.length}} person is coming
                                </div>
                                <div v-else>
                                    {{party.invites.length}} people are coming
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

            <div class="flex justify-between mx-4">
                <div class="flex ">
                    <img
                        :src="pin"
                        class="avatar  avatar w-10 h-10 mt-2  "
                        alt="default"
                    />

                    <div class="bg-white rounded-full my-2 ">
                        <p class="text-center text-nd py-2 px-4  ">
                            {{ party.location }}
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
                            Organized by {{ party.user.username }}
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

                   {{party.description}}
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



export default {
    name: "Index",
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

        }
    },
    props: {
        party: Object,
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
