<template>
    <div>
        <!--    <span>5</span>-->
        <form @submit.prevent="method">
            <div class="flex">
                <button v-if="item.disliked === 0"
                        type="submit"
                        class="h-6 w-6 rounded-full bg-red-500 hover:bg-red-800">
                </button>
                <button v-else
                        type="submit"
                        class="h-6 w-6 rounded-full bg-red-800 text-white">
                    ✓
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "Dislike",
    props: {
        item: Object,
        method: Function,
    },
}
</script>

<style scoped>

</style>
