<template>
    <div>
        <inertia-link preserve-scroll
                      :href="route('event.item', event)"
        >
            <div class="mx-2 mb-4 shadows-lg  ">
                <div class="rounded-lg shadow-md border-gray-200" style="position: relative;">

                    <img v-if="event.eventImg"
                         :src="showImage() + event.eventImg"
                         class="object-cover rounded-lg w-full" alt="cover"
                         style="max-height: 250px;  filter: brightness(30%);">
                    <img v-else
                         class="object-cover rounded-lg w-full" alt="cover"
                         :src="eventCover"
                         style="max-height: 250px;  filter: brightness(30%);">


                    <figcaption class="absolute text-lg text-white px-4 -mt-56 " style="left:0;  right: 0;">
                        <div class="text-right text-lg ">
                            <p class="">
                                {{ event.date }}
                            </p>

                            <p class="text-3xl text-red-600 ">
                                <strong>
                                    {{ event.time }}
                                </strong>
                            </p>
                        </div>

                        <div>
                            <h3 class=" text-3xl text-center text-white "
                                style="font-family: 'Poppins', sans-serif;">
                                {{ event.title }}
                            </h3>
                        </div>

                        <div>
<!--                            <p class=" text-center  ">-->
<!--                                &lt;!&ndash;                                {{ shortText }}&ndash;&gt;-->
<!--                                organized by {{ party.user.username }}-->

<!--                            </p>-->

                            <div class=" text-center pb-12  ">
                                <!--                                {{ shortText }}-->
                                <div v-if="event.invites.length === 0" class="mb-7">
                                    <!--                                    {{party.invites.length}}-->

                                </div>
                                <div v-else-if="event.invites.length === 1">
                                    {{event.invites.length}} person is coming
                                </div>
                                <div v-else>
                                    {{event.invites.length}} people are coming
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div class="flex">
                                <img
                                    :src="pin"
                                    class="avatar  avatar w-6 h-6 mt-2  "
                                    alt="default"
                                />

                                <p class="text-center text-sm mt-2 ml-2">
                                    {{ event.location }}
                                </p>
                            </div>

                                                        <p class="text-sm mt-2">
                                                            organized by {{event.user.username}}
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
import eventCover from "/img/Party/partyCover.jpg";

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
