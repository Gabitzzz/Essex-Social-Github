<template>
    <Head title="Dashboard"/>

    <BreezeAuthenticatedLayout>
        <div class="py-2 mx-2 mb-20">
            <div class="mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                <div class="mt-5 max-2 overflow-hidden rounded-xl font-bold">
                    <h1 class="text-4xl px-2 py-2" style="font-family: 'Montserrat', sans-serif;">
                        <!--                        DASHBOARD-->
                        Welcome, {{ $page.props.auth.user.username }}
                    </h1>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap overflow-hidden max-w-7xl mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                <div class="w-1/2 overflow-hidden sm:w-1/3 xl:w-6/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 weather overflow-hidden rounded-xl shadow-lg">
                        <h1 class="text-3xl text-white px-4 py-4 ">
                            <!--                        DASHBOARD-->
                            Colchester <br>
                            17°
                        </h1>
                    </div>
                </div>

                <div class="w-1/2 sm:w-1/3 overflow-hidden md:w-6/12">
                    <!-- Column Content -->
                    <div class=" mx-1 max-2 calendar overflow-hidden shadow-lg rounded-xl shadow-md">
                        <h2 class="text-3xl text-white px-6 pt-4">Today</h2>
                        <h1 class="text-3xl text-white px-6 pb-4 ">{{ currentDate() }}</h1>
                    </div>
                </div>

            </div>

            <!--                <div class="sm:w-1/3 md:w-3/12 mt-5 sm:mt-0 rounded flex flex-wrap overflow-hidden ">-->
            <!--                    <div class="w-1/6 sm:w-1/3 md:w-1/3 2xl:w-1/6 ">-->
            <!--                        &lt;!&ndash; Column Content &ndash;&gt;-->
            <!--                        <div-->
            <!--                            class=" flex-wrap content-center mx-1 my-1 md:mx-0 md:my-0 bg-gray-100 border-2 border-gray-200 border-opacity-25  overflow-hidden shadow-sm rounded-xl">-->
            <!--                            <button class=" p-2 "-->
            <!--                                    style="border-radius: 15px; color: white;">-->
            <!--                                <img :src="plus" class="inline-block" alt="plus">-->
            <!--                            </button>-->
            <!--                        </div>-->
            <!--                    </div>-->

            <!--                    <div class="w-1/6 sm:w-1/3 overflow-hidden md:w-1/3 2xl:w-1/6">-->
            <!--                        &lt;!&ndash; Column Content &ndash;&gt;-->
            <!--                        <div-->
            <!--                            class="flex-wrap content-center mx-1 my-1 max-2  overflow-hidden shadow-sm rounded-xl ">-->
            <!--                            <button class=" p-2 bg-gray-100 bg-border-200"-->
            <!--                                    style="border-radius: 15px;">-->
            <!--                                <img :src="search" class="inline-block" alt="search">-->
            <!--                            </button>-->
            <!--                        </div>-->
            <!--                    </div>-->

            <!--                    <div class="w-1/6 sm:w-1/3 overflow-hidden md:w-1/3 2xl:w-1/6">-->
            <!--                        &lt;!&ndash; Column Content &ndash;&gt;-->
            <!--                        <div-->
            <!--                            class="flex-wrap content-center mx-1 my-1 max-2 overflow-hidden shadow-sm rounded-xl ">-->
            <!--                            <button class=" p-2"-->
            <!--                                    style="border-radius: 15px;">-->
            <!--                                <img :src="search" class="inline-block" alt="search">-->
            <!--                            </button>-->
            <!--                        </div>-->
            <!--                    </div>-->

            <!--                    <div class="w-1/6 sm:w-1/3 overflow-hidden md:w-1/3 2xl:w-1/6">-->
            <!--                        &lt;!&ndash; Column Content &ndash;&gt;-->
            <!--                        <div-->
            <!--                            class="flex-wrap content-center mx-1 my-1 max-2  overflow-hidden shadow-sm rounded-xl ">-->
            <!--                            <button class=" p-2"-->
            <!--                                    style="border-radius: 15px; color: white;">-->
            <!--                                <img :src="search" class="inline-block" alt="search">-->
            <!--                            </button>-->
            <!--                        </div>-->
            <!--                    </div>-->

            <!--                    <div class="w-1/6 sm:w-1/3 overflow-hidden md:w-1/3 2xl:w-1/6">-->
            <!--                        &lt;!&ndash; Column Content &ndash;&gt;-->
            <!--                        <div-->
            <!--                            class="flex-wrap content-center mx-1 my-1 max-2  overflow-hidden shadow-sm rounded-xl ">-->
            <!--                            <button class="p-2"-->
            <!--                                    style="border-radius: 15px; color: white;">-->
            <!--                                <img :src="search" class="inline-block" alt="search">-->
            <!--                            </button>-->
            <!--                        </div>-->
            <!--                    </div>-->

            <!--                    <div class=" w-1/6 sm:w-1/3 lg:mt-0 overflow-hidden md:w-1/3 2xl:w-1/6">-->
            <!--                        &lt;!&ndash; Column Content &ndash;&gt;-->
            <!--                        <div-->
            <!--                            class="flex-wrap content-center mx-1 my-1 max-2 logout overflow-hidden shadow-sm rounded-xl ">-->
            <!--                            &lt;!&ndash;                            <button class="p-2"&ndash;&gt;-->
            <!--                            &lt;!&ndash;                                    :href="route('logout')"&ndash;&gt;-->
            <!--                            &lt;!&ndash;                                    style="border-radius: 15px; ">&ndash;&gt;-->
            <!--                            &lt;!&ndash;                                <img :src="logout" class="inline-block" alt="logout">&ndash;&gt;-->
            <!--                            &lt;!&ndash;                            </button>&ndash;&gt;-->

            <!--                            <inertia-link class="py-2" style="border-radius: 15px;" :href="route('logout')"-->
            <!--                                          method="delete" as="button">-->
            <!--                                <img :src="logout" class="inline-block" style="width: 80%;" alt="logout">-->
            <!--                            </inertia-link>-->

            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->


            <!--                4 A ROW     -->
            <div class="mt-5 flex flex-wrap overflow-hidden max-w-7xl mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">

                <div class="w-1/4 overflow-hidden sm:w-1/3 xl:w-3/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 overflow-hidden rounded-xl bg-gray-200 border border-gray-300">
                        <img :src="essex_sport" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                    </div>
                </div>

                <div class="w-1/4 overflow-hidden sm:w-1/3 xl:w-3/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 bg-gray-200 overflow-hidden rounded-xl border border-gray-300 ">
                        <img :src="essex_food" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                    </div>
                </div>

                <div class="w-1/4 overflow-hidden sm:w-1/3 xl:w-3/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 bg-gray-200 overflow-hidden  rounded-xl border border-gray-300">
                        <img :src="su" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                    </div>
                </div>

                <div class="w-1/4 overflow-hidden sm:w-1/3 xl:w-3/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 bg-gray-200 overflow-hidden rounded-xl border border-gray-300  ">

                        <img :src="societies" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">

                    </div>
                </div>
            </div>


