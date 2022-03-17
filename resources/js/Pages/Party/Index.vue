<template>
    <BreezeAuthenticatedLayout>
        <Head title="Party"/>

        <div class="my-4 mx-auto sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">
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
                            <inertia-link class="-mt-6" :href="route('party.edit', party.id)">
                                <!--                                      v-if="post.user.id === $page.props.auth.user.id"-->
                                <!--                                      class=" -mt-6  "-->
                                <!--                                      as="button"-->
                                <!--                                      :href="route('posts.edit', post.id)"-->

                                ...
                            </inertia-link>
                        </div>

                        <div class="text-right text-lg ">
                            <p class="">
                                {{ party.day }}
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


                            <inertia-link :href="route('party.members', party)">

                                <div class="flex justify-center mt-12 text-sm">
                                    <div v-if="party.invites.length === 0">
                                        <!--                                    {{party.invites.length}}-->

                                    </div>
                                    <div v-else-if="party.invites.length === 1">
                                        {{ party.invites.length }} person is coming
                                    </div>
                                    <div v-else>
                                        {{ party.invites.length }} people are coming
                                    </div>
                                </div>

                            </inertia-link>

                        </div>
                    </figcaption>
                </div>
            </div>

            <!--                BACK BUTTON -->
            <div class="flex justify-between mx-4  ">
                <div class="flex items-center">
                    <img
                        :src="pin"
                        class="avatar  avatar w-8 h-8   "
                        alt="default"
                    />

                    <div class="bg-white rounded-full my-2 ml-1 ">
                        <p class="text-center text-md py-2 px-4  ">
                            {{ party.location }}
                        </p>
                    </div>
                </div>

                <InertiaLink @click="back"
                             class="ml-1 h-6 w-6 rounded-full">
                    <img :src="backButton" alt="">
                </InertiaLink>
            </div>

            <!--    LOCATION / ORGANIZER    -->
            <div class=" mx-4">


                <div class="flex items-center">
                    <img
                        :src="dj"
                        class="avatar w-8 h-8 mt-2  "
                        alt="default"
                    />

                    <div class="bg-white rounded-full my-2 ml-1 ">
                        <p class="text-center text-md py-2 px-4  ">
                            Organized by
                            <inertia-link :href="route('profile', party.user.username)" class="font-semibold">
                                {{ party.user.username }}
                            </inertia-link>
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex items-center ">

                <div class="bg-white w-full rounded-2xl my-2 divide-y px-4">
                    <div class="flex items-center mb-1">
                        <img
                            :src="quote"
                            class="avatar  w-8 h-8 mt-2   "
                            alt="default"
                        />
                        <p class="mx-4 font-semibold">
                            Description
                        </p>
                    </div>

                    <p class=" text-md py-2   ">
                        {{ party.description }}
<!--                        hello-->
                    </p>
                </div>
            </div>

            <div class="mx-2 max-2 rounded-xl ">
                <form @submit.prevent="submit" class="w-full">
                    <div class="flex mt-5">
                        <BreezeInput id="body" type="text" class="block w-full h-10 mx-1" v-model="form.body"
                                     placeholder="  leave a comment"
                                     required autofocus autocomplete="name"/>

                        <button type="submit"
                                class="button px-6 shadow-2xl  md:mx-2"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                            SUBMIT
                        </button>
                    </div>

                    <div class="flex justify-between my-3">
                        <div>
                        </div>
                    </div>
                </form>
            </div>


            <div v-for="(comment, index) in comments" :key="index">
                <Comment :comment="comment"></Comment>
            </div>

        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Parties from "@/Pages/Party/Parties";
import Comment from "@/Pages/Party/Comment";
import Party from "@/Pages/Party/Party";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import pin from "/img/Posts/pin.png";
import partyCover from "/img/Party/partyCover.jpg";
import quote from "/img/Party/quote.png";
import dj from "/img/Party/dj.png";
import backButton from "/img/Tab/left-arrow.png";
import {Head} from '@inertiajs/inertia-vue3';
import BreezeInput from '@/Components/Input.vue';


export default {
    name: "Index",
    components: {
        BreezeAuthenticatedLayout,
        Parties,
        InertiaLink,
        Party,
        Head,
        BreezeInput,
        Comment,
    },
    data() {
        return {
            form: this.$inertia.form({
                body: null,
            }),

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
        showLeave: Boolean,
        comments: Array,

    },
    methods: {
        submit() {
            this.form.post(this.route('party.comments.store', this.party), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.body = null
                }
            })
        },
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
