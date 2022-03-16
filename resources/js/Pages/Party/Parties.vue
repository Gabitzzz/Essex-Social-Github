<template>
    <BreezeAuthenticatedLayout>
            <div class="my-4 mx-auto sm:mx-24 md:mx-30 lg:mx-72 xl:mx-60 2xl:mx-80">

            <div class="mt-5 mx-2 max-2 overflow-hidden rounded-xl font-bold">
                <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                    <!--                        DASHBOARD-->
                    Parties
                </h1>
            </div>

            <p class="text-sm mx-2 px-2 mb-5 " style="font-family: 'Poppins', sans-serif; font-weight: 100;">
                <i>
                    Explore Public Parties
                    <br>
                </i>
            </p>

            <div>
                <div v-for="(party, key) in parties" :key="key">
                    <Party :party="party" :invites="party.invites" :username="party.user.username"  ></Party>
                </div>
            </div>
        </div>

        </BreezeAuthenticatedLayout>

</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Party from "@/Pages/Party/Party";

export default {
    name: "Parties",
    components:{
        BreezeAuthenticatedLayout,
        Party
    },
    props: {
        parties: Array,
        users: Array,
        invites: Array,
    },

}
</script>

<style scoped>

</style>
