import './bootstrap'
import Vue from 'vue'

import RecipeLike from './components/RecipeLike'
import RecipeTagsInput from './components/RecipeTagsInput'
import FollowButton from './components/FollowButton'
import FileUpload from './components/FileUpload'
import ImagePreview from './components/ImagePreview'
import VuePureLightbox from 'vue-pure-lightbox'
import styles from 'vue-pure-lightbox/dist/VuePureLightbox.css'



//Vue-infinite-loadingを使用する
// Vue.use(InfiniteLoading);


const app = new Vue({
  el: '#app',
  data: {
  //   // 文字数カウントできるようになったけどなんか微妙…
    commentCount: "",
  },
  components: {
    RecipeLike,
    RecipeTagsInput,
    FollowButton,
    FileUpload,
    ImagePreview,
    'vue-pure-lightbox': VuePureLightbox,
  }

});