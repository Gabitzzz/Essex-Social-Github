<template>
    <BreezeAuthenticatedLayout>
        <div class="mt-5 mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
            <div>
                <Parties :parties="parties"></Parties>

            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Parties from "@/Pages/Party/Parties";
export default {
    name: "Index",
    components:{
        BreezeAuthenticatedLayout,
        Parties
    },
    props: {
        parties: Array,
    }
}
</script>

<style scoped>

</style>
