<template>

</template>

<script>
export default {
    props: ['method', 'form', 'text', 'post'],
    components: {
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
            this.form.post(this.route('comments.store', $page.props.post.id), {
                preserveScroll: true,
                onSuccess:()=>{
                    Toast.fire({
                    })
                    this.form.body = null
                }
            })
        },
    }
}
</script>
