<template>
    <Head title="Info"/>

    <div class="">


        <BreezeValidationErrors class="mb-4"/>
        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="dob" value="Date of Birth" class="flex items-center justify-center"/>
                <BreezeInput id="dob" type="text" class="mt-1 block w-full" v-model="form.dob" required autofocus
                             autocomplete="dob"/>
            </div>

            <div class="mt-8">
                <BreezeLabel for="type" value="Are you.." class="flex items-center justify-center"/>
                <BreezeInput id="type" type="text" class="mt-1 block w-full" v-model="form.type" required
                             autofocus autocomplete="type"/>
            </div>


            <div class="mt-8">
                <BreezeLabel for="study_year" value="Study Year" class="flex items-center justify-center"/>
                <BreezeInput id="study_year" type="text" class="mt-1 block w-full" v-model="form.study_year" required
                             autofocus autocomplete="study_year"/>
            </div>

            <div class="mt-8">
                <BreezeLabel for="citizenship" value="Where are you from?" class="flex items-center justify-center"/>
                <BreezeInput id="citizenship" type="text" class="mt-1 block w-full" v-model="form.citizenship" required
                             autofocus autocomplete="citizenship"/>
            </div>


            <div class="flex items-center justify-center mt-4">


                <BreezeButton :user="$page.props.auth.user" :class="{ 'opacity-25': form.processing }"
                              :disabled="form.processing">
                    Register
                </BreezeButton>
            </div>


        </form>

    </div>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeGuestLayout from '@/Layouts/Guest.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import {Head, Link} from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,
    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },
    props: {
        attributes: Array,
        user: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                dob: '',
                type: '',
                study_year: '',
                citizenship: '',
                // terms: false,
                _method: 'PUT',

            })

        }
    },

    methods: {
        submit() {
            this.form.post(this.route('info.update', this.user), this.data, {
                preserveState: (page) => Object.keys(($page.props.errors).length)
            });
        }
    }
}
</script>
<style>
.tooltip {
    position: relative;
    display: inline-block;

}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 250px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
    top: -5px;
    right: 105%;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}
</style>
