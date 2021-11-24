<template>
    <div class="flex border-t border-gray-400 mt-5 py-5 space-x-5">
<!--        <div class="flex-shrink-0">-->
<!--            <inertia-link :href="route('profile', comment.user.username)">-->
<!--                <img class="h-8 w-8 rounded-full object-cover" :src="comment.user.profile_photo_url" :alt="comment.user.username">-->
<!--            </inertia-link>-->
<!--        </div>-->

        <div class="flex-1">
            <div>
                <h2 class="text-lg font-semibold underline">
                    <inertia-link :href="route('profile', comment.user.username)">{{ comment.user.username }}</inertia-link>
                </h2>
                <p class="bg-gray-100 rounded mt-3 px-3 py-2">
                    {{ comment.body }}
                </p>
            </div>
            <div class="flex items-end my-3">

                <div class="flex ml-3">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
    props: ['comment', 'post'],
    components: {
        InertiaLink,
    },
    data() {
        return {

        }
    },
    methods: {

    }
}
</script>
