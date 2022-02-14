<template>
    <BreezeAuthenticatedLayout>
        <form @submit.prevent="submit">
            <div class="mb-2">
                <div class="mx-2 sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">


                    <div class="mt-5 max-2 overflow-hidden rounded-xl font-bold">
                        <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">
                            <!--                        DASHBOARD-->
                            Edit party
                        </h1>
                    </div>

                    <div>
                        <p class="mx-4  text-lg" style="font-family: 'Poppins', sans-serif;">
                            Change Cover
                        </p>

                        <input
                            type="file"
                            @change="previewCover"
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


<!--                        <div class="flex justify-center">-->
<!--                            <img v-if="party.partyImg && !url"-->
<!--                                 :src="showImage() + party.partyImg"-->
<!--                                 class="w-1/2 mx-10  mt-4 "-->
<!--                                 alt="cover"-->
<!--                                 style="max-height: 250px;  filter: brightness(50%);">-->
<!--                        </div>-->

<!--                        <div class="flex  justify-center items-center">-->
<!--                            <img-->
<!--                                v-if="url"-->
<!--                                :src="url"-->
<!--                                class="w-1/2 mx-10  mt-4 "-->
<!--                            />-->
<!--                        </div>-->

                        <img
                            v-if="!url"
                            :src="'/storage/' + $page.props.party.partyImg "
                            class="avatar rounded-full avatar w-32 h-32"
                            alt="avatar"
                        />

                        <img
                            v-if="url"
                            :src="url"
                            class="avatar rounded-full avatar w-32 h-32">


                        <!--                        <img-->
<!--                            v-if="!url"-->
<!--                            :src="'/storage/' + form.partyImg"-->
<!--                            class="flex justify-center   "-->
<!--                            alt="avatar"-->
<!--                        />-->
                    </div>


                    <inertia-link preserve-scroll
                                  class="mt-1 px-8 py-2 rounded-full bg-red-500 text-center text-white"
                                  style="font-size: 10px;"
                                  :href="route('parties.destroy', party.id)"
                    >
                        DELETE
                        &#128465;
                    </inertia-link>


<!--                    <img :src="'/storage/' + $page.props.party.partyImg" alt="">-->

                    <BreezeInput id="title" type="text" class="mt-1 block w-full bg-gray-100 "
                                 style="border: none !important;"
                                 v-model="form.title"
                                 placeholder="Party Name"
                                 required autofocus autocomplete="title"/>

                    <BreezeInput id="description" type="text" class="mt-4 pb-10 block w-full bg-gray-100 "
                                 style="border: none !important;"
                                 v-model="form.description"
                                 placeholder="Party Description"
                                 required autofocus autocomplete="description"/>
                </div>
            </div>


            <div class="mx-2 sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">
                <p class="mx-4 my-2 text-lg" style="font-family: 'Poppins', sans-serif;">Current date</p>
                <div class="mx-4">
                    <p>
                        {{ party.date }}
                    </p>

                    <p class="text-3xl text-red-600 ">
                        <strong>
                            {{ party.time }}
                        </strong>
                    </p>
                </div>
            </div>

            <div class="mx-2 sm:mx-16 md:mx-24 my-4 lg:mx-72 xl:mx-96">
                <p class="mx-4 my-2 text-lg" style="font-family: 'Poppins', sans-serif;">Select new date</p>

                <DatePicker
                    v-model="form.date"
                    is-expanded
                    is24hr
                    format="YYYY-MM-DD"
                    :masks="{ L: 'YYYY-MM-DD' }"
                    mode="dateTime"
                    :min-date='new Date()'

                >
                </DatePicker>


                <div class="flex mt-4 lg:mx-4 ">
                    <img :src="location2" width="40" alt="plus">

                    <BreezeInput id="location" type="text" class=" ml-2 block w-full bg-gray-100 "
                                 style="border: none !important;"
                                 v-model="form.location"
                                 placeholder="Location"
                                 required autofocus autocomplete="location"/>
                </div>

                <!--                    PUBLIC OR PRIVATE SWITCH        -->
