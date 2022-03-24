<template lang="pug">
div.flex.items-center.justify-center.h-screen(@click="sayHello") クリック
</template>
<script>
export default {
  created() {
  },
  computed: {
  },
  props: {
  },
  data() {
    return {
    }
  },
  methods: {
    sayHello:function(){
      this.$toasted.success('hello!');
    }
  }
}
</script>
<style lang='sass' scoped>


</style>
