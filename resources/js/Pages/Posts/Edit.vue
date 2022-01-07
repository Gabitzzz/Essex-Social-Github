<template>
    <div>
        <BreezeAuthenticatedLayout>
            <div class="mx-2 sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">
                <div class="max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
                    <form @submit.prevent="submit">
                        <div class="flex">
                            <inertia-link :href="route('profile', post.user.username)">
                                <div class="flex justify-items-start mx-2 mt-2 mb-2 ">
                                    <!--                    <img :src="avatar" class="rounded-full avatar w-12 h-12" alt="avatar">-->
                                    <img
                                        :src="showImage() + post.user.avatar"
                                        class="avatar rounded-full avatar w-10 h-10"
                                        alt="avatar"
                                    />

                                    <div>
                                        <p class="ml-2">
                                            {{ post.user.username }}
                                        </p>

                                        <span class="italic ml-2 align-text-top" style="font-size: 10px;">
                                         {{ post.timeAgo }}
                                        </span>
                                    </div>

                                </div>
                            </inertia-link>

                            <inertia-link preserve-scroll
                                          v-if="post.user.id === $page.props.auth.user.id"
                                          class=""
                                          as="button"
                                          :href="route('posts.edit', post.id)"
                            >
                                ...
                            </inertia-link>
                        </div>

                        <div class="p-1 mb-2 ">
                            <div>
                                <BreezeInput id="body" type="text" class="mt-1 block w-full" v-model="form.body"
                                             required autofocus autocomplete="name"/>
                            </div>
                        </div>

                        <div class="mb-8 justify-items-center grid">
                            <div class="flex">
                                <InertiaLink @click="back"
                                             class="ml-1 px-8 py-2 rounded-full bg-blue-400 text-center text-white ">
                                    CANCEL
                                </InertiaLink>

                                <loading-button :loading="form.processing"
                                                class="ml-1 px-8 py-2 rounded-full bg-green-700 text-center text-white "
                                                type="submit">
                                    UPDATE
                                </loading-button>
                            </div>

                            <inertia-link preserve-scroll
                                          class="mt-1 px-8 py-2 rounded-full bg-red-500 text-center text-white"
                                          style="font-size: 10px;"
                                          :href="route('posts.destroy', post.id)"
                            >
                                DELETE
                                &#128465;
                            </inertia-link>
                        </div>

                    </form>
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
        },
        showImage() {
            return "/storage/";
        },
        back() {
            window.history.back();
        },

    }
}
</script>

<style scoped>

</style>
