<template>
  <div>
    <button
      type="button"
      class="btn m-0 p-1 shadow-none"
    >
      <i class="fas fa-heart mr-1"
        :class="{'red-text':this.isLikedBy, 'animated heartBeat fast':this.gotToLike}"
        @click="clickLike"
      />
    </button>
    {{ countLikes }}
  </div>
</template>

<script>
  export default {
    props: {
      initialIsLikedBy: {
        type: Boolean,
        default: false,
      },
      initialCountLikes: {
        type: Number,
        default: 0,
      },
      authorized: {
        type: Boolean,
        default: false,
      },
      endpoint: {
        type: String,
      },
    },
    data() {
      return {
        // :class="{'red-text':this.isLikedBy}" のisLikedByにthis.initialIsLikedByの値をセットする
        isLikedBy: this.initialIsLikedBy,
        countLikes: this.initialCountLikes,
        gotToLike: false,
      }
    },
    methods: {
      // ユーザーが未ログインの場合は警告を出し、早期returnでメソッドを終了させる
      clickLike() {
        if (!this.authorized) {
          alert('いいね機能はログイン中のみ使用できます')
          return
        }
        // データisLikedByを使って現在いいね済みであるかどうかを三項演算子で判定し、
        // いいね済みであればunlikeメソッド、いいねしていなければlikeメソッドを実行する
        this.isLikedBy
          ? this.unlike()
          : this.like()
      },
      async like() {
        const response = await axios.put(this.endpoint)

        this.isLikedBy = true
        this.countLikes = response.data.countLikes
        this.gotToLike = true
      },

      async unlike() {
        const response = await axios.delete(this.endpoint)

        this.isLikedBy = false
        this.countLikes = response.data.countLikes
        this.gotToLike = false
      },
    },
  }
</script>
