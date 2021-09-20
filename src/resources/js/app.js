import './bootstrap'
import Vue from 'vue'
import RecipeLike from './components/RecipeLike'
import RecipeTagsInput from './components/RecipeTagsInput'


const app = new Vue({
  el: '#app',
  components: {
    RecipeLike,
    RecipeTagsInput,
  }
})