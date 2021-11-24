<template>
    <div class="flex  mt-5 py-5 space-x-5">


        <div class="flex-1">
            <div>
                <h2 class="text-lg font-semibold underline">
                    <inertia-link :href="route('profile', comment.user.username)">{{ comment.user.username }} said:
                    </inertia-link>
                </h2>

            </div>


            <div class="flex items-end">

                <img :src="avatar" class="rounded-full avatar w-10 h-10 mt-1" alt="avatar">

                <p class="bg-gray-100 rounded px-3 py-2">
                    {{ comment.body }}
                </p>

            </div>
        </div>
    </div>
</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3";
import avatar from "/img/background/human.jpg";


export default {
    props: ['comment', 'post'],
    components: {
        InertiaLink,
    },
    data() {
        return {
            avatar: avatar,
        }
    },
    methods: {}
}
</script>

<style scoped>


</style>
