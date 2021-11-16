<template>
    <div class="mx-auto sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">
        <div class="max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
            <div class="flex justify-items-start mx-4 mt-4 mb-2 ">
                <img :src="avatar" class="rounded-full avatar w-12 h-12" alt="avatar">
                <p class="mt-2 ml-2">
                    {{ post.user.username }}
                </p>
            </div>

            <div class="px-4 pb-4 border-b border-gray-200">
                <p class="text-xl px-4 py-2">
                    {{ post.body }}

                </p>


                <!--                LIKES   -->
                <div class="flex text-xs">


                    <div v-if="post.liked === 0">

                    </div>

                    <div v-else-if="post.liked === 1">
                        {{ post.liked }} Like &nbsp;
                    </div>

                    <div v-else>
                        {{ post.liked }} Likes &nbsp;
                    </div>

                    <!--                DISLIKES    -->
                    <div v-if="post.disliked === 0">

                    </div>

                    <div v-else-if="post.disliked === 1">
                        {{ post.disliked }} Dislike &nbsp;
                    </div>

                    <div v-else>
                        {{ post.disliked }} Dislikes &nbsp;

                    </div>
                </div>

                <hr>


                <div class="flex justify-between">
                    <!-- ... -->
                    <div class="flex justify-self-star mt-2">
                        <img :src="avatar" class="rounded-full avatar w-8 h-8 mt-1" alt="avatar">
                        <p class="mt-2 ml-2">
                            {{ $page.props.auth.user.username }}

                        </p>
                    </div>

                    <div class="flex justify-end mt-4">
                        <div class="flex">

                            <Like :item="post" :method="submitLike"></Like>

                            <Dislike :item="post" :method="submitDislike" class="ml-1"></Dislike>

                            <button class="ml-1  h-6 w-6 rounded-full bg-blue-400">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import avatar from "/img/background/human.jpg";
import Like from "@/Components/Like.vue";
import Dislike from "@/Components/Dislike";

export default {
    name: "Post",
    data() {
        return {
            avatar: avatar,
            likeForm: this.$inertia.form({
                userPost: this.post
            }),
            dislikeForm: this.$inertia.form({
                userPosts: this.post
            }),

        }
    },
    components: {
        Like,
        Dislike,
    },
    props: {
        post: Object,
    },
    methods: {
        submitLike() {
            this.likeForm.post(this.route('post-like.store', this.post), {
                preservedScroll: true,
                onSuccess: () => {
                }
            })
        },


        submitDislike() {
            this.dislikeForm.delete(this.route('post-like.destroy', this.post), {
                preserveScroll: true,
                onSuccess:()=>{}
            })
        },

    }
}
</script>

<style scoped>

</style>
