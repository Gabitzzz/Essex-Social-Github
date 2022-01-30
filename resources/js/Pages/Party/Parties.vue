<template>
            <div v-for="(party, key) in parties" :key="key">
                <Party :party="party" ></Party>
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
