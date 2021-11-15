<template>
    <div>
        <!--    <span>5</span>-->
<!--        <form @submit.prevent="method">-->
<!--            <div class="flex">-->

<!--                <button v-if="item.liked === 0"-->
<!--                        type="submit"-->
<!--                        class="h-6 w-6 rounded-full bg-green-500 hover:bg-green-700">-->
<!--                </button>-->

<!--                <button v-else-if="item.liked !== 0"-->
<!--                        type="submit"-->
<!--                        class="h-6 w-6 rounded-full bg-green-500 hover:bg-green-700">-->
<!--                </button>-->




<!--            </div>-->


<!--        </form>-->



        <inertia-link v-if="!$page.props.likeToggle"
                      as="button"
                      class="follow button shadow-2xl  items-center px-3 py-1 bg-white border border-transparent rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-green-700 hover:text-white w-40 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                      style="font-size: 80%;"
                      :href="`/users/${$page.props.auth.user.username}/followings/${user.id}`"
                      preserve-scroll
                      method="POST">
            Follow
        </inertia-link>

        <inertia-link v-if="$page.props.likeToggle"
                      as="button"
                      class="follow button shadow-2xl  items-center px-3 py-1 bg-white border border-transparent
                                                        rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-red-600 hover:text-white
                                                        active:bg-green-700 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray
                                                        transition ease-in-out duration-150 w-40"
                      style="font-size: 80%;"
                      :href="`/users/${$page.props.auth.user.username}/followings/${user.id}`"
                      preserve-scroll
                      method="DELETE">
            {{ showUnfollow ? 'Unfollow' : '✓ Following' }}
        </inertia-link>

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
