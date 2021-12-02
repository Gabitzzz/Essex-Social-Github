<template>
    <div>
        <BreezeAuthenticatedLayout>
            <div class="mx-auto sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">
                <div class="max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
            <form @submit.prevent="submit">
                <div class="p-8 mb-2 ">
                    <div>
                        <BreezeLabel for="body" value="Body" class="flex items-center justify-center"/>
                        <BreezeInput id="body" type="text" class="mt-1 block w-full" v-model="form.body"
                                     required autofocus autocomplete="name"/>
                    </div>
                </div>


                <div class=" mb-20 grid justify-items-center">
                    <loading-button :loading="form.processing"
                                    class="button px-8 py-2 " type="submit">
                        UPDATE
                    </loading-button>
                </div>
            </form>

            <inertia-link preserve-scroll
                          :href="route('posts.destroy', post.id)"
            >
             X
            </inertia-link>

                </div>
            </div>
        </BreezeAuthenticatedLayout>
    </div>
</template>

<script>
import BreezeInput from "@/Components/Input";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeLabel from '@/Components/Label.vue';
import LoadingButton from "@/Components/LoadingButton";
import {InertiaLink} from "@inertiajs/inertia-vue3";




export default {
    name: "Edit",
    components: {
        BreezeAuthenticatedLayout,
        BreezeInput,
        BreezeLabel,
        LoadingButton,
        InertiaLink,
    },
    props: {
        post: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                body: this.post.body,
                _method: 'PUT',

            }),


        }
    },
    methods: {
        submit() {
            this.form.post(this.route('posts.update', this.post.id), this.data, {
                preserveState: (page) => Object.keys(($page.props.errors).length)
            });
        }

    }
}
</script>

<style scoped>

</style>
