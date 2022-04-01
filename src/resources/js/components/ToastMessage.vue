<template>
  <div>

    <!-- v-ifで<script>内のshowがtrueであれば表示する -->
    <div
      class="flash"
      v-if="show === true"
    >
      this is flash message!
    </div>

    <!-- clickしたらmethods:{}内のshowFlashが発火する -->
    <button
      @click="showFlash"
    >
      show flash message
    </button>
  </div>
</template>

<script>
  export default {
//...略
    methods: {
      showFlash(){
        this.show = true;
      // setTimeoutで3000ms後にshowをfalseにする
        setTimeout(() => {
          this.show = false}
          ,3000
        )
      }
    }
  }
</script>