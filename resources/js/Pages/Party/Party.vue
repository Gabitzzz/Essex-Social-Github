<template>
    <div>
        <inertia-link preserve-scroll
                      :href="route('party.item', party)"
        >
            <div class="mx-2 mb-4 shadows-lg  ">
                <div class="rounded-lg shadow-md border-gray-200" style="position: relative;">
                    <img :src="showImage() + party.partyImg"
                         class="object-cover rounded-lg w-full" alt="cover"
                         style="max-height: 250px;  filter: brightness(30%);">

                    <figcaption class="absolute text-lg text-white px-4 -mt-56 " style="left:0;  right: 0;">

                        <div class="text-right text-lg ">

                            <p class="">
                                {{ party.date }}
                            </p>

                            <p class="text-3xl text-red-600 ">
                                <strong>
                                    {{ party.time }}
                                </strong>
                            </p>
                        </div>

                        <div>
                            <h3 class=" text-3xl text-center text-white "
                                style="font-family: 'Poppins', sans-serif;">
                                {{ party.title }}
                            </h3>
                        </div>
                        <div>
                            <h1 class="text-center mt-2">
                                {{ party.body }}
                            </h1>
                        </div>


                        <div class="flex  mt-12 ">
                            <img
                                :src="pin"
                                class="avatar  avatar w-6 h-6 mt-2  "
                                alt="default"
                            />

                            <p class="text-center text-sm mt-2 ml-2">

                                location
                            </p>
                        </div>
                    </figcaption>
                </div>

            </div>
        </inertia-link>
    </div>

</template>

<script>


import {InertiaLink} from "@inertiajs/inertia-vue3";
import pin from "/img/Posts/pin.png";


export default {
    name: "Party",
    props: {
        party: Object,
        invites: Object,
        followers: Object,
        inviteToggle: Boolean,
    },
    components: {
        InertiaLink,
    },
    data() {
        return {
            pin: pin,
        }
    },

    methods: {
        showImage() {
            return "/storage/";
        },


    },


}
</script>

<style scoped>
body {
    background-size: 100%;
}

.party-title {

    top: 25%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.cover {
    filter: brightness(30%);
}
</style>
