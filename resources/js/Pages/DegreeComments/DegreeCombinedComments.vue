<template>
    <div>
        <PostForm  :form="form" :text="'Comment'"></PostForm>

        <div v-for="(comment, index) in comments" :key="index">
            <DegreeCommentItem :comment="comment"></DegreeCommentItem>
        </div>
    </div>
</template>

<script>
import DegreeCommentItem from "@/Pages/DegreeComments/DegreeCommentItem";

import PostForm from "@/Components/PostForm";
export default {
    props: ['comments', 'form'],
    components: {
        DegreeCommentItem,
        PostForm,
    },

}
</script>
