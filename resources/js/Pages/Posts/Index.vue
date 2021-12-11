<template>
    <div>
        <BreezeAuthenticatedLayout>




        </BreezeAuthenticatedLayout>
    </div>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import PostForm from "@/Components/PostForm";
import CombinedComments from "@/Components/CombinedComments";
import CommentItem from "@/Components/CommentItem";
// import avatar from "/img/background/human.jpg";
import BreezeInput from '@/Components/Input.vue';
import Like from "@/Components/Like";
import Dislike from "@/Components/Dislike";
import {InertiaLink} from "@inertiajs/inertia-vue3";




export default {
    name: "Index",
    components: {
        CombinedComments,
        PostForm,
        BreezeAuthenticatedLayout,
        CommentItem,
        BreezeInput,
        Like,
        Dislike,
        InertiaLink,
    },
    props: {
        post: Object,
        comments: Array,
        user: Object,
        likes: Array,
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
    methods: {
        submit() {
            this.form.post(this.route('comments.store', this.post), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.body = null
                }
            })
        },
        showImage() {
            return "/storage/";
        },
    }
}
</script>

<style scoped>
.button{
    border-radius: 25px;
    color: ghostwhite;
    background-color: black;
    /*width: 100%;*/
    /*display: inline;*/
    text-align: center;
    font-size: 12px;
    font-family: 'Nunito', sans-serif;
}
</style>
