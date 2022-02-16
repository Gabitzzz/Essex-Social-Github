<template>

  <div class=" mb-4 grid grid-cols-3 gap-4 content-center ...">
    <div class="bg-white rounded-2xl hover:bg-gray-300">
      <a :href="route('posts.create', $page.props.auth.user.username )"
         class="w-full justify-center inline-block text-center pt-2 pb-1"
      >
        <img :src="post" width="40" height="40" class="inline-block" alt="plus">
      </a>
    </div>
    <div class="bg-white rounded-2xl hover:bg-gray-300">

      <a :href="route('party.show')"
         class="w-full  justify-center inline-block text-center pt-2 pb-1"
      >
        <img :src="partylogo" width="40" height="40" class="inline-block" alt="plus">
      </a>
    </div>

    <div class="bg-white rounded-2xl hover:bg-gray-300">
      <a :href="route('event.show')"
         class="w-full justify-center inline-block text-center pt-2 pb-1"
      >
        <img :src="eventlogo" width="40" height="40" class="inline-block" alt="plus">
      </a>
    </div>
  </div>

</template>

<script>
import post from "/img/Posts/post.png";
import party from "/img/Posts/party.png";
import event from "/img/Posts/event.png";
import eventlogo from "/img/Tab/eventlogo.png";
import partylogo from "/img/Tab/partypeople.png";



export default {
  name: "AddTab",
  data() {
    return {
      post: post,
      party: party,
      event: event,
      eventlogo: eventlogo,
      partylogo: partylogo,
    }
  }
}
</script>

<style scoped>

</style>
