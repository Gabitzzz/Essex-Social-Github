<template>
    <div>
        <BreezeAuthenticatedLayout>

            <div>
                <p class="text-xl mt-4">
                    You have <span
                    class="bg-red-600 text-white rounded-full px-4 py-2 ">{{ unreadNotifications.length }}</span> unread
                    notifications
                </p>

                <div v-if="notifications.length > 0">
                    <inertia-link :href="route('notifications.update')"
                                  class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-300 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                        Mark all as read
                    </inertia-link>

                    <div class="border-t border-gray-100"></div>


                </div>

                <div v-else>
                    <div class="block text-center px-4 py-2 text-xs text-gray-400">
                        You have 0 notifications
                    </div>
                </div>
            </div>

            <Notifications :unreads="unreadNotifications" :reads="readNotifications"></Notifications>
        </BreezeAuthenticatedLayout>
    </div>

</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {InertiaLink} from "@inertiajs/inertia-vue3";
import Notifications from "@/Pages/Notifications/Notifications";


export default {
    name: "Index",
    components: {
        BreezeAuthenticatedLayout,
        InertiaLink,
        Notifications,
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
