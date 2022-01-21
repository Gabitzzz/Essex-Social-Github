<template>
    <div class="bg-gray-100">
        <Nav></Nav>

        <div class=" ">
            <!-- Page Heading -->
            <header class=" shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"/>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot/>
            </main>
        </div>
    </div>
    <div class="sm:hidden md:block">
        <Tab></Tab>
    </div>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import Nav from "@/Components/Nav";
import {Link} from '@inertiajs/inertia-vue3';
import Tab from "@/Components/Tab";
import { Head } from '@inertiajs/inertia-vue3'

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Nav,
        Link,
        Tab,
    },

    data() {
        return {
            showingNavigationDropdown: false,
            unreadNotifications: this.$page.props.auth.unreadNotifications,
            readNotifications: this.$page.props.auth.readNotifications,
            notifications: this.$page.props.auth.notifications,
        }
    },
}
</script>


