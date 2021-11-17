import './bootstrap'
import Vue from 'vue'
import RecipeLike from './components/RecipeLike'
import RecipeTagsInput from './components/RecipeTagsInput'
import FollowButton from './components/FollowButton'
import FileUpload from './components/FileUpload'
import ImagePreview from './components/ImagePreview'


const app = new Vue({
  el: '#app',
  // data: {
  //   // 文字数カウントできるようになったけどなんか微妙…
  //   commentCount: "",
  //   // 以下はバリデーションで対応。文字数カウントはしない。
  //   contentCount: "",
  //   // ingredientCount: "",
  //   // seasoningCount: "",
  //   // step1Count: "",
  //   // step2Count: "",
  //   // step3Count: "",
  //   // step4Count: "",
  //   // step5Count: "",
  //   // step6Count: "",
  //   // cookingpointCount: "",
    
  // },
  components: {
    RecipeLike,
    RecipeTagsInput,
    FollowButton,
    FileUpload,
    ImagePreview,
  }

});