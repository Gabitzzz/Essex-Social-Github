<template>
    <BreezeAuthenticatedLayout>

        <div>

            <div class="py-2 mx-2 mb-20">
                <div class=" mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">

                    <div class="mt-5 px-2 max-2 overflow-hidden rounded-xl font-bold">
                        <h1 class="text-4xl pb-2  " style="font-family: 'Poppins', sans-serif;">
                            Search
                        </h1>
                    </div>


                    <h1 class="mx-2 mb-2">
                        Search here for your Essex friends.
                    </h1>

                    <input type="search" v-model="params.search" aria-label="Search" placeholder="  Search..."
                           class="w-full mb-2 rounded-2xl border-gray-200 text-gray-600 shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-200 focus:ring-opacity-50"
                           autofocus>


                    <table class="w-full divide-y divide-gray-200  ">
                        <thead class="">

                        </thead>

                        <tbody class="bg-gray-100  divide-gray-200">
                        <tr v-for="(user, index) in users.data" :key="user.id">
                            <td class=" text-sm text-gray-500 ">
                                <!--                                <img-->
                                <!--                                    :src="showImage() + user.avatar"-->
                                <!--                                    class="avatar rounded-full avatar w-10 h-10 ml-2 my-2"-->
                                <!--                                    alt="avatar"-->
                                <!--                                />-->

                                <div v-if="user.avatar === null">
                                    <img
                                        :src="defaultProfile"
                                        class="avatar  avatar w-10 h-10 ml-2 my-2"
                                        alt="default"
                                    />
                                </div>

                                <div v-else>
                                    <img
                                        :src="showImage() + user.avatar"
                                        class="avatar rounded-full avatar w-10 h-10 ml-2 my-2"
                                        alt="avatar"
                                    />
                                </div>
                            </td>

                            <td class=" text-sm text-gray-500 ">
                                <a class="text-sm font-semibold text-gray-900 px-2 py-4"
                                   :href="route('profile', user.username)">
                                    {{ user.username }}
                                </a>
                            </td>

                            <td class=" text-sm text-gray-500 ">
                                <a class="text-sm font-semibold text-gray-500 px-8 py-4"
                                   :href="route('profile', user.username)">
                                    {{ user.name }}
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <Tab></Tab>
        </div>
    </BreezeAuthenticatedLayout>

</template>

<script>
import Tab from "@/Components/Tab";
import Nav from "@/Components/Nav";
import {pickBy, throttle} from "lodash";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import defaultProfile from "/img/Posts/defaultProfile.png";


export default {
    name: "Index",
    data() {
        return {
            params: {
                search: this.filters.search,
                field: this.filters.field,
                direction: this.filters.direction,
            },
            defaultProfile: defaultProfile,
        };
    },
    components: {
        Tab,
        Nav,
        BreezeAuthenticatedLayout,
    },
    props: {
        users: Object,
        filters: Object,
    },
    methods: {
        sort(field) {
            this.params.field = field;
            this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
        },
        showImage() {
            return "/storage/";
        },
    },
    watch: {
        params: {
            handler: throttle(function () {
                let params = pickBy(this.params);

                this.$inertia.get(this.route('search'), params, {replace: true, preserveState: true});
            }, 150),
            deep: true,
        },
    },
}
</script>

<style scoped>

</style>
