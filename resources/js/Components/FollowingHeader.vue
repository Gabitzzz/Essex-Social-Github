<template>
    <div class="sticky top-0 flex flex-col bg-white border-b border-gray-200">
        <div class="p-4">
            <div class="text-xl font-semibold leading-tight text-gray-800">
                {{ $page.props.profile.user.name }}'s Stats
            </div>
        </div>

        <div class="flex">
            <Link :class="{'border-b-2 border-blue-500 text-blue-600': isRoute('followers')}"
                  :href="route('followers', $page.props.profile.user.username)"
                  class="w-1/2 py-2 font-bold text-center text-gray-700 hover:bg-blue-100 hover:text-blue-500">
                Followers
            </Link>

            <Link
                :class="{'border-b-2 border-blue-500 text-blue-600': isRoute('followings')}"
                :href="route('followings', $page.props.profile.user.username)"
                class="w-1/2 py-2 font-bold text-center text-gray-700 hover:bg-blue-100 hover:text-blue-500">
                Following
            </Link>
        </div>
    </div>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3';

export default {
    name: "FollowingHeader",
    props: {
        profile: Object,
    },
    components: {
        Link,
    },
    methods: {
        route: window.route,
        isRoute(...routes) {
            return routes.some(route => this.route().current(route))
        }
    }
}
</script>

<style scoped>

</style>
