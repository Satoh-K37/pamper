import './bootstrap'
import Vue from 'vue'
import RecipeLike from './components/RecipeLike'
import RecipeTagsInput from './components/RecipeTagsInput'
import FollowButton from './components/FollowButton'
import FileUpload from './components/FileUpload'
import ImagePreviewComponent from './components/ImagePreviewComponent'


const app = new Vue({
  el: '#app',
  data: {
    // 文字数カウントできるようになったけどなんか微妙…
    contentCount: "",
    ingredientCount: "",
    seasoningCount: "",
    step1Count: "",
    step2Count: "",
    step3Count: "",
    step4Count: "",
    step5Count: "",
    step6Count: "",
    cookingpointCount: "",
    commentCount: "",
  },
  components: {
    RecipeLike,
    RecipeTagsInput,
    FollowButton,
    FileUpload,
    ImagePreviewComponent,
  }
});