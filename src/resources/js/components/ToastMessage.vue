<template>
    <div>
      <button v-on:click="doClick">Show!</button>
      <!-- {{ session('flash_message') }} -->
    </div>
</template>
  
<script>    
  export default {
    el: '#app',
    data: {
      isActive: true,
    },
    props: {},
    mounted: function () {
        this.isActive = true
        //マウント後1.2秒経ったらeraseMessageを呼ぶ
        setTimeout(this.eraseMessage, 1200)
    },
    methods: {
      //フラッシュメッセージを見えなくする
      eraseMessage: function(){
          this.isActive = false
      },
      // doClick:function(){
      //   this.$toasted.success("投稿に成功しました！", { 
      //     theme: "bubble", 
      //     position: "bottom-center", 
      //     duration : 5000
      //   });
      // },
    },
  }
</script>