<template>
    <nav class="bg-white border-b border-gray-100 sticky">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <img :src="image" class="w-20 h-20"/>

                    <!--                         Navigation Links-->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <BreezeNavLink :href="route('home')" :active="route().current('home')">
                            Home
                        </BreezeNavLink>
                        <BreezeNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </BreezeNavLink>
                        <BreezeNavLink :href="route('explore')" :active="route().current('explore')">
                            Explore
                        </BreezeNavLink>
                        <!--                        <BreezeNavLink :href="route('profile', $page.props.auth.user.username)" :active="route().current('profile')">-->
                        <!--                            {{ $page.props.auth.user.username }}-->
                        <!--                        </BreezeNavLink>-->
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <!-- Settings Dropdown -->
                    <div class="ml-3 relative">
                        <div class="hidden space-x-4 sm:-my-px sm:flex">
                            <inertia-link class="flex items-center group bg-gray-100 p-2 border-2 border-gray-200 border-opacity-25" :href="route('search')" style="border-radius: 15px;">
                                <img :src="search" width="25" height="25" class="inline-block" alt="search">
                            </inertia-link>

                            <inertia-link class="flex items-center group bg-gray-100 p-2 border-2 border-gray-200 border-opacity-25" :href="route('posts.create')" style="border-radius: 15px;">
                                <img :src="plus" width="25" height="25" class="inline-block" alt="search">
                            </inertia-link>

<!--                            <button class="bg-gray-100 p-2 border-2 border-gray-200 border-opacity-25"-->
<!--                                    style="border-radius: 15px;">-->
<!--                                <img :src="plus" width="25" height="25" class="inline-block" alt="plus">-->
<!--                            </button>-->

                            <BreezeNavLink :href="route('profile', $page.props.auth.user.username)"
                                           :active="route().current('profile')">
                                {{ $page.props.auth.user.username }}
                            </BreezeNavLink>
                        </div>
                    </div>
                </div>

                <!-- Hamburger -->
                <div class=" flex items-center sm:hidden">
                    <inertia-link class="flex items-center group bg-gray-100 p-2 border-2 border-gray-200 border-opacity-25" :href="route('search')" style="border-radius: 15px;">
                        <img :src="search" width="25" height="25" class="inline-block" alt="search">
                    </inertia-link>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}"
             class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <BreezeResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                    Dashboard
                </BreezeResponsiveNavLink>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <BreezeResponsiveNavLink :href="route('profile',  $page.props.auth.user.username )"
                                             :active="route().current('profile')">
                        {{ $page.props.auth.user.name }}
                    </BreezeResponsiveNavLink>

                    <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button">
                        Log Out
                    </BreezeResponsiveNavLink>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import image from "/img/logo/5.png"
import search from "/img/Tab/search.png"
import plus from "/img/Tab/plus.png"
import {InertiaLink} from "@inertiajs/inertia-vue3";


export default {
    props: ['profile'],

    name: "Nav",
    components: {
        BreezeResponsiveNavLink,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeApplicationLogo,
        BreezeNavLink,
        Link,
        InertiaLink,
    },
    data() {
        return {
            showingNavigationDropdown: false,
            image: image,
            search: search,
            plus: plus,
            users: Object,
        }
    },


}
</script>

<style scoped>
.sticky {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    z-index: 1020;
}

</style>
