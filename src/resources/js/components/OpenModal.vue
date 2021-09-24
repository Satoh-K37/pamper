<template>
  <div class="">
    <h6>コメント</h6>
    <input type="text" v-model="text" class="px-2 py-2" placeholder="Type a Comment" />
    <button v-show="text != ''" @click.prevent="send()" type="button" class="btn btn-sm btn-primary">送信する</button>
  </div>
</template>

<script>
  export default {
  props: ['recipe_id'],
  data() {
    return {
      text: ''
    }
  },
  methods: {
    send() {
      const text = {
        comment: this.text
      }
      const id = this.recipe_id
      const array = ["/recipes/",id,"/comments"];
      const path = array.join('')
      this.text = ''
      axios.post(path, text).then(res => {
        this.$store.dispatch('comment/get_comments', id)
      }).catch(function(err) {
        console.log(err)
      })
    }
  }
  }
</script>
