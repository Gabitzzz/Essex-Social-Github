<template>
    <Head title="Dashboard"/>

    <BreezeAuthenticatedLayout>
        <div class="mx-2 pb-32">
            <div class="mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                <div class="mt-5 max-2 overflow-hidden rounded-xl font-bold">
                    <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                        <!--                        DASHBOARD-->
                        Welcome {{ $page.props.auth.user.username }}

                    </h1>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap overflow-hidden max-w-7xl mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                <div class="w-1/2 overflow-hidden sm:w-1/Q xl:w-6/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 weather overflow-hidden rounded-xl shadow-lg">
                        <h1 class="text-3xl text-white px-4 py-4 ">
                            <!--                        DASHBOARD-->
                            Colchester <br>
                            17°
                        </h1>
                    </div>
                </div>

                <div class="w-1/2 sm:w-1/2 overflow-hidden md:w-6/12">
                    <!-- Column Content -->
                    <div class=" mx-1 max-2 calendar overflow-hidden shadow-lg rounded-xl shadow-md">
                        <h2 class="text-3xl text-white px-6 pt-4">Today</h2>
                        <h1 class="text-3xl text-white px-6 pb-4 ">{{ currentDate() }}</h1>
                    </div>
                </div>

            </div>



            <!--                4 A ROW     -->
            <div class="mt-5 flex flex-wrap overflow-hidden max-w-7xl mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">

                <div class="w-1/4 overflow-hidden xl:w-3/12">
                    <!-- Column Content -->
                    <div class="mx-1 mb-4 max-2 overflow-hidden rounded-xl bg-white shadow-md  ">
                        <img :src="essex_sport" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                    </div>
                </div>

                <div class="w-1/4 overflow-hidden  xl:w-3/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 bg-white overflow-hidden shadow-md rounded-xl shadow-md  ">
                        <img :src="essex_food" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                    </div>
                </div>

                <div class="w-1/4 overflow-hidden xl:w-3/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 bg-white overflow-hidden  rounded-xl shadow-md  ">
                        <img :src="su" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                    </div>
                </div>

                <div class="w-1/4 overflow-hidden xl:w-3/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 bg-white overflow-hidden rounded-xl shadow-md   ">

                        <img :src="societies" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">

                    </div>
                </div>
            </div>

            <div class="mt-5 mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                <div
                    id="scrollContainer"
                    class="flex flex-no-wrap overflow-x-scroll scrolling-touch items-start mb-10 hide-scroll-bar"
                >
                    <div class="inline-block px-2">
                        <div
                            class="w-32 h-32 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out"

                        >
                            <img :src="moodle" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-32 h-32 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out"
                        >
                            <img :src="leap" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-32 h-32 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out"
                        >
                            <img :src="faser" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-32 h-32 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out"
                        >
                            <img :src="listen_again" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-32 h-32 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out"
                        >
                            <img :src="listen_again" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                        </div>
                    </div>

                    <div class="inline-block px-2">
                        <div
                            class="w-32 h-32 max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out"
                        >
                            <img :src="listen_again" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                        </div>
                    </div>
                </div>

                <div class="mt-5 max-2 overflow-hidden rounded-xl font-bold">
                    <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                        <!--                        DASHBOARD-->
                        Activity
                    </h1>
                </div>
            </div>

            <!--            TABS        -->
            <div class="mx-2 sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96 ">

                <div class=" grid grid-cols-3 gap-4 content-center">
                    <div class="bg-white rounded-2xl hover:bg-gray-300">
                        <a :href="route('posts.create', $page.props.auth.user.username )"
                           class="w-full justify-center inline-block text-center pt-2 pb-1"
                        >
                            <img :src="post" width="40" height="40" class="inline-block" alt="plus">
                        </a>
                    </div>
                    <div class="bg-white rounded-2xl hover:bg-gray-300">
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

                    <div class="bg-white rounded-2xl hover:bg-gray-300">
                        <a :href="route('explore')"
                           class="w-full justify-center inline-block text-center pt-2 pb-1"
                        >
                            <img :src="explore" width="40" height="40" class="inline-block" alt="plus">
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl hover:bg-gray-300">
                        <InertiaLink :href="route('party.show')"
                           class="w-full justify-center inline-block text-center pt-2 pb-1"
                        >
                            <img :src="partylogo" width="40" height="40" class="inline-block" alt="plus">
                        </InertiaLink>
                    </div>



                    <div class="bg-white rounded-2xl hover:bg-gray-300">
                        <a :href="route('explore')"
                           class="w-full justify-center inline-block text-center pt-2 pb-1"
                        >
                            <img :src="eventlogo" width="40" height="40" class="inline-block" alt="plus">
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl hover:bg-gray-300">
                        <a :href="route('posts.create', $page.props.auth.user.username )"
                           class="w-full justify-center inline-block text-center pt-2 pb-1"
                        >
                            <img :src="party" width="40" height="40" class="inline-block" alt="plus">
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl hover:bg-gray-300">
                        <form @submit.prevent="signout()">
                            <button as="button"
                                    type="submit" class="w-full justify-center inline-block text-center pt-2 pb-1">
                                <img :src="explore" width="40" height="40" class="inline-block" alt="plus">
                            </button>
                        </form>
                    </div>

                    <div class="bg-white rounded-2xl hover:bg-gray-300">
                        <form @submit.prevent="signout()">
                            <button as="button"
                                    type="submit" class="w-full justify-center inline-block text-center pt-2 pb-1">
                                <img :src="logout" width="40" height="40" class="inline-block" alt="plus">
                            </button>
                        </form>
                    </div>
                </div>


                <div class="mt-10 max-2 overflow-hidden rounded-xl font-bold">
                    <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                        <!--                        DASHBOARD-->
                        Events
                    </h1>
                </div>


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
import essex_food from "/img/Dashboard/essex_food.png";
import su from "/img/Dashboard/su2.png";
import moodle from "/img/Dashboard/moodle.png";
import societies from "/img/Dashboard/societies.png";
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

import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
    name: 'Dashboard',
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
        };
    },
    methods: {
        currentDate() {
            const current = new Date();
            const date = `${current.getDate()}.${current.getMonth() + 1}`;
            return date;
        },
        //
        signout() {
            this.$inertia.post(route('logout'));
        },
    },
    components: {
        BreezeAuthenticatedLayout,
        Head,
        InertiaLink,
    },
    props: ['user', 'profile'],
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

.logout {
    background-image: linear-gradient(to right, #871714, #d4403d);
}

.hide-scroll-bar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.hide-scroll-bar::-webkit-scrollbar {
    display: none;
}


</style>
