<template>
    <Head title="Dashboard"/>

    <BreezeAuthenticatedLayout>
        <div class="pb-1 mx-auto sm:mx-24 md:mx-30 lg:mx-72 xl:mx-60 2xl:mx-80">

            <!--                <divclass=" mt-5 px-2 max-2 overflow-hidden rounded-xl font-bold ">-->
            <div class="mt-5 font-bold  overflow-hidden max-w-7xl ">

                <h1 class="text-4xl mx-2  py-2" style="font-family: 'Poppins', sans-serif;">
                    Welcome {{ $page.props.auth.user.username }}
                </h1>


                <p class="px-2  text-sm lg:text-md"
                   style="font-weight:lighter;">
                    This is your Dashboard. <br>
                    Here you will find some shortcuts that will help you.
                    <br>
                </p>
            </div>


            <div class="mt-5 flex flex-wrap overflow-hidden max-w-7xl ">
                <div class="w-1/2 overflow-hidden sm:w-1/Q xl:w-6/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 weather overflow-hidden rounded-xl shadow-lg">
                        <h1 class="text-3xl text-white px-4 py-4 ">
                            Colchester <br>
                            17°
                        </h1>
                    </div>


                </div>

                <div class="w-1/2 sm:w-1/2 overflow-hidden md:w-6/12">
                    <!-- Column Content -->
                    <div class=" mx-1 max-2 calendar overflow-hidden shadow-lg rounded-xl shadow-md">
                        <h2 class="text-3xl text-white px-6 pt-4">Today</h2>
                        <h1 class="text-3xl text-white px-6 pb-4 ">{{ formatDate() }}</h1>
                    </div>
                </div>
            </div>

            <!--                ROW WITH 4 CARDS     -->
            <div class="mt-5  flex flex-wrap overflow-hidden max-w-7xl ">

                <div class="w-1/4 overflow-hidden xl:w-3/12">
                    <!-- Column Content -->
                    <div class="mx-1 mb-4 max-2 overflow-hidden rounded-2xl bg-white shadow-md  ">
                        <a href="https://www.essex.ac.uk/sport">
                            <img :src="essex_sport" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                        </a>
                    </div>
                </div>

                <div class="w-1/4 overflow-hidden  xl:w-3/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 bg-white overflow-hidden shadow-md rounded-2xl shadow-md  ">
                        <a href="https://www.essex.ac.uk/information/food-and-drink/food-and-drink-at-colchester-campus">
                            <img :src="essex_food" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                        </a>
                    </div>
                </div>

                <div class="w-1/4 overflow-hidden xl:w-3/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 bg-white overflow-hidden  rounded-2xl shadow-md  ">

                        <a href="https://www.essexstudent.com/campus/">
                            <img :src="su" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                        </a>
                    </div>
                </div>

                <div class="w-1/4 overflow-hidden xl:w-3/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 bg-white overflow-hidden rounded-2xl shadow-md   ">
                        <a href="https://www.essexstudent.com/societies/">
                            <img :src="societies" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                        </a>
                    </div>
                </div>
            </div>

            <!--            BIG SLIDER      -->
            <div class="  ">
                <div
                    id="scrollContainer"
                    class="flex flex-no-wrap overflow-x-scroll scrolling-touch items-start pb-8  hide-scroll-bar">
                    <div class="inline-block px-2">
                        <div
                            class="w-32 h-32 max-w-xs overflow-hidden rounded-2xl shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                            <a href="https://moodle.essex.ac.uk/">
                                <img :src="moodle" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                            </a>
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-32 h-32 max-w-xs overflow-hidden rounded-2xl shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                            <a href="https://leap.essex.ac.uk/student">
                                <img :src="leap" class="inline-block px-4 py-4 lg:px-8 lg:py-8" alt="plus">
                            </a>
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-32 h-32 max-w-xs overflow-hidden rounded-2xl shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                            <a href="https://faser.essex.ac.uk/">
                                <img :src="faser" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                            </a>
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-32 h-32 max-w-xs overflow-hidden rounded-2xl shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                            <a href="https://listenagain.essex.ac.uk/">
                                <img :src="listen_again" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                            </a>
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-32 h-32 max-w-xs overflow-hidden rounded-2xl shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                            <img :src="listen_again" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-32 h-32 max-w-xs overflow-hidden rounded-2xl shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                            <img :src="listen_again" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                        </div>
                    </div>
                </div>
            </div>

            <!--            ACTIVITIES SLIDER        -->
            <div class="">
                <div class=" max-2 overflow-hidden rounded-xl font-bold">
                    <h1 class="text-4xl px-2" style="font-family: 'Poppins', sans-serif;">
                        Activities
                    </h1>
                </div>

                <div
                    id="scrollContainer2"
                    class="flex flex-no-wrap overflow-x-scroll scrolling-touch items-start mt-5  pb-5 hide-scroll-bar">
                    <div class="inline-block pr-2">
                        <div
                            class="w-20 h-20 lg:w-32 lg:h-32 max-w-xs overflow-hidden rounded-2xl shadow-md bg-white hover:shadow-lg transition-shadow duration-300 ease-in-out"
                        >
                            <a :href="route('posts.create', $page.props.auth.user.username )"
                               class="">
                                <img :src="post" class="inline-block px-4 py-4  lg:px-8 lg:py-8" alt="plus">
                            </a>
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-20 h-20 lg:w-32 lg:h-32 max-w-xs overflow-hidden rounded-2xl shadow-md bg-white hover:shadow-lg transition-shadow duration-300 ease-in-out">
                            <a :href="route('party.create', $page.props.auth.user.username )"
                            >
                                <img :src="party" class="inline-block px-4 py-4 lg:px-8 lg:py-8" alt="plus">
                            </a>
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-20 h-20 lg:w-32 lg:h-32 max-w-xs overflow-hidden rounded-2xl shadow-md bg-white hover:shadow-lg transition-shadow duration-300 ease-in-out">
                            <InertiaLink :href="route('event.create')"
                                         class=" justify-center inline-block text-center"
                            >
                                <img :src="event" class="inline-block px-4 py-4 lg:px-8 lg:py-8" alt="plus">

                            </InertiaLink>
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-20 h-20 lg:w-32 lg:h-32 max-w-xs overflow-hidden rounded-2xl shadow-md bg-white hover:shadow-lg transition-shadow duration-300 ease-in-out">
                            <a :href="route('explore')"
                            >
                                <img :src="explore" class="inline-block px-4 py-4 lg:px-8 lg:py-8" alt="plus">
                            </a>
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-20 h-20 lg:w-32 lg:h-32 max-w-xs overflow-hidden rounded-2xl shadow-md bg-white hover:shadow-lg transition-shadow duration-300 ease-in-out"
                        >
                            <InertiaLink :href="route('party.show')"
                                         class=" justify-center inline-block text-center"
                            >
                                <img :src="partylogo" class="inline-block px-4 py-4 lg:px-8 lg:py-8" alt="plus">
                            </InertiaLink>
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-20 h-20 lg:w-32 lg:h-32 max-w-xs overflow-hidden rounded-2xl shadow-md bg-white hover:shadow-lg transition-shadow duration-300 ease-in-out"
                        >
                            <InertiaLink :href="route('event.show')"
                                         class=" justify-center inline-block text-center"
                            >
                                <img :src="eventlogo" class="inline-block px-4 py-4 lg:px-8 lg:py-8" alt="plus">
                            </InertiaLink>
                        </div>
                    </div>

                    <div class="inline-block px-2">

                        <div
                            class="w-20 h-20 lg:w-32 lg:h-32 max-w-xs overflow-hidden rounded-2xl shadow-md bg-white hover:shadow-lg transition-shadow duration-300 ease-in-out"
                        >
                            <form @submit.prevent="signout()">
                                <button as="button"
                                        type="submit" class="justify-center inline-block text-center">
                                    <img :src="logout" class="inline-block px-4 py-4 lg:px-8 lg:py-8" alt="logout">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!--                END OF SLIDER       -->

                <!--                SHORTCUTS       -->
                <div class=" px-2 max-2 ml-4 overflow-hidden rounded-xl font-bold">
                    <div class="flex mt-2">

                        <div
                            class="w-10 h-10  max-w-xs overflow-hidden rounded-2xl transition-shadow duration-300 ease-in-out"
                        >
                            <InertiaLink :href="route('followers', $page.props.auth.user)"
                                         class=" justify-center inline-block text-center"
                            >
                                <img :src="followerslogo" class="inline-block p-1" alt="plus">
                            </InertiaLink>
                        </div>

                        <InertiaLink :href="route('followers', $page.props.auth.user)"
                                     class=" justify-center inline-block text-center"
                        >
                            <p class="text-md p-2 md:mx-0 font-light" style="font-family: 'Poppins', sans-serif;">
                                Followers
                            </p>
                        </InertiaLink>
                    </div>

                    <div class="flex mt-2">

                        <div
                            class="w-10 h-10  max-w-xs overflow-hidden rounded-2xl transition-shadow duration-300 ease-in-out"
                        >
                            <InertiaLink :href="route('followings', $page.props.auth.user)"
                                         class=" justify-center inline-block text-center"
                            >
                                <img :src="followinglogo" class="inline-block p-1" alt="plus">
                            </InertiaLink>
                        </div>

                        <InertiaLink :href="route('followings', $page.props.auth.user)"
                                     class=" justify-center inline-block text-center"
                        >
                            <p class="text-md p-2 md:mx-0  font-light" style="font-family: 'Poppins', sans-serif;">
                                Following
                            </p>
                        </InertiaLink>

                    </div>

                    <div class="flex mt-2">

                        <div
                            class="w-10 h-10  max-w-xs overflow-hidden rounded-2xl transition-shadow duration-300 ease-in-out"
                        >
                            <InertiaLink :href="route('party.show')"
                                         class=" justify-center inline-block text-center"
                            >
                                <img :src="societieslogo" class="inline-block p-1" alt="plus">
                            </InertiaLink>
                        </div>

                        <p class="text-md p-2 md:mx-0  font-light" style="font-family: 'Poppins', sans-serif;">
                            Societies
                        </p>
                    </div>

                    <div class="flex mt-2">
                        <div
                            class="w-10 h-10  max-w-xs overflow-hidden rounded-2xl transition-shadow duration-300 ease-in-out"
                        >
                            <InertiaLink :href="route('party.show')"
                                         class=" justify-center inline-block text-center"
                            >
                                <img :src="degree" class="inline-block p-1" alt="plus">
                            </InertiaLink>
                        </div>

                        <p class="text-md p-2 md:mx-0  font-light" style="font-family: 'Poppins', sans-serif;">
                            Degree
                        </p>
                    </div>
                </div>


                <!--          PARTIES     -->
                <div class="mt-5">
                    <div class="flex justify-between items-center  px-2">
                        <h1 class="text-4xl  font-bold" style="font-family: 'Poppins', sans-serif;">
                            Your Parties
                        </h1>


                        <inertia-link :href="route('party.show')"
                                      class="mx-2">
                            SEE ALL

                        </inertia-link>
                    </div>

                    <div v-if="parties.length === 0">
                        <p class="mx-2 my-4 " style="font-family: 'Poppins', sans-serif; font-weight: 100 !important;">
                            You haven't join to any Party yet!

                        </p>
                    </div>

                    <div else
                         id="scrollContainer3"
                         class="flex flex-no-wrap overflow-x-scroll scrolling-touch items-start  pb-5 hide-scroll-bar">
                        <div v-for="party in parties" :key="party" class="mt-5">

                            <div class="inline-block  ">
                                <div
                                    class="w-screen   max-w-sm md:max-w-xl overflow-hidden rounded-2xl transition-shadow duration-300 ease-in-out"
                                >
                                    <Party :party="party" :invites="party.invites"></Party>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="">
                    <div class="flex justify-between items-center px-2">
                        <h1 class="text-4xl font-bold" style="font-family: 'Poppins', sans-serif;">
                            Your Events
                        </h1>

                        <inertia-link :href="route('event.show')"
                                      class="mx-2">
                            SEE ALL

                        </inertia-link>

                    </div>

                    <div v-if="events.length === 0">
                        <p class="mx-2 my-4 " style="font-family: 'Poppins', sans-serif; font-weight: 100 !important;">
                            You haven't join to any Event yet!

                        </p>
                    </div>

                    <div v-else
                         id="scrollContainer4"
                         class="flex flex-no-wrap overflow-x-scroll scrolling-touch items-start  pb-5 hide-scroll-bar">
                        <div v-for="event in events" :key="event" class="mt-5">

                            <div class="inline-block  ">
                                <div
                                    class="w-screen   max-w-sm md:max-w-xl overflow-hidden rounded-2xl transition-shadow duration-300 ease-in-out"
                                >
                                    <Event :event="event" :invites="event.invites"></Event>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--                    <div v-for="event in events" :key="event.events">-->
                <!--                        <Event :event="event"></Event>-->
                <!--                    </div>-->


            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';
