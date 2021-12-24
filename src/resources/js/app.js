import './bootstrap'
import Vue from 'vue'

import RecipeLike from './components/RecipeLike'
import RecipeComment from './components/RecipeComment'
import RecipeTagsInput from './components/RecipeTagsInput'
import FollowButton from './components/FollowButton'
import FileUpload from './components/FileUpload'
import ImagePreview from './components/ImagePreview'
import ImageEditPreview from './components/ImageEditPreview'
import VuePureLightbox from 'vue-pure-lightbox'
import styles from 'vue-pure-lightbox/dist/VuePureLightbox.css'
import ImgInputer from 'vue-img-inputer'
import 'vue-img-inputer/dist/index.css'


//Vue-infinite-loadingを使用する
// Vue.use(InfiniteLoading);
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
  components: {
    RecipeLike,
    RecipeComment,
    RecipeTagsInput,
    FollowButton,
    FileUpload,
    ImagePreview,
    ImageEditPreview,
    'vue-pure-lightbox': VuePureLightbox,
    'img-inputer': ImgInputer,
  }
});