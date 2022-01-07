<template>
    <div>
        <Nav></Nav>

        <div class="py-2 mx-2 mb-20">
            <div class=" mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                <input type="search" v-model="params.search" aria-label="Search" placeholder="  Search..."
                       class=" w-full rounded-2xl border-gray-300 text-gray-600 shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-200 focus:ring-opacity-50"
                       autofocus>

                <h1 class="mx-5 my-4">
                    Search here for your Essex friends.
                </h1>

                <table class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead class="">

                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="(user, index) in users.data" :key="user.id">
                        <td class="py-4 px-6 whitespace-nowrap mt-10">

                            <a class="text-sm font-semibold text-gray-900"
                               :href="route('profile', user.username)">
                                {{ user.username }}
                            </a>
                        </td>

                        <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap">
                            {{ user.name }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <Tab></Tab>
    </div>
</template>

<script>
import Tab from "@/Components/Tab";
import Nav from "@/Components/Nav";
import {pickBy, throttle} from "lodash";

export default {
    name: "Index",
    data() {
        return {
            params: {
                search: this.filters.search,
                field: this.filters.field,
                direction: this.filters.direction,
            },
        };
    },
    components: {
        Tab,
        Nav,
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
