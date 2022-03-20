<template>
    <BreezeAuthenticatedLayout>

        <DegreeHeader :degree="degree"></DegreeHeader>
        <div class="mx-auto sm:mx-24 md:mx-30 lg:mx-48 xl:mx-60 2xl:mx-80">

        <div class="my-4  bg-white overflow-hidden shadow-sm rounded-xl shadow-md">
            <div class="flex">
                    <div class="flex justify-items-start m-2 items-center">
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
                            <p class="ml-2 mt-2">
                                {{ $page.props.post.user.username }}
                            </p>
<!--                            <span class="italic ml-2 align-text-top" style="font-size: 10px;">-->
<!--                                       {{ post.timeAgo }}-->
<!--                                </span>-->
                        </div>


                    </div>

<!--                <div class="w-full mt-4 ">-->
<!--                    <div v-if="post.location" class="flex text-right ml-8 items-center">-->
<!--                        <img-->
<!--                            :src="location"-->
<!--                            class="avatar  avatar w-4 h-4 ml-2 "-->
<!--                            alt="default"-->
<!--                        />-->

<!--                        <p class="text-center text-sm text-gray-600 ml-1 ">-->
<!--                            {{post.location}}-->
<!--                        </p>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <div class="mr-4" style="">-->
<!--                    <inertia-link preserve-scroll-->
<!--                                  v-if="post.user.id === $page.props.auth.user.id"-->
<!--                                  class=" -mt-6  "-->
<!--                                  as="button"-->
<!--                                  :href="route('posts.edit', post.id)"-->
<!--                    >-->
<!--                        ...-->
<!--                    </inertia-link>-->
<!--                </div>-->
            </div>

            <div class="px-4 border-b border-gray-200">
                <p class="text-sm px-4">
                    {{ post.body }}
                </p>

                <div v-if="post.image" class="mt-2 flex justify-center">
                    <img
                        :src="showImage() +  post.image"
                        class="avatar w-2/3 h-2/3"
                        alt="avatar"
                    />
                </div>

                <!--                &lt;!&ndash;                LIKES   &ndash;&gt;-->
                <!--                <inertia-link preserve-scroll-->
                <!--                              method="POST"-->
                <!--                              as="button"-->
                <!--                              :href="route('likes.toggle', post.id)"-->
                <!--                >-->
                <!--                    <div class="flex text-xs px-4 mt-2">-->
                <!--                        <div v-if="post.likes.length === 0">-->
                <!--                        </div>-->

                <!--                        <div v-else-if="post.likes.length === 1">-->
                <!--                            {{ post.likes.length }} Like &nbsp;-->
                <!--                        </div>-->

                <!--                        <div v-else>-->
                <!--                            {{ post.likes.length }} Likes &nbsp;-->
                <!--                        </div>-->

                <!--                        &lt;!&ndash;                DISLIKES    &ndash;&gt;-->
                <!--                        <div v-if="post.dislikes.length === 0">-->
                <!--                        </div>-->

                <!--                        <div v-else-if="post.dislikes.length === 1">-->
                <!--                            {{ post.dislikes.length }} Dislike &nbsp;-->
                <!--                        </div>-->

                <!--                        <div v-else>-->
                <!--                            {{ post.dislikes.length }} Dislikes &nbsp;-->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                </inertia-link>-->

                <hr>

                <div>
                    <div class="flex">
                        <div class="flex-auto w-12">
                            <img v-if="$page.props.auth.user.avatar === null"
                                 :src="defaultProfile"
                                 class="avatar w-8 h-8 mt-2 "
                                 alt="default"
                            />

                            <img v-else
                                 :src="showImage() + $page.props.auth.user.avatar"
                                 class="avatar rounded-full avatar w-8 h-8 mt-2"
                            />
                        </div>

                        <div
                            class="bg-white h-8 rounded-full shadow-md my-2 text-xs  border border-gray-300 flex-auto w-full ">
                            <p class="mt-2 ml-4 text-gray-700">
                                leave a comment
                            </p>
                        </div>

                        <div class="flex mt-3 flex-auto w-16">
                            <DegreeLike :post="post" :degree="degree" class="ml-1"></DegreeLike>
                            <DegreeDislike :post="post" :degree="degree" class="ml-1"></DegreeDislike>

                        </div>



                        <div class="mx-2 max-2 rounded-xl ">
                            <form @submit.prevent="submit" class="w-full">
                                <div class="flex mt-5">
                                    <BreezeInput id="body" type="text" class="block w-full h-10 mx-1" v-model="form.body"
                                                 placeholder="  leave a comment"
                                                 required autofocus autocomplete="name"/>

                                    <button type="submit"
                                            class="button px-6 shadow-2xl  md:mx-2"
                                            :class="{ 'opacity-25': form.processing }"
                                            :disabled="form.processing">
                                        SUBMIT
                                    </button>
                                </div>

                                <div class="flex justify-between my-3">
                                    <div>
                                    </div>
                                </div>
                            </form>
                        </div>


</div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import avatar from "/img/background/human.jpg";
import {InertiaLink} from "@inertiajs/inertia-vue3";
import CombinedComments from "@/Components/CombinedComments";
import PostForm from "@/Components/PostForm";
import location from "/img/Posts/location3.png";
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import DegreeHeader from "@/Components/DegreeHeader";
import defaultProfile from "/img/Posts/defaultProfile.png";
import DegreeDislike from "@/Components/DegreeDislike";
import DegreeLike from "@/Components/DegreeLike";
import BreezeInput from '@/Components/Input.vue';

export default {
    name: "Post",
    data(){
        return{
            form: this.$inertia.form({
                body: null,

            }),
            defaultProfile: defaultProfile,
            avatar: avatar,
            location:location,
        }
    },

            // form: this.$inertia.form({
            //     body: this.body,
            //     // user_id: this.post.user_id,
            // }),
            // likeForm: this.$inertia.form({
            //     userPost: this.post
            // }),
            // dislikeForm: this.$inertia.form({
            //     userPosts: this.post
            // }),
            // defaultProfile: defaultProfile,
    components: {
        DegreeDislike,
        DegreeLike,
        BreezeInput,
        InertiaLink,
        CombinedComments,
        PostForm,
        BreezeAuthenticatedLayout,
        DegreeHeader,
    },
    props: {
        post: Object,
        user: Object,
        comments: Array,
        degree: Object,
    },
    methods: {
        showImage() {
            return "/storage/";
        },


        submit() {
            this.form.post(this.route('degree.comments.store', [this.post, this.degree]), {
                preserveScroll: true,
                onSuccess: () => {
                    this.form.body = null
                }
            })
        },
    }
}
</script>


