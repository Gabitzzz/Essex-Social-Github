<template>
    <img :src="image" class="w-40 h-40 transform transition-all animate-pulse transition ease-in-out delay-150  hover:-translate-y-1 hover:scale-150  duration-300"/>
</template>

<script>
import image from "/img/logo/5.png"

export default {
    data(){
        return {
            image: image
        }
    }
}
</script>
