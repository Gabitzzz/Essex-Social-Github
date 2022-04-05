<template>
  <div>


    <div v-for="like in post.likes">

      <div v-show="like.id === $page.props.auth.user.id">
        <div>
          <inertia-link
              preserve-scroll
              method="POST"
              v-show="show"
              as="button"
              @click="changeState"
              :href="route('likes.toggle', post.id)"
              class="h-6 w-6 rounded-full bg-green-700  text-white">
          </inertia-link>
        </div>
      </div>

      <div v-show="like.id !== $page.props.auth.user.id">
        <div>
          <inertia-link
              preserve-scroll
              method="POST"
              as="button"
              v-show="!show"
              @click="changeState"
              :href="route('likes.toggle', post.id)"
              class="h-6 w-6 rounded-full bg-green-500  text-white">
          </inertia-link>
        </div>
      </div>

<!--      <button @click="changeState" ref="btnToggle">Hide</button>-->
<!--      <div v-show="show">-->
<!--        <h1>1 to 2</h1>-->
<!--        <p v-for="i in 2">{{ i }}</p>-->
<!--      </div>-->

      <!--        <div>-->
      <!--          <div>-->
      <!--            <inertia-link-->
      <!--                preserve-scroll-->
      <!--                method="POST"-->
      <!--                as="button"-->
      <!--                :href="route('likes.toggle', post.id)"-->
      <!--                class="h-6 w-6 rounded-full bg-green-500 text-white">-->
      <!--            </inertia-link>-->
      <!--          </div>-->
      <!--        </div>-->

      <!--        {{ like.id }}  &nbsp;-->


    </div>

    <!--        <div v-for="like in post.likes">-->
    <!--            <div v-if="like.id === $page.props.auth.user.id">-->

    <!--            </div>-->

    <!--        </div>-->
  </div>
</template>

<script>
import {InertiaLink} from "@inertiajs/inertia-vue3";

export default {
  name: "Like",
  data() {
    return {
      show: false,
    }
  },
  props: {
    post: Object,
    likes: Array,
    toggler: Boolean,

  },
  components: {
    InertiaLink,
  },
  methods: {
    changeState: function () {
      this.show = !this.show;
      // this.$refs.btnToggle = this.show ? 'Hide' : 'Show';

    }
  },

}
</script>

<style scoped>

</style>
