<template>
    <BreezeAuthenticatedLayout>
        <Head title="Explore"/>

        <div class="pb-1 mx-auto sm:mx-24 md:mx-30 lg:mx-72 xl:mx-60 2xl:mx-80">


                <div class="mt-5 max-2 overflow-hidden rounded-xl font-bold">
                <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                    Explore Users
                </h1>

                <p class="px-2  text-sm lg:text-md"
                   style="font-weight:lighter;">
                    See the list of all users
                </p>
            </div>

            <div class="py-8  dark:bg-gray-800 rounded-lg ">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div v-for="user in users" class="p-4" :key="users">
                        <inertia-link :href="route('profile', user.username)">
                            <div class="flex-col  flex justify-center items-center">
                                <div class="flex-shrink-0">
                                    <img v-if="user.avatar === null"
                                         :src="defaultProfile"
                                         class="avatar  avatar w-8 h-8   "
                                         alt="default"
                                    />
                                    <img v-else
                                         :src="showImage() + user.avatar"
                                         class="avatar rounded-full avatar w-8 h-8  "
                                    />
                                </div>

                                <div class="mt-2 text-center flex flex-col">
                                    <span class="text-gray-600 dark:text-white text-lg font-medium">
                                        {{ user.username }}
                                    </span>

                                    <span class="text-gray-400 text-xs">
                                        {{ user.email }}
                                    </span>
                                </div>
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
import defaultProfile from "/img/Posts/defaultProfile.png";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import {Head} from '@inertiajs/inertia-vue3';


export default {
    name: "Index",
    data() {
        return {
            defaultProfile: defaultProfile,
        }
    },
    components: {
        BreezeAuthenticatedLayout,
        InertiaLink,
        Head,
    },
    props: {
        users: Array,
    },
    methods: {
        showImage() {
            return "/storage/";
        },
    }
}
</script>

<style scoped>

</style>
