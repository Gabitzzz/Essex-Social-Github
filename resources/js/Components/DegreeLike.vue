<template>
    <div>
        <div>
            <inertia-link
                preserve-scroll
                method="POST"
                as="button"
                :href="route('degree.likes.toggle', [post, degree])"
                class="h-6 w-6 rounded-full bg-green-500 hover:bg-green-500 text-white">
            </inertia-link>
        </div>


        <!--        <div v-for="like in post.likes">-->
        <!--            <div v-if="like.id === $page.props.auth.user.id">-->

        <!--            </div>-->

        <!--        </div>-->
    </div>
</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
    name: "Degree Like",
    props: {
        post: Object,
        degree: Object,
        likes: Array,

    },
    components: {
        InertiaLink,
    },

}
</script>

<style scoped>

</style>
