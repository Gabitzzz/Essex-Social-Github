<template>
    <div>
        <inertia-link
            preserve-scroll
            method="POST"
            as="button"
            :href="route('likes.toggle', post.id)"
            class="h-6 w-6 rounded-full bg-green-500 hover:bg-green-700 text-white">
        </inertia-link>
    </div>
</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
    name: "Like",
    props: {
        post: Object,
        likes: Array,

    },
    components: {
        InertiaLink,
    },


}
</script>

<style scoped>

</style>
