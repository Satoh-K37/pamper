import './bootstrap'
import Vue from 'vue'
import RecipeLike from './components/RecipeLike'
import RecipeTagsInput from './components/RecipeTagsInput'
import FollowButton from './components/FollowButton'


const app = new Vue({
  el: '#app',
  components: {
    RecipeLike,
    RecipeTagsInput,
    FollowButton,
  }
})