import plus from "/img/Tab/plus.png";
import search from "/img/Tab/search.png";
import partylogo from "/img/Tab/partypeople.png";
import essex_sport from "/img/Dashboard/essex-sports.png";
import essex_food from "/img/Dashboard/essex_food3.png";
import su from "/img/Dashboard/su2.png";
import moodle from "/img/Dashboard/moodle.png";
import societies from "/img/Dashboard/societies.png";
import followerslogo from "/img/Dashboard/followerslogo.png";
import followinglogo from "/img/Dashboard/followinglogo.png";
import societieslogo from "/img/Dashboard/societieslogo.png";
import degree from "/img/Dashboard/degree.png";
import leap from "/img/Dashboard/leap.jpeg";
import faser from "/img/Dashboard/faser2.png";
import shutdown from "/img/Dashboard/shutdown.png";
import listen_again from "/img/Dashboard/listen_again.png";
import post from "/img/Posts/post.png";
import party from "/img/Posts/party.png";
import event from "/img/Posts/event.png";
import explore from "/img/Tab/explore.png";
import logout from "/img/Tab/logout.png";
import eventlogo from "/img/Tab/eventlogo.png";
import Party from "@/Pages/Party/Party";
import Event from "@/Pages/Event/Event";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import moment from 'moment';
// import VueWeather from "vue-weather-widget";

