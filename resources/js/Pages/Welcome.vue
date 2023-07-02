<template>
   <div>
       <Head title="Welcome"/>

       <div class="flex items-center justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
           <div>
               <div class="flex items-center justify-center">
                   <BreezeApplicationLogo/>
               </div>

               <div>
                   <div class="flex items-center mt-4">
                       <Link :href="route('register')" class="button px-8 py-2">
                           REGISTER
                       </Link>
                   </div>

                   <div class="flex items-center justify-center mt-4">
                       <Link :href="route('login')" class="button px-8 py-2">
                           LOG IN
                       </Link>
                   </div>
               </div>

               <!--            <div class=" text-center items-center justify-center mt-20">-->
               <!--                <p>-->
               <!--                    Version 1.0.0 - Capstone Project-->
               <!--                </p>-->
               <!--                <p>-->
               <!--                    Developed by <a href="https://gabilitcan.com/" class="font-semibold italic">Lițcan N. Gabriel</a>-->
               <!--                </p>-->
               <!--            </div>-->

               <div class=" text-center items-center justify-center mt-20">
                   <p>
                       Versiunea 1.0.0 - Lucrare de licență
                   </p>
                   <p>
                       Dezvoltat de <span class="font-bold">Joițoiu Robert-Cristian</span>
                   </p>
               </div>


           </div>
       </div>
   </div>
</template>

<style scoped>
/*.bg-gray-100 {*/
/*    background-color: #f7fafc;*/
/*    background-color: rgba(247, 250, 252, var(--tw-bg-opacity));*/
/*}*/

.border-gray-200 {
    border-color: #edf2f7;
    border-color: rgba(237, 242, 247, var(--tw-border-opacity));
}

.text-gray-400 {
    color: #cbd5e0;
    color: rgba(203, 213, 224, var(--tw-text-opacity));
}

.text-gray-500 {
    color: #a0aec0;
    color: rgba(160, 174, 192, var(--tw-text-opacity));
}

.text-gray-600 {
    color: #718096;
    color: rgba(113, 128, 150, var(--tw-text-opacity));
}

.text-gray-700 {
    color: #4a5568;
    color: rgba(74, 85, 104, var(--tw-text-opacity));
}

.text-gray-900 {
    color: #1a202c;
    color: rgba(26, 32, 44, var(--tw-text-opacity));
}

.button {
    border-radius: 25px;
    color: ghostwhite;
    background-color: black;
    width: 100%;
    display: inline;
    text-align: center;
    font-size: 12px;
}

.hero-text {
    text-align: center;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-gray-800 {
        background-color: #2d3748;
        background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
    }

    .dark\:bg-gray-900 {
        background-color: #1a202c;
        background-color: rgba(26, 32, 44, var(--tw-bg-opacity));
    }

    .dark\:border-gray-700 {
        border-color: #4a5568;
        border-color: rgba(74, 85, 104, var(--tw-border-opacity));
    }

    .dark\:text-white {
        color: #fff;
        color: rgba(255, 255, 255, var(--tw-text-opacity));
    }

    .dark\:text-gray-400 {
        color: #cbd5e0;
        color: rgba(203, 213, 224, var(--tw-text-opacity));
    }
}
</style>

<script>
import {Head, Link} from '@inertiajs/inertia-vue3'
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeButton from '@/Components/Button.vue'
import image from "/img/background/uni-1.jpeg"

export default {
    data() {
        return {
            image: image,
        }
    },
    components: {
        Head,
        Link,
        BreezeApplicationLogo,
        BreezeButton
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
}
</script>
