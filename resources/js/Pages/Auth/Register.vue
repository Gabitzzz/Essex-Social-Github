<template>
    <Head title="Register"/>

    <div class="">


        <BreezeValidationErrors class="mb-4"/>
        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="name" value="Name" class="flex items-center justify-center"/>
                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                             autocomplete="name"/>
            </div>

            <div class="mt-8">
                <BreezeLabel for="username" value="Username" class="flex items-center justify-center"/>
                <BreezeInput id="username" type="text" class="mt-1 block w-full" v-model="form.username" required
                             autofocus autocomplete="username"/>
            </div>

            <div class="mt-8">
                <div class="flex justify-center items-center">
                    <BreezeLabel for="email" value="Essex Email" class="flex items-center justify-center"/>


                </div>
                <div class="flex justify-between items-center">
                    <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                                 autocomplete="email"
                                 placeholder="jd19102@essex.ac.uk"
                    />
                    <div class="absolute right-0 tooltip text-sm justify-end px-2 bg-white rounded-full">?
                        <span class="tooltiptext text-sm">
                            Are you an Essex alumni? <br>
                            Use the Essex Email Address you had during your time here.
                        </span>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <BreezeLabel for="password" value="Password" class="flex items-center justify-center"/>
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                             autocomplete="new-password"/>
            </div>

            <div class="mt-8">
                <BreezeLabel for="password_confirmation" value="Confirm Password"
                             class="flex items-center justify-center"/>
                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full"
                             v-model="form.password_confirmation" required autocomplete="new-password"/>
            </div>

            <div class="flex items-center justify-center my-8">
                <a v-on:click="isHidden = !isHidden" class="flex justify-center bg-black rounded-full text-white w-full py-1">
                    {{isHidden ? 'NEXT' : 'BACK'}}
                </a>


            </div>


            <div v-if="!isHidden">
                <div>
                    <BreezeLabel for="dob" value="Date of Birth" class="mt-6 mb-1 flex items-center justify-center"/>
                    <DatePicker
                        v-model="form.dob"
                        is-expanded
                        is24hr
                        format="YYYY-MM-DD"
                        :masks="{ L: 'YYYY-MM-DD' }"
                        mode="date"
                        :max-date='new Date()'
                    >
                    </DatePicker>
                </div>

                <div class="my-8">
                    <BreezeLabel for="type" value="Are you.." class="flex mb-1 items-center justify-center"/>
                    <vSelect id="type" type="text" v-model="form.type" class="border-none"
                             :options="['Undergraduate', 'Postgraduate', 'Staff', 'Alumni', 'Other']"></vSelect>
                </div>

                <div v-if="form.type === 'Undergraduate'">
                    <div class="my-8">
                        <BreezeLabel for="study_year" value="Study Year" class="flex mb-1 items-center justify-center"/>
                        <vSelect id="study_year" type="text" v-model="form.study_year" class="border-none"
                                 :options="['Foundation Year', '1st Year', '2nd Year', '3rd Year', 'Placement Year', 'Year Abroad']"></vSelect>
                    </div>
                </div>

                <div v-if="form.type === 'Postgraduate'">
                    <div class="my-8">
                        <BreezeLabel for="study_year" value="Study Year" class="flex mb-1 items-center justify-center"/>
                        <vSelect id="study_year" type="text" v-model="form.study_year" class="border-none"
                                 :options="['1st Year Masters', '2nd Year Masters', '1st Year PHD', '2nd Year PHD', '3rd Year PHD', 'Completion Year']"></vSelect>
                    </div>
                </div>

                <div class="my-8" v-if="form.type === 'Postgraduate' || form.type === 'Undergraduate'">

                    <BreezeLabel for="degree" value="You are Studying" class="flex mb-1 items-center justify-center"/>

                    <select class="form-control w-full" name="type" v-model="form.degree">
                        <option :value="degree.title" v-for="degree in degrees" :key="degree.id">
                            {{ degree.title }}
                        </option>
                    </select>


                </div>

                <div class="my-8" v-if="form.type === 'Alumni'">

                    <BreezeLabel for="degree" value="You have Studied" class="flex mb-1 items-center justify-center"/>

                    <select class="form-control w-full" name="type" v-model="form.degree">
                        <option :value="degree.id" v-for="degree in degrees" :key="degree.id">
                            {{ degree.title }}
                        </option>
                    </select>

                </div>


                <BreezeButton class="flex justify-center bg-black rounded-full text-white w-full py-1 text-md" :disabled="form.processing">
                    Register
                </BreezeButton>
            </div>


            <!--            <h1 v-if="!isHidden">Hide me on click event!</h1>-->

            <div class="flex items-center justify-center mt-4">
                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </Link>
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
import {DatePicker, Calendar} from "v-calendar";
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
        Calendar,
        DatePicker,
        vSelect,

    },
    props: {
        degrees: Array,
    },

    data() {
        return {
            isHidden: true,
            form: this.$inertia.form({
                name: '',
                username: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,

                dob: '',
                type: '',
                study_year: '',
                degree: '',
                // country:'',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
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

.vs--searchable .vs__dropdown-toggle{
    border: none !important;
}
</style>
