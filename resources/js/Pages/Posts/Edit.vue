<template>
    <div>
        <BreezeAuthenticatedLayout>
            <Head title="Edit Post"/>

            <form @submit.prevent="submit">

            <div class="my-4 mx-2 sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80 5xl:mx-96 ">
                <div class="max-2 bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
                        <div class="flex justify-between">
                            <inertia-link :href="route('profile', post.user.username)">
                                <div class="flex justify-items-start mx-2 mt-2 mb-2 items-center ">
                                    <!--                    <img :src="avatar" class="rounded-full avatar w-12 h-12" alt="avatar">-->


                                    <div v-if="post.user.avatar === null">
                                        <img
                                            :src="defaultProfile"
                                            class="avatar  avatar w-10 h-10 ml-2 my-2"
                                            alt="default"
                                        />
                                    </div>

                                    <div v-else>
                                        <img
                                            :src="showImage() + post.user.avatar || showImage() + 'default-avatar.png'"
                                            class="avatar rounded-full avatar w-10 h-10 ml-2 my-2 "
                                            alt="avatar"
                                        />
                                    </div>

                                    <div>
                                        <p class="ml-2">
                                            {{ post.user.username }}
                                        </p>

                                        <span class="italic ml-2 align-text-top" style="font-size: 10px;">
                                         {{ post.timeAgo }}
                                        </span>
                                    </div>

<!--                                    <inertia-link preserve-scroll-->
<!--                                                  v-if="post.user.id === $page.props.auth.user.id"-->
<!--                                                  class=" -mt-6  "-->
<!--                                                  as="button"-->
<!--                                                  :href="route('posts.edit', post.id)"-->
<!--                                    >-->
<!--                                        ...-->
<!--                                    </inertia-link>-->


                                </div>
                            </inertia-link>

                            <div v-if="post.user_id === $page.props.auth.user.id" class=" mr-5 mt-5 ">
                                <inertia-link class="bg-red-500 text-white px-4 py-2 rounded-2xl text-xs"  :href="route('posts.destroy', post.id)">
                                    DELETE
                                </inertia-link>
                            </div>

                        </div>

                        <div class="pb-1 mx-2 lg:mx-4 ">
                            <div>
                                <BreezeInput id="body" type="text" class=" block w-full" v-model="form.body"
                                             style="border: none !important;"
                                             required autofocus autocomplete="body"/>
                            </div>
                        </div>

                        <div class="flex my-4 mx-2 lg:mx-4">
                            <img :src="location2" width="40" alt="location">

                            <BreezeInput id="location" type="text" class=" ml-2 block w-full  "
                                         style="border: none !important;"
                                         v-model="form.location"
                                         placeholder="Location"
                            />
                        </div>




                </div>

                <div class="flex justify-center">
                    <loading-button :loading="form.processing"
                                    class="button px-8 mt-4 py-2 bg-black text-white rounded-2xl"
                                    type="submit">
                        UPDATE POST
                    </loading-button>
                </div>


               <div class="flex justify-center mt-5">
                   <InertiaLink @click="back"
                                class=" px-8 py-2 rounded-full bg-white text-center  ">
                       CANCEL
                   </InertiaLink>
               </div>
            </div>
            </form>

        </BreezeAuthenticatedLayout>
    </div>
</template>

<script>
import BreezeInput from "@/Components/Input";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeLabel from '@/Components/Label.vue';
import LoadingButton from "@/Components/LoadingButton";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import defaultProfile from "/img/Posts/defaultProfile.png";
import location2 from "/img/Party/location2.png";
import {Head} from '@inertiajs/inertia-vue3';


export default {
    name: "Edit",
    components: {
        BreezeAuthenticatedLayout,
        BreezeInput,
        BreezeLabel,
        LoadingButton,
        InertiaLink,
        Head,
    },
    props: {
        post: Object,

    },
    data() {
        return {
            form: this.$inertia.form({
                body: this.post.body,
                location: this.post.location,
                _method: 'PUT',
            }),
            defaultProfile: defaultProfile,
            location2: location2,
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
