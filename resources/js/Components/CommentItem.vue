<template>
    <div class="flex  mt-5  space-x-5">
        <div class="flex-1">
            <div class="flex items-center">



                <p class="bg-gray-100 rounded px-3 ">
                    <inertia-link :href="route('profile', comment.user.username)"><strong>{{
                            comment.user.username
                        }}__</strong>
                    </inertia-link>
                    {{ comment.body }}
                </p>
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
        showImage() {
            return "/storage/";
        },
    }
}
</script>

<style scoped>


</style>
