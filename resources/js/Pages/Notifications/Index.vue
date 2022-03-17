<template>
    <div>
        <BreezeAuthenticatedLayout>
            <Head title="Notifications"/>


            <div class="mx-2 mt-5 max-2 overflow-hidden rounded-xl font-bold">
                <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                    Notifications
                </h1>
            </div>


            <div class="py-2 mx-2 mb-20">
                <div class="mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                    <div class="mt-4" v-if="unreadNotifications.length > 0">
                        You have
                        <span class="bg-red-600 text-white rounded-full px-4 py-2">
                                    {{ unreadNotifications.length }}
                                </span>
                        unread notifications
                    </div>


                    <div v-if="unreadNotifications.length > 0">
                        <inertia-link :href="route('notifications.update')"
                                      class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-300 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                            Mark all as read
                        </inertia-link>
                        <div class="border-t border-gray-100"></div>
                    </div>

                    <div v-else>
                        <div class="block text-center px-4 py-2 text-xs text-gray-400">
                            You have no new notifications
                        </div>
                    </div>

                    <Notifications :unreads="unreadNotifications" :reads="readNotifications"></Notifications>

                </div>

            </div>
        </BreezeAuthenticatedLayout>
    </div>v
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {InertiaLink} from "@inertiajs/inertia-vue3";
import Notifications from "@/Pages/Notifications/Notifications";
import {Head} from '@inertiajs/inertia-vue3';


export default {
    name: "Index",
    components: {
        BreezeAuthenticatedLayout,
        InertiaLink,
        Notifications,
        Head,
    },

    data() {
        return {
            showingNavigationDropdown: false,
            unreadNotifications: this.$page.props.auth.unreadNotifications,
            readNotifications: this.$page.props.auth.readNotifications,
            notifications: this.$page.props.auth.notifications,
        }
    },
    props: ['reads', 'unreads'],
}
</script>

<style scoped>

</style>
