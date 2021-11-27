import './bootstrap'
import Vue from 'vue'

import RecipeLike from './components/RecipeLike'
import RecipeTagsInput from './components/RecipeTagsInput'
import FollowButton from './components/FollowButton'
import FileUpload from './components/FileUpload'
import ImagePreview from './components/ImagePreview'


const app = new Vue({
  el: '#app',
  data: {
    commentCount: "",
  },
  components: {
    RecipeLike,
    RecipeTagsInput,
    FollowButton,
    FileUpload,
    ImagePreview,
  }

});