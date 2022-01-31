<template>
    <BreezeAuthenticatedLayout>
        <div class="mx-2 sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">

        <div class="mt-5 max-2 overflow-hidden rounded-xl font-bold">
            <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                <!--                        DASHBOARD-->
                Explore Users
            </h1>
        </div>
        <div v-for="user in users" :key="users" >
            {{user.username}}
            {{ user.email }}
        </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';

export default {
    name: "Index",
    components: {
        BreezeAuthenticatedLayout,
    },
    props: {
        users: Array,
    }
}
</script>

<style scoped>

</style>
