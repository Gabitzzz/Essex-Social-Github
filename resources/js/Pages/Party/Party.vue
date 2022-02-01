<template>
    <div>
        <inertia-link preserve-scroll
                      :href="route('party.item', party)"
        >

<!--       -->


        <div class="mx-2 mb-4 shadows-lg  ">
                    <div class="rounded-lg shadow-md border-gray-200" style="position: relative;">

                    <!--                <img class="" src="https://images.unsplash.com/photo-1570169797118-99f5f90c4e25?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80">-->


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
                            <h1 class="text-center">
                                {{ party.body }}
                            </h1>








                        </div>
                    </figcaption>
                </div>

        </div>
        </inertia-link>
    </div>

</template>

<script>


import {InertiaLink} from "@inertiajs/inertia-vue3";


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
    data(){
        return{
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
body{
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
