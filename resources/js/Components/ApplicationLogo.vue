<template>
    <img :src="image" class="w-40 h-40"/>
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
