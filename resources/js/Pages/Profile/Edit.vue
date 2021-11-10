<template>
    <div>

        <BreezeAuthenticatedLayout>

            <div class="bg-gray-100">
                <div class="mx-auto sm:mx-16 md:mx-24 lg:mx-72 xl:mx-96">
                    <form @submit.prevent="update">
                        <div class="p-8 mb-2 ">
                            <div>
                                <BreezeLabel for="username" value="Username" class="flex items-center justify-center"/>
                                <BreezeInput id="username" type="text" class="mt-1 block w-full" v-model="form.username"
                                             required autofocus autocomplete="name"/>
                            </div>

                            <div class="mt-8">
                                <BreezeLabel for="name" value="Name" class="flex items-center justify-center"/>
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                             required
                                             autofocus autocomplete="name"/>
                            </div>

                            <div class="mt-8">
                                <BreezeLabel for="email" value="Email" class="flex items-center justify-center"/>
                                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                                             required
                                             autocomplete="email"/>
                            </div>

                            <div class="mt-8">
                                <BreezeLabel for="description" value="Description"
                                             class="flex items-center justify-center"/>
                                <BreezeInput id="description" type="text" class="mt-1 block w-full"
                                             v-model="form.description"
                                             autocomplete="description"/>
                            </div>

                            <div class="mt-8">
                                <BreezeLabel for="password" value="Password" class="flex items-center justify-center"/>
                                <BreezeInput id="password" type="password" class="mt-1 block w-full"
                                             v-model="form.password"
                                             required autocomplete="new-password"/>
                            </div>

                            <div class="mt-8">
                                <BreezeLabel for="password_confirmation" value="Confirm Password"
                                             class="flex items-center justify-center"/>
                                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full"
                                             v-model="form.password_confirmation" required autocomplete="new-password"/>
                            </div>
                        </div>

                        <div class=" mb-20 grid justify-items-center">
                            <loading-button :loading="form.processing"
                                            class="button px-8 py-2 " type="submit">
                                UPDATE
                            </loading-button>
                        </div>
                    </form>
                </div>
            </div>
        </BreezeAuthenticatedLayout>

    </div>
</template>

<script>

import FileInput from "@/Components/FileInput";
import TextInput from "@/Components/TextInput";
import LoadingButton from "@/Components/LoadingButton";
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';


export default {


    name: "Edit",
    metaInfo() {
        return {
            // title: 'this.form.username',
        }
    },
    components: {
        FileInput,
        TextInput,
        LoadingButton,
        BreezeInput,
        BreezeLabel,
        BreezeAuthenticatedLayout
    },

    remember: 'form',
    props: {
        username: Object,
        user: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                _method: 'put',
                name: this.user.name,
                username: this.user.username,
                email: this.user.email,
                description: this.user.description,
                password: null,
                // owner: this.user.owner,
                // photo: null,
            }),
        }
    },

    methods: {
        update() {
            this.form.put(this.route('users.update', this.user.id), {
                onSuccess: () => this.form.reset('password'),
            })
        },
        // destroy() {
        //     if (confirm('Are you sure you want to delete this user?')) {
        //         this.$inertia.delete(this.route('users.destroy', this.user.id))
        //     }
        // },

    },
}
</script>

<style scoped>

.button {
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
