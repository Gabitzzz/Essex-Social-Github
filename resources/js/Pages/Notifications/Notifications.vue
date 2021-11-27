<template>
    <div>
        <NotificationItem v-for="unread in unreads"
                          :key="unread.id"
                          :unread="unread"
                          class="flex justify-between items-center text-gray-700 hover:bg-gray-700 hover:text-gray-300 px-4 py-2 transition duration-150 ease-in-out">

        </NotificationItem>

        <NotificationItem v-for="read in reads"
                          :key="read.id"
                          :read="read"
                          class="flex justify-between items-center text-gray-700 hover:bg-gray-700 hover:text-gray-300 px-4 py-2 transition duration-150 ease-in-out">
        </NotificationItem>
    </div>
</template>

<script>
import NotificationItem from "@/Pages/Notifications/NotificationItem";
export default {
    name: "Notifications",
    components:{
        NotificationItem,
    },
    props: ['unreads', 'reads']
}
</script>

<style scoped>

</style>
