<template>
    <div>
        <BreezeAuthenticatedLayout>
            <form @submit.prevent="submit">
                <div class="mb-2">
                    <div class="mx-2 sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">

                        <p class="text-xl font-bold">CREATE POST</p>
                        <BreezeInput id="body" type="text" class="mt-1  py-10 block w-full" v-model="form.body"
                                     placeholder="Add new post"
                                     required autofocus autocomplete="name"/>
                    </div>
                </div>
                <div>
                    <input
                        type="file"
                        @change="previewAvatar"
                        ref="photo"
                        class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                    />
                    <img
                        v-if="url"
                        :src="url"
                        class="w-full mt-4 h-80"
                    />
                </div>


                <div class=" mb-20 grid justify-items-center">
                    <loading-button :loading="form.processing"
                                    class="button px-8 py-2 " type="submit">
                        ADD POST
                    </loading-button>
                </div>
            </form>
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
import {useForm} from "@inertiajs/inertia-vue3";


export default {
    name: "Create",


    components: {
        BreezeAuthenticatedLayout,
        FileInput,
        TextInput,
        LoadingButton,
        BreezeInput,
        BreezeLabel
    },
    props: {
        posts: Object,
        user: Object,

    },

    data() {
        return {
            // avatar: avatar,
            url: null,
            userPosts: this.posts,
            form: this.$inertia.form({
                body: null,
                image: null,

            }),
        }
    },


    methods: {

        submit() {
            if (this.$refs.photo) {
                this.form.image = this.$refs.photo.files[0];
            }

            this.form.post(this.route('posts.store'))
        },

    },
    previewAvatar(e) {
        const file = e.target.files[0];
        this.url = URL.createObjectURL(file);

    },
    // created() {
    //     debugger
    // },
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
