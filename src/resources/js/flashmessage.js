const app = new Vue({
  el: '#app',
  data: {
      isActive: true
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
      }
  }
});