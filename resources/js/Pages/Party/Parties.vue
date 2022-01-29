<template>
        <div class="mt-5 mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
            <div v-for="(party, key) in parties" :key="key">
                <Party :party="party" ></Party>
            </div>
        </div>
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
    }
}
</script>

<style scoped>

</style>
