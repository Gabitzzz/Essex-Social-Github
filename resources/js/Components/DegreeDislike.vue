<template>
    <div>
        <!--    <span>5</span>-->
        <inertia-link preserve-scroll
                      method="POST"
                      as="button"
                      :href="route('degree.dislikes.toggle', [post, degree])"
                      class="h-6 w-6 rounded-full bg-red-500 hover:bg-red-700">
        </inertia-link>
    </div>
</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
    name: "Degree Dislike",
    props: {
        method: Function,
        post: Object,
        degree: Object,
    },
    components:{
        InertiaLink,
    }
}
</script>

<style scoped>

</style>