<!--                <div class="flex justify-center mt-5" style="font-family: 'Poppins', sans-serif;">-->
<!--                    <div class="form-check form-check-inline">-->
<!--                        <input-->
<!--                            v-model.number="typeOfTask" :value="1" id="defaultCheck1"-->
<!--                            type="radio"-->
<!--                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-black checked:border-black focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer">-->

<!--                        <label class="form-check-label inline-block text-gray-800" for="defaultCheck1">-->
<!--                            PUBLIC-->
<!--                        </label>-->

<!--                    </div>-->
<!--                    <div class="form-check form-check-inline ml-4">-->
<!--                        <input-->
<!--                            v-model.number="typeOfTask" type="radio" :value="2" id="scheduleCheck"-->
<!--                            class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer">-->

<!--                        <label class="form-check-label inline-block text-gray-800" for="scheduleCheck">-->
<!--                            PRIVATE-->
<!--                        </label>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <div v-if="typeOfTask === 1">-->
<!--                    <div class="mt-5 max-2 overflow-hidden rounded-xl font-bold">-->
<!--                        <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">-->
<!--                            &lt;!&ndash;                        DASHBOARD&ndash;&gt;-->
<!--                            Public Party-->
<!--                        </h1>-->
<!--                        <p class="text-sm px-2 " style="font-family: 'Poppins', sans-serif; font-weight: 100;">-->
<!--                            <i>-->
<!--                                Public parties can be seen and joined by everyone.-->
<!--                                Your party will appear on the activity page.-->
<!--                                <br>-->
<!--                            </i>-->
<!--                        </p>-->

<!--                    </div>-->
<!--                </div>-->

<!--                <div v-if="typeOfTask === 2">-->

<!--                    <div class="mt-5 max-2 overflow-hidden rounded-xl font-bold">-->
<!--                        <h1 class="text-4xl px-2 py-2" style="font-family: 'Poppins', sans-serif;">-->
<!--                            &lt;!&ndash;                        DASHBOARD&ndash;&gt;-->
<!--                            Private Party-->
<!--                        </h1>-->
<!--                        <p class="text-sm px-2" style="font-family: 'Poppins', sans-serif; font-weight: 100;">-->
<!--                            <i>-->
<!--                                Private parties work only with invitation.-->
<!--                                <br>-->
<!--                                Select friends that you want to attend the party.-->
<!--                            </i>-->
<!--                        </p>-->

<!--                    </div>-->

<!--                    <div v-for="follower in $page.props.followers.data" :key="follower.id">-->

<!--                        <inertia-link class="px-6 py-4 flex items-center"-->
<!--                                      :href="route('profile', follower.username)"-->
<!--                                      tabindex="-1">-->
<!--                            {{ follower.name }}-->
<!--                        </inertia-link>-->
<!--                    </div>-->
<!--                </div>-->


                <!--                    <pagination class="mt-6" :links="followers.links" />-->

            </div>


            <div class=" mb-10 grid justify-items-center">
                <loading-button :loading="form.processing"
                                class="button px-8 py-2 " type="submit">
                    ADD POST
                </loading-button>
            </div>
        </form>

    </BreezeAuthenticatedLayout>

</template>


<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeInput from '@/Components/Input.vue';
import {Calendar, DatePicker} from 'v-calendar';
import {InertiaLink} from "@inertiajs/inertia-vue3";
import LoadingButton from "@/Components/LoadingButton";
import location2 from "/img/Party/location2.png";


export default {
    name: "Edit",
    components: {
        BreezeAuthenticatedLayout,
        BreezeInput,
        DatePicker,
        Calendar,
        InertiaLink,
        LoadingButton,
    },
    props: {
        party: Object,
    },

    data() {
        return {
            form: this.$inertia.form({
                description: this.party.description,
                title: this.party.title,
                date: this.party.date,
                partyImg: this.party.partyImg,
                location: this.party.location,
                _method: 'PUT',
            }),
            url: null,
            location2: location2,

        }
    },
    methods: {
        submit() {
            if (this.$refs.photo) {
                this.form.partyImg = this.$refs.photo.files[0];
            }

            this.form.post(this.route('parties.update', this.party.id), this.data, {
                preserveState: (page) => Object.keys(($page.props.errors).length)
            });
        },
        previewCover(e) {
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file);
        },
        showImage() {
            return "/storage/";
        },
    }
}
</script>

<style scoped>

</style>
