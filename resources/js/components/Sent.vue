<template>
  <form @submit.prevent.keyup="sent">
    <div class="input-group">
      <input type="text" class="form-control" v-model="message.message">
      <span class="input-group-append">
        <button type="submit" class=" btn btn-primary">Enviar mensaje</button>
      </span>
    </div>
  </form>
</template>

<script>
    export default {
        props:['user'],
        data() {
            return {
                message: {
                    message: '',
                    user: this.user            
                }
            }
        },
        methods: {
            sent () {
                this.$emit('messagesent', this.message)
                this.message = {}
            }
        }
    }
</script>