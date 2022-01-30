<template>
    <div>

<!--       -->


        <div class="mx-2 mb-4 shadows-lg  ">
                    <div class="rounded-lg shadow-md border-gray-200" style="position: relative;">

                    <!--                <img class="" src="https://images.unsplash.com/photo-1570169797118-99f5f90c4e25?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80">-->


                        <img :src="showImage() + party.partyImg"
                             class="object-cover rounded-lg w-full" alt="cover"
                             style="max-height: 200px;  filter: brightness(40%);">



                    <figcaption class="absolute text-lg text-white px-4 -mt-40 " style="left:0;  right: 0;">
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

                            <p class="text-center">
                                {{ party.date }}
                            </p>

                            <div class="flex justify-center mt-4">
                                <inertia-link v-if="!$page.props.followToggle"
                                              as="button"
                                              class="follow button shadow-2xl  items-center px-3 py-1 bg-white border border-transparent rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-green-700 hover:text-white w-40 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                                              style="font-size: 80%;"

                                              preserve-scroll
                                              method="POST">
                                    Join
                                </inertia-link>

                                <inertia-link v-if="$page.props.followToggle"
                                              as="button"
                                              @mouseover="showUnfollow = true"
                                              @mouseleave="showUnfollow = false"
                                              class="follow button shadow-2xl  items-center px-3 py-1 bg-white border border-transparent
                                                        rounded-full font-light text-xs text-black uppercase tracking-widest hover:bg-red-600 hover:text-white
                                                        active:bg-green-700 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray
                                                        transition ease-in-out duration-150 w-40"
                                              style="font-size: 80%;"
                                              preserve-scroll
                                              method="DELETE">
                                    {{ showUnfollow ? 'Cancel' : '✓ Joining' }}
                                </inertia-link>
                            </div>
                        </div>
                    </figcaption>
                </div>

        </div>
    </div>

</template>

<script>


import {InertiaLink} from "@inertiajs/inertia-vue3";


export default {
    name: "Party",
    props: {
        party: Object,
    },
    components: {
        InertiaLink,
    },

    methods: {
        showImage() {
            return "/storage/";
        },
    }

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
    filter: brightness(50%);
}
</style>
