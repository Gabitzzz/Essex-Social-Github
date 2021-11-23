<template>
    <div>
        <input type="file" accept="image/*" class="hidden" ref="file" @change="change">
        <div class="relative inline-block">
            <img :src="src" alt="" class="w-24 h-24 rounded-full object-cover">
            <div
                class="absolute top-0 h-full w-full bg-black bg-opacity-25 rounded-full flex items-center justify-center">
                <button type="button" @click="browse"
                        class="rounded-full hover:bg-opacity-25 p-2 focus:outline-none transition duration-200 text-white">
                    Browse
                </button>
                <button v-if="value" type="button" @click="remove"
                        class="rounded-full hover:bg-opacity-25 p-2 focus:outline-none transition duration-200 text-white">
                    X
                </button>

            </div>


        </div>
    </div>
</template>

<script>
export default {
    name: "AvatarInput",
    props: {
        value: File,
        defaultSrc: String,
    },
    data() {
        return {
            src: this.defaultSrc,
            file: null,

        }
    },

    methods: {
        browse() {
            this.$refs.file.click();
        },
        remove() {
            this.file = null;
            this.src = null;
            this.$emit('')
        },
        change(e) {
            this.file = e.target.files[0];
            this.$emit('input', this.file)
            let reader = new FileReader();
            reader.readAsDataURL(this.file);
            reader.onload = (e) => {
                this.src = e.target.result;
            }
        }
    },

}
</script>

<style scoped>

</style>
