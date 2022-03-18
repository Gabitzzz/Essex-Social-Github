<template>
    <BreezeAuthenticatedLayout>
        <Head title="Degree"/>



        <div class="mt-5 font-bold  overflow-hidden max-w-7xl ">
            <div class="flex justify-between items-center">
                <h1 class="text-4xl mx-2  py-2" style="font-family: 'Poppins', sans-serif;">
                    <span class="flex sm:inline">
                          {{ degree.title }}
                        </span>
                </h1>
            </div>
        </div>

        <div v-for="user in users">
            {{user.username}}
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import {Head} from '@inertiajs/inertia-vue3';

export default {
    name: "Index",
    props:{
        degree: Object,
        users: Array,
    },

    components:{
        BreezeAuthenticatedLayout,
        Head,
    }
}
</script>

<style scoped>

</style>
