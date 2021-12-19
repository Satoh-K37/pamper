<template>
    <div>
      <!-- ref属性を指定することでファイル情報を動的に取得できる -->
      <div>
        <input required type="file" name="image_path" ref="preview" v-on:change="show">
      </div>

      <!-- 一時URLが生成されている場合のみアップロードされた画像を表示する -->
      <div class="preview-box" v-if="url">
          <img class="image-preview img-fluid" v-bind:src="url" width="860" height="532">
      </div>
    </div>


</template>

<script>

export default {
    data() {
        return {
            url:"",
        }
    },
    methods: {
        show() {
            // $refsでinputに添付されたファイル情報を取得する。
            const file = this.$refs.preview.files[0];
            // 引数で指定したオブジェクトの一時的なURLを生成し、一時的に画像を表示させる
            this.url = URL.createObjectURL(file);
        },
    }
}
</script>