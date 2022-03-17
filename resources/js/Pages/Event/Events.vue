<template>
    <BreezeAuthenticatedLayout>
        <Head title="Events"/>

        <div class=" my-4 pb-20 mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
            <div class="mt-5 mx-2 max-2 overflow-hidden rounded-xl font-bold">
                <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                    <!--                        DASHBOARD-->
                    Event
                </h1>
            </div>

            <p class="text-sm mx-2 px-2 mb-5 " style="font-family: 'Poppins', sans-serif; font-weight: 100;">
                <i>
                    Explore Public Parties
                    <br>
                </i>
            </p>

            <div>
                <div v-for="(event, key) in events" :key="key">
                    <Event :event="event" ></Event>
                </div>
            </div>
        </div>

        </BreezeAuthenticatedLayout>

</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Event from "@/Pages/Event/Event";
import {Head} from '@inertiajs/inertia-vue3';

export default {
    name: "Events",
    components:{
        Event,
        BreezeAuthenticatedLayout,
        Head,

    },
    props: {
        events: Array,
        users: Array,
    },

}
</script>

<style scoped>

</style>
