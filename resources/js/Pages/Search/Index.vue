<template>
    <BreezeAuthenticatedLayout>
        <Head title="Search"/>

        <div>
            <div class="py-2 mx-2 mb-20">
                <div class="pb-1 mx-auto sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">
                    <div class="mt-5 px-2 max-2 overflow-hidden rounded-xl font-bold">
                        <h1 class="text-4xl pb-2  " style="font-family: 'Poppins', sans-serif;">
                            Search
                        </h1>
                    </div>

                    <h1 class="mx-2 mb-2">
                        Search here for your Poli friends.
                    </h1>

                    <input type="search" v-model="params.search"
                           aria-label="Search"
                           placeholder="  Search..."
                           class="w-full mb-2 rounded-2xl border-gray-200 text-gray-600 shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-200 focus:ring-opacity-50"
                           autofocus>

                    <table class="w-full divide-y divide-gray-200">
                        <tbody class="bg-gray-100 divide-y divide-gray-200 ">
                        <tr v-for="(user, index) in users.data" :key="user.id" class="">
                            <td>
                               <div class="flex">
                                   <a
                                       :href="route('profile', user.username)">
                                       <img v-if="user.avatar === null"
                                            :src="defaultProfile"
                                            class="avatar  avatar w-10 h-10 ml-2 my-2"
                                            alt="default"
                                       />

                                       <img v-else
                                            :src="showImage() + user.avatar"
                                            class="avatar rounded-full avatar w-10 h-10 ml-2 my-2"
                                            alt="avatar"
                                       />
                                   </a>

                                   <a class="ml-4 text-sm font-semibold text-gray-900 px-2 py-4"
                                      :href="route('profile', user.username)">
                                       {{ user.username }}
                                   </a>
                               </div>
                            </td>



                            <td class=" text-sm text-gray-500 text-right">
                                <a
                                    class="follow button shadow-2xl  items-center px-3"
                                    :href="('/chatify/' + user.id )" >
                                    <img :src="chat" width="15" height="15" class="absolute z-10  " alt="search">
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
import {Head} from '@inertiajs/inertia-vue3';
import chat from "/img/Chat/chat-img.png";


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
            chat: chat,
        };
    },
    components: {
        Tab,
        Nav,
        BreezeAuthenticatedLayout,
        Head,
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
