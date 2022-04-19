<template>
    <BreezeAuthenticatedLayout>
        <Head title="Events"/>
        <div class="my-4 mx-auto sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">
            <div class="flex justify-between items-center mt-5 mx-2 max-2 overflow-hidden rounded-xl font-bold">
                <div>
                    <h1 class="text-4xl px-2 " style="font-family: 'Poppins', sans-serif;">
                        <!--                        DASHBOARD-->
                        Events
                    </h1>

                    <p class="text-sm mx-2">
                        Explore all the Events and join the ones find them interesting!

                        <br>
                    </p>
                </div>

                <div class="w-16 h-16 mx-6">
                    <InertiaLink :href="route('event.create')"
                    >
                        <img :src="event" alt="plus">
                        <span
                            class="absolute rounded-full bg-red-600 ml-6 text-xs px-2 py-1 text-white top-24">NEW</span>
                    </InertiaLink>
                </div>
            </div>

            <div>
                <div v-for="(event, key) in events" :key="key" class="mt-8">
                    <Event :event="event"></Event>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>

</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Event from "@/Pages/Event/Event";
import {Head} from '@inertiajs/inertia-vue3';
import {InertiaLink} from "@inertiajs/inertia-vue3";
import event from "/img/Posts/event.png";


export default {
    name: "Events",
    data() {
        return {
            event: event,
        }

    },
    components: {
        Event,
        BreezeAuthenticatedLayout,
        Head,
        InertiaLink,

    },
    props: {
        events: Array,
        users: Array,
    },

}
</script>

<style scoped>

</style>
