<template>
    <div>
        <BreezeAuthenticatedLayout>
            <Head title="Edit Profile"/>
            <div class="bg-gray-100">
                <div class="mx-auto mx-2 sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80 5xl:mx-96">

                    <div class="mt-5 max-2 overflow-hidden rounded-xl font-bold">
                        <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                            Edit your Profile
                        </h1>
                    </div>
                    <form @submit.prevent="submit">
                        <div class="p-8 mb-2 ">
                            <div>
                                <div class="flex justify-center">
                                    <img
                                        v-if="!url"
                                        :src="'/storage/' + $page.props.user.avatar "
                                        class="avatar rounded-full avatar w-32 h-32"
                                        alt="avatar"
                                    />

                                    <img
                                        v-if="url"
                                        :src="url"
                                        class="avatar rounded-full avatar w-32 h-32"

                                    />
                                </div>

                                <input
                                    type="file"
                                    @change="previewAvatar"
                                    ref="photo"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "

                                />
                            </div>

                            <!--                            UPLOAD COVER                -->
<!--                            <div>-->
<!--                                <div class="flex justify-center">-->
<!--                                    <img-->
<!--                                        v-if="!coverUrl"-->
<!--                                        :src="'/storage/' + $page.props.user.cover "-->
<!--                                        class="avatar rounded-full avatar w-1/2 h-1/2"-->
<!--                                        alt="cover"-->
<!--                                    />-->

<!--                                    <img-->
<!--                                        v-if="coverUrl"-->
<!--                                        :src="coverUrl"-->
<!--                                        class="cover rounded-full avatar w-1/2 h-1/2"-->

<!--                                    />-->
<!--                                </div>-->

<!--                                <input-->
<!--                                    type="file"-->
<!--                                    @change="previewCover"-->
<!--                                    ref="coverPhoto"-->
<!--                                    class="-->
<!--                                        w-full-->
<!--                                        px-4-->
<!--                                        py-2-->
<!--                                        mt-2-->
<!--                                        border-->
<!--                                        rounded-md-->
<!--                                        focus:outline-none-->
<!--                                        focus:ring-1-->
<!--                                        focus:ring-blue-600-->
<!--                                    "-->
<!--                                />-->


<!--                            </div>-->

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

                        <div class="pb-20 mb-20 grid justify-items-center">
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
import {useForm} from "@inertiajs/inertia-vue3"
import {Head} from '@inertiajs/inertia-vue3';

export default {
    name: "Edit",
    components: {
        FileInput,
        TextInput,
        LoadingButton,
        BreezeInput,
        BreezeLabel,
        BreezeAuthenticatedLayout,
        Head,
    },
    remember: 'form',
    props: {
        user: Object,
    },
    data() {
        return {
            coverUrl: null,
            url: null,
            form: this.$inertia.form({
                name: this.user.name,
                username: this.user.username,
                email: this.user.email,
                description: this.user.description,
                password: null,
                avatar: this.user.avatar,
                // cover: this.user.cover,
                _method: 'PUT',
            }),
        }
    },

    methods: {
        submit() {
            if (this.$refs.photo) {
                this.form.avatar = this.$refs.photo.files[0];
            }

            if (this.$refs.coverPhoto) {
                this.form.cover = this.$refs.coverPhoto.files[0];
            }


            this.form.post(this.route('users.update', this.user.id), this.data, {
                preserveState: (page) => Object.keys(($page.props.errors).length)
            });
        },

        previewAvatar(e) {
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file);
        },
        previewCover(e) {
            const file = e.target.files[0];
            this.coverUrl = URL.createObjectURL(file);

        },

    }
}

</script>

<style scoped>

.button {
    border-radius: 25px;
    color: ghostwhite;
    background-color: black;
    text-align: center;
    font-size: 12px;
    font-family: 'Nunito', sans-serif;
}

</style>