export default {
    name: 'Dashboard',
    props: {
        parties: Array,
        events: Array,
        // events: Array,
        // partyInvites: Array,
        // eventInvites: Array,

    },
    data() {
        return {
            plus: plus,
            search: search,
            logout: logout,
            essex_sport: essex_sport,
            essex_food: essex_food,
            su: su,
            societies: societies,
            moodle: moodle,
            leap: leap,
            faser: faser,
            listen_again: listen_again,
            shutdown: shutdown,
            post: post,
            party: party,
            event: event,
            explore: explore,
            partylogo: partylogo,
            eventlogo: eventlogo,
            followerslogo: followerslogo,
            followinglogo: followinglogo,
            societieslogo: societieslogo,
            degree: degree,
        };
    },


    methods: {
        // currentDate() {
        //     const current = new Date();
        //     const date = `${current.getDate()}.${current.getMonth() + 1}`;
        //     return date;
        // },
        //
        signout() {
            this.$inertia.post(route('logout'));
        },

       formatDate() {
            const date = new Date();

            if (date) {
                return moment(String(date)).format('d MMM')
            }
        }
    },
    components: {
        BreezeAuthenticatedLayout,
        Head,
        InertiaLink,
        Party,
        Event,
    },

}
</script>

<style scoped>
.feed {
    background-image: linear-gradient(to right, #871714, #d4403d);
}

.weather {
    background-image: linear-gradient(to right, #1bad0a, #71f562);
}

.calendar {
    background-image: linear-gradient(to right, #b55b00, #ed9134);
}


.hide-scroll-bar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.hide-scroll-bar::-webkit-scrollbar {
    display: none;
}


</style>
