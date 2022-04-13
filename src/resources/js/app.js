/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


import './bootstrap'
import './scroll.js'

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
import InfiniteLoading from 'vue-infinite-loading'

//Vue-infinite-loadingを使用する
Vue.use(InfiniteLoading);

const app = new Vue({
  el: '#app',
  data: {
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
    // recipeStep6Count: "",
    // cookingPointCount: "",
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
    'vue-pure-lightbox': VuePureLightbox,
    'img-inputer': ImgInputer,
    'vue-infinite-loading': InfiniteLoading,
  },
});

