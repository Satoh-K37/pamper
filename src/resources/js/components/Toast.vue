<template>
    <div>
        <h1>vue-toasted</h1>  
        <b-button variant="outline-success" v-on:click="showToast()">Notificationを表示</b-button>    
    </div>
    
</template>
  
<script>    
  export default {
    methods: {
      showToast(){
          this.$toasted.show('Hello Notification')
      }
    }
  }
</script>