<!--            6 A ROW -->
            <div class=" flex flex-wrap overflow-hidden max-w-7xl mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">

                <div class="mt-5 w-1/3 overflow-hidden sm:w-1/3 xl:w-2/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 overflow-hidden rounded-xl bg-gray-200 border border-gray-300">
                        <img :src="moodle" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                    </div>
                </div>

                <div class="mt-5 w-1/3 overflow-hidden sm:w-1/3 xl:w-2/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 bg-gray-200 overflow-hidden rounded-xl border border-gray-300 ">
                        <img :src="leap" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                    </div>
                </div>

                <div class="mt-5 w-1/3 overflow-hidden sm:w-1/3 xl:w-2/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 bg-gray-200 overflow-hidden  rounded-xl border border-gray-300">
                        <img :src="faser" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">
                    </div>
                </div>

                <div class="mt-5 w-1/3 overflow-hidden sm:w-1/3 xl:w-2/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 bg-gray-200 overflow-hidden rounded-xl border border-gray-300  ">

                        <img :src="listen_again" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">


                    </div>
                </div>

                <div class="mt-5 w-1/3 overflow-hidden sm:w-1/3 xl:w-2/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 bg-gray-200 overflow-hidden rounded-xl border border-gray-300  ">

<!--                        <img :src="societies" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">-->
                        <img src="https://img.icons8.com/color/480/000000/compass--v2.png"/>
                    </div>
                </div>

                <div class="mt-5 w-1/6 overflow-hidden sm:w-1/3 xl:w-2/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 bg-gray-200 overflow-hidden rounded-xl border border-gray-300  ">

                        <img :src="shutdown" class="inline-block px-2 py-2 lg:px-4 lg:py-4" alt="plus">

                    </div>
                </div>
            </div>

            <div class="mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                <div class="mt-10 max-2 overflow-hidden rounded-xl font-bold">
                    <h1 class="text-4xl px-2 py-2" style="font-family: 'Montserrat', sans-serif;">
                        <!--                        DASHBOARD-->
                       Activity
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
import logout from "/images/logout.png";
import essex_sport from "/img/Dashboard/essex-sports.png";
import essex_food from "/img/Dashboard/essex_food.png";
import su from "/img/Dashboard/su2.png";
import moodle from "/img/Dashboard/moodle.png";
import societies from "/img/Dashboard/societies.png";
import leap from "/img/Dashboard/leap.jpeg";
import faser from "/img/Dashboard/faser2.png";
import shutdown from "/img/Dashboard/shutdown.png";
import listen_again from "/img/Dashboard/listen_again.png";

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
        };
    },
    methods: {
        currentDate() {
            const current = new Date();
            const date = `${current.getDate()}.${current.getMonth() + 1}`;
            return date;
        }
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
</style>
