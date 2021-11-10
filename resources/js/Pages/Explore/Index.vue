<template>
    <BreezeAuthenticatedLayout>
        <div v-for="user in users" :key="users" >
            {{user.username}}

            {{ user.email }}
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
