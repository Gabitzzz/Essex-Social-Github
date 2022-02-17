<template>
    <div>
        <inertia-link
                      :href="route('party.item', party)"
        >
            <div class="mx-2 mb-4 shadows-lg  ">
                <div class="rounded-lg shadow-md border-gray-200" style="position: relative;">

                    <img v-if="party.partyImg"
                         :src="showImage() + party.partyImg"
                         class="object-cover rounded-lg w-full" alt="cover"
                         style="max-height: 250px;  filter: brightness(30%);">
                    <img v-else
                         class="object-cover rounded-lg w-full" alt="cover"
                         :src="partyCover"
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
                            <div class=" text-center pb-12 mt-2 text-sm  ">
                                <div v-if="party.invites.length === 0" class="mb-7">

                                </div>
                                <div v-else-if="invites.length === 1">
                                    {{ party.invites.length }} person is coming
                                </div>
                                <div v-else>
                                    {{ party.invites.length }} people are coming
                                </div>
                            </div>
                        </div>


                        <div class="flex justify-between mt-2">
                            <div class="flex">
                                <img
                                    :src="pin"
                                    class="avatar  avatar w-6 h-6 mt-2  "
                                    alt="default"
                                />

                                <p class="text-center text-sm mt-2 ml-2">
                                    {{ party.location }}
                                </p>
                            </div>

<!--                            <p class="text-sm mt-2">-->
<!--                                organized by {{ username }}-->
<!--                            </p>-->
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
import partyCover from "/img/Party/partyCover.jpg";

export default {
    name: "Party",
    props: {
        party: Object,
        invites: Array,
        followers: Object,
        inviteToggle: Boolean,
        username: String,

    },
    components: {
        InertiaLink,
    },
    data() {

        return {
            pin: pin,
            partyCover: partyCover,
            // description: this.party.description,
        }
    },

    methods: {
        showImage() {
            return "/storage/";
        },

    },
    computed: {
        shortText() {
            return this.description.substr(0, 75)
        }
    }
    // computed: {
    //     truncate: function(data,num){
    //         const reqdString =
    //             data.split("").slice(0, num).join("");
    //         return reqdString;
    //     }
    // }


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
