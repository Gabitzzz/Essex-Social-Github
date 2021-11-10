<template>
    <div>
        <BreezeAuthenticatedLayout>
            <form @submit.prevent="create">
                <div class="mb-2">
                        <div class="mx-auto sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">

                        <p class="text-xl text-center">Create new Post!</p>
                        <BreezeLabel for="body" value="Body" class="flex items-center justify-center"/>
                        <BreezeInput id="body" type="text" class="mt-1  py-10 block w-full" v-model="form.body"
                                     placeholder="Search..."
                                     required autofocus autocomplete="name"/>
                    </div>


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
            userPosts: this.posts,
            form: this.$inertia.form({
                body: null,
                image: null,

            }),
        }
    },
    methods:{
        create(){
            this.form.post(this.route('posts.store'))
        },
    }



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
