import './bootstrap'
import Vue from 'vue'
// Toastをインポート
import Toasted from 'vue-toasted'

import RecipeLike from './components/RecipeLike'
import RecipeComment from './components/RecipeComment'
import RecipeTagsInput from './components/RecipeTagsInput'
import FollowButton from './components/FollowButton'
import FileUpload from './components/FileUpload'
import ImagePreview from './components/ImagePreview'
import ImageEditPreview from './components/ImageEditPreview'
import ToastMessage from './components/ToastMessage'
import VuePureLightbox from 'vue-pure-lightbox'
import styles from 'vue-pure-lightbox/dist/VuePureLightbox.css'
import ImgInputer from 'vue-img-inputer'
import 'vue-img-inputer/dist/index.css'

// Toastを使えるようにする
// Vue.use(Toasted, {
//   position: 'top-center',
//   duration: 3000,
//   fullWidth: true,  
//   type: 'success'  
// })

//Vue-infinite-loadingを使用する
// Vue.use(InfiniteLoading);

Vue.use(Toasted);

const app = new Vue({
  el: '#app',
  data: {
  //   // 文字数カウントできるようになったけどなんか微妙…
    commentCount: "",
    // recipeContentCount: "",
    // recipeTitleCount: "",
    // recipeIngredientCount: "",
    // recipeSeasoningCount: "",
    // recipeStep1Count: "",
    // recipeStep2Count: "",
    // recipeStep3Count: "",
    // recipeStep4Count: "",
    // recipeStep5Count: "",
    // recipeStep6Count:"",
    file: "",
  },
  methods: {
  },
  components: {
    RecipeLike,
    RecipeComment,
    RecipeTagsInput,
    FollowButton,
    FileUpload,
    ImagePreview,
    ImageEditPreview,
    ToastMessage,
    'vue-pure-lightbox': VuePureLightbox,
    'img-inputer': ImgInputer,
  },
});
