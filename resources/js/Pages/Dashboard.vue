<template>
    <Head title="Dashboard"/>

    <BreezeAuthenticatedLayout>
        <div class="py-2 mx-2 mb-20">
            <div class="mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                <div class="mt-5 max-2 feed overflow-hidden rounded-xl shadow-xl">
                    <h1 class="text-3xl text-white px-6 py-4 ">
                        <!--                        DASHBOARD-->
                        Welcome, {{ $page.props.auth.user.username }}
                    </h1>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap overflow-hidden max-w-7xl mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                <div class="w-1/2 overflow-hidden sm:w-1/3 xl:w-4/12">
                    <!-- Column Content -->
                    <div class="mx-1 max-2 weather overflow-hidden rounded-xl shadow-lg">
                        <h1 class="text-3xl text-white px-4 py-4 ">
                            <!--                        DASHBOARD-->
                            Colchester <br>
                            17°
                        </h1>
                    </div>
                </div>

                <div class="w-1/2 sm:w-1/3 overflow-hidden md:w-5/12">
                    <!-- Column Content -->
                    <div class=" mx-1 max-2 calendar overflow-hidden shadow-lg rounded-xl shadow-md">
                        <h2 class="text-3xl text-white px-6 pt-4">Today</h2>
                        <h1 class="text-3xl text-white px-6 pb-4 ">{{ currentDate() }}</h1>
                    </div>
                </div>

                <div class="sm:w-1/3 md:w-3/12 mt-5 sm:mt-0 rounded flex flex-wrap overflow-hidden ">
                    <div class="w-1/6 sm:w-1/3 md:w-1/3 2xl:w-1/6 overflow-hidden">
                        <!-- Column Content -->
                        <div
                            class=" flex-wrap content-center mx-1 my-1 md:mx-0 md:my-0 bg-gray-100 border-2 border-gray-200 border-opacity-25  overflow-hidden shadow-sm rounded-xl">
                            <button class=" p-2 "
                                    style="border-radius: 15px; color: white;">
                                <img :src="plus" class="inline-block" alt="plus">
                            </button>
                        </div>
                    </div>

                    <div class="w-1/6 sm:w-1/3 md:w-1/3 2xl:w-1/6 overflow-hidden  ">
                        <!-- Column Content -->
                        <div
                            class="flex-wrap content-center mx-1 my-1  max-2 bg-gray-100 border-2 border-gray-200 border-opacity-25 overflow-hidden shadow-sm rounded-xl ">
                            <button class=" p-2"
                                    style="border-radius: 15px; color: white;">
                                <img :src="search" class="inline-block" alt="search">
                            </button>
                        </div>
                    </div>

                    <div class="w-1/6 sm:w-1/3 overflow-hidden md:w-1/3 2xl:w-1/6">
                        <!-- Column Content -->
                        <div
                            class="flex-wrap content-center mx-1 my-1 max-2 calendar overflow-hidden shadow-sm rounded-xl ">
                            <button class=" p-2"
                                    style="border-radius: 15px; color: white;">
                                <img :src="search" class="inline-block" alt="search">
                            </button>
                        </div>
                    </div>

                    <div class="w-1/6 sm:w-1/3 overflow-hidden md:w-1/3 2xl:w-1/6">
                        <!-- Column Content -->
                        <div
                            class="flex-wrap content-center mx-1 my-1 max-2 calendar overflow-hidden shadow-sm rounded-xl ">
                            <button class=" p-2"
                                    style="border-radius: 15px; color: white;">
                                <img :src="search" class="inline-block" alt="search">
                            </button>
                        </div>
                    </div>

                    <div class="w-1/6 sm:w-1/3 overflow-hidden md:w-1/3 2xl:w-1/6">
                        <!-- Column Content -->
                        <div
                            class="flex-wrap content-center mx-1 my-1 max-2 calendar overflow-hidden shadow-sm rounded-xl ">
                            <button class=" p-2"
                                    style="border-radius: 15px; color: white;">
                                <img :src="search" class="inline-block" alt="search">
                            </button>
                        </div>
                    </div>

                    <div class=" w-1/6 sm:w-1/3 lg:mt-0 overflow-hidden md:w-1/3 2xl:w-1/6">
                        <!-- Column Content -->
                        <div
                            class="flex-wrap content-center mx-1 my-1 max-2 logout overflow-hidden shadow-sm rounded-xl ">
                            <button class="p-2"
                                    style="border-radius: 15px; ">
                                <img :src="logout" class="inline-block" alt="logout">
                            </button>
                        </div>
                    </div>

            </div>
        </div>

        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {Head} from '@inertiajs/inertia-vue3'
import plus from "/img/Tab/plus.png"
import search from "/img/Tab/search.png"
import logout from "/images/logout.png"

export default {
    name: 'Dashboard',
    data() {
        return {
            plus: plus,
            search: search,
            logout: logout,

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

@media only screen and (min-width: 640px) {
    /*.calendar {*/
    /*    max-height: 50px ;*/
    /*}*/

}

.calendar {
    background-image: linear-gradient(to right, #b55b00, #ed9134);
}

.logout {

    background-image: linear-gradient(to right, #871714, #d4403d);

}
</style>
