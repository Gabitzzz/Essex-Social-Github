<template>
    <BreezeAuthenticatedLayout>

        <!--       -->

        <div class=" my-4 pb-20 mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">

            <div class="mx-2 mb-4 shadows-lg  ">
                <div class="rounded-lg shadow-md border-gray-200" style="position: relative;">

                    <!--                <img class="" src="https://images.unsplash.com/photo-1570169797118-99f5f90c4e25?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80">-->


                    <img :src="showImage() + party.partyImg"
                         class="object-cover rounded-lg w-full" alt="cover"
                         style="max-height: 250px;  filter: brightness(30%);">


                    <figcaption class="absolute text-lg text-white px-4 -mt-56 " style="left:0;  right: 0;">

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
                        </div>
                    </figcaption>
                </div>
            </div>

            <div class="flex mx-6 mt-4  ">
                <div class="px-4  flex ">
                    <img
                        :src="pin"
                        class="avatar  avatar w-10 h-10 mt-2  "
                        alt="default"
                    />

                    <div class="bg-white rounded-full my-2">
                        <p class="text-center text-xl py-1 px-4 ">
                            {{ party.location}}
                        </p>
                    </div>
                </div>

                <div class="flex">sal</div>
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


    },


}
</script>

<style scoped>

</style>
