<template>
    <div>
        <BreezeAuthenticatedLayout>
            <form @submit.prevent="submit" class="w-full">
                <div>
                    <textarea name="post" rows="3" class="border rounded px-2 py-2 w-full"
                              :placeholder="`Post something  ...`" v-model="form.body"></textarea>
                </div>
                <div class="flex justify-between my-3">
                    <div>
                        <button type="submit" class="text-xs" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                            se
                        </button>
                    </div>

                </div>
            </form>


            <div v-for="(comment, index) in comments" :key="index">
                <CommentItem :comment="comment"></CommentItem>
            </div>

        </BreezeAuthenticatedLayout>
        <!--        <PostForm  :form="form" :text="'Comment'"></PostForm>-->


    </div>
</template>

<script>
import CommentItem from "@/Components/CommentItem";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';

import PostForm from "@/Components/PostForm";

export default {
    props: {
        post: Object,
    },
    data() {
        return {
            // avatar: avatar,
            form: this.$inertia.form({
                body: null,
                image: null,

            }),
        }
    },
    components: {
        CommentItem,
        PostForm,
        BreezeAuthenticatedLayout,
    },

    methods: {
        submit() {
            this.form.post(this.route('comments.store', post.id), {
                preserveScroll: true,
                onSuccess: () => {
                    Toast.fire({})
                    this.form.body = null
                }
            })
        },
    }

}
</script>
