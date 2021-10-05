import './bootstrap'
import Vue from 'vue'
import RecipeLike from './components/RecipeLike'
import RecipeTagsInput from './components/RecipeTagsInput'
import FollowButton from './components/FollowButton'
import FileUpload from './components/FileUpload'

const app = new Vue({
  el: '#app',
  components: {
    RecipeLike,
    RecipeTagsInput,
    FollowButton,
    FileUpload,
  }
})