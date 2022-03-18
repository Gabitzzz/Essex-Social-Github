<template>
    <BreezeAuthenticatedLayout>
        <Head title="Societies"/>

        <div class="my-4 mx-auto sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">

            <div class="flex justify-between items-center mt-5 mx-2 max-2 overflow-hidden rounded-xl font-bold">
                <div>
                    <h1 class="text-4xl px-2 " style="font-family: 'Poppins', sans-serif;">
                        <!--                        DASHBOARD-->
                        Societies
                    </h1>

                    <p class="text-sm mx-2">
                        Explore Societies
                        <br>
                    </p>
                </div>

<!--                <div class="w-16 h-16">-->
<!--                    <InertiaLink :href="route('party.create')"-->
<!--                    >-->
<!--                        <img :src="party" alt="plus">-->
<!--                        <span-->
<!--                            class="absolute rounded-full bg-red-600 ml-6  text-xs px-2 py-1 text-white  top-24">NEW</span>-->
<!--                    </InertiaLink>-->
<!--                </div>-->
            </div>



            <div>
                <div v-for="(party, key) in parties" :key="key" class="mt-8">
                    <Party :party="party" :invites="party.invites" :username="party.user.username"></Party>
                </div>
            </div>
        </div>

    </BreezeAuthenticatedLayout>

</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';

export default {
    name: "Societies",
    components:{
        BreezeAuthenticatedLayout,
    }
}
</script>

<style scoped>

</style>
