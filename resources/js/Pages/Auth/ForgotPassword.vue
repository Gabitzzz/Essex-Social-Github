<template>
    <Head title="Forgot Password" />

    <div class="mb-4 text-md text-gray-600">
        Forgot your password? <br>
        No problemo. <br>
        Just email
        <a href="mailto:nl19102@essex.ac.uk" class="font-bold">nl19102@essex.ac.uk</a>
        with your Essex Email Address and I will provide you a new password.

    </div>





</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
    },

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.email'))
        }
    }
}
</script>
