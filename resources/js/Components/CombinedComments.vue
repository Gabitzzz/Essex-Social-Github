<template>
    <div>
        <PostForm  :form="form" :text="'Comment'"></PostForm>

        <div v-for="(comment, index) in comments" :key="index">
            <CommentItem :comment="comment"></CommentItem>
        </div>
    </div>
</template>

<script>
import CommentItem from './CommentItem'
import PostForm from "@/Components/PostForm";
export default {
    props: ['comments', 'form'],
    components: {
        CommentItem,
        PostForm,
    },

}
</script>
