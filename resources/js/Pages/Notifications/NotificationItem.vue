<template>
    <div>
        <template v-if="unread">
            <inertia-link class="flex leading-5" @click="markOneAsRead(unread.id)">
                <div class="flex flex-col items-start text-left font-bold">
                    {{
                        unread.data.info.message
                    }}
                </div>
            </inertia-link>
        </template>

        <template v-if="read">
            <inertia-link class="flex leading-5">
                <div class="flex flex-col items-start text-left">
                    {{
                        read.data.info.message
                    }}
                </div>
            </inertia-link>
        </template>
    </div>
</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
    name: "NotificationItem",
    props: ['unread', 'read'],
    methods:{
        markOneAsRead(id) {
            axios.post(this.route('notifications.store', id))
        },
    },
    components:{
        InertiaLink,
    }
}
</script>

<style scoped>

</style>
