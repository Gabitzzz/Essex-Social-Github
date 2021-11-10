<template>
    <input class="login-field focus:border-indigo-300 focus:ring focus:ring-gray-200 focus:ring-opacity-50 rounded-md shadow-sm text-black" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input">
</template>

<script>
export default {
    props: ['modelValue'],

    emits: ['update:modelValue'],

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>
<style scoped>
.login-field {
    border: 1px solid #EBEBEB;
    border-radius: 20px;
    color: black;
    /*filter: blur(2px);*/
}
</style>
