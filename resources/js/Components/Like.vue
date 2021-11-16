<template>
    <div>
        <!--    <span>5</span>-->
        <form @submit.prevent="method">
            <div class="flex">

                <button v-if="item.liked === 0"
                        type="submit"
                        class="h-6 w-6 rounded-full bg-green-500 hover:bg-green-700">
                </button>

                <button v-else-if="item.liked !== 0"
                        type="submit"
                        class="h-6 w-6 rounded-full bg-green-500 hover:bg-green-700">
                    ✓
                </button>


            </div>
        </form>



    </div>
</template>

<script>
export default {
    name: "Like",
    props: {
        item: Object,
        method: Function,
    },
}
</script>

<style scoped>

</style>
