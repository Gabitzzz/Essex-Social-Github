<template>
    <div>
        <inertia-link
                      :href="route('event.item', event)"
        >
            <div class="mx-2 mb-4 shadows-lg  ">
                <div class="rounded-lg shadow-md bg-white pb-6" style="position: relative;">

                    <img v-if="event.eventImg"
                         :src="showImage() + event.eventImg"
                         class="object-cover rounded-t-lg  w-full" alt="cover"
                         style="max-height: 150px;  filter: brightness(30%);">
                    <img v-else
                         class="object-cover rounded-t-lg w-full" alt="cover"
                         :src="eventCover"
                         style="max-height: 150px;  filter: brightness(30%);">


                    <figcaption class="absolute text-lg text-white px-4 -mt-32 " style="left:0;  right: 0;">
                        <div class="text-right text-lg ">
                            <p class="">
                                {{ event.day }}
                            </p>

                            <p class="text-3xl text-red-600 ">
                                <strong>
                                    {{ event.time }}
                                </strong>
                            </p>
                        </div>




                        <div class="flex justify-between mt-6  ">
                            <div class="flex">
                                <img
                                    :src="pin"
                                    class="avatar  avatar w-6 h-6 mt-1"
                                    alt="default"
                                />

                                <p class="text-center text-sm mt-2 ml-2">
                                    {{ event.location }}
                                </p>
                            </div>


                        </div>
                    </figcaption>

                    <div>
                        <h3 class=" text-3xl text-center mt-6  "
                            style="font-family: 'Poppins', sans-serif;">
                            {{ event.title }}
                        </h3>
                    </div>

                    <div class=" text-center text-sm   ">
                        <div v-if="event.invites.length === 0" class="">
                        </div>
                        <div v-else-if="event.invites.length === 1">
                            {{ event.invites.length }} person is coming
                        </div>
                        <div v-else>
                            {{ event.invites.length }} people are coming
                        </div>
                    </div>

                    <div>
                        <!--                            <p class=" text-center  ">-->
                        <!--                                &lt;!&ndash;                                {{ shortText }}&ndash;&gt;-->
                        <!--                                organized by {{ party.user.username }}-->

                        <!--                            </p>-->

                    </div>


                </div>
            </div>
        </inertia-link>
    </div>
</template>

<script>


import {InertiaLink} from "@inertiajs/inertia-vue3";
import pin from "/img/Posts/pin.png";
import eventCover from "/img/Party/eventCover.jpg";

export default {
    name: "Event",
    props: {
        event: Object,
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
            eventCover: eventCover,
            description: this.event.description,
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
