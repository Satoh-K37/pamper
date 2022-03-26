<template>
    <div>
      <button v-on:click="doClick">Show!</button>
      <!-- {{ session('flash_message') }} -->
    </div>
</template>
  
<script>    
  export default {
    methods: {
      doClick:function(){
        this.$toasted.success("投稿に成功しました！", { 
          theme: "bubble", 
          position: "bottom-center", 
          duration : 5000
        });
      },
    },
  }
</script>