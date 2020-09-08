<template>

  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="direct-chat-msg" v-for="message in messages">
          <div class="direct-chat-infos clearfix">
            <span class="direct-chat-name float-left">{{ message.user.name }}</span>
          </div>
          <img class="direct-chat-img" src="img/user1-128x128.jpg" alt="message user image">
          <div class="direct-chat-text">
            {{ message.message }}
          </div>
          
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["messages"],
  mounted() {
    console.log(this.messages);
  }
};
</script>
<style scoped>
.panel {
  margin-bottom: 0;
}
</style>