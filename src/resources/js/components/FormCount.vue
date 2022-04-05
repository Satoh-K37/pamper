<template>
  <div class='md-form'>
    <label>レシピタイトル<span id="must-icon">必須</span></label>
    <input type="text" name="recipe_title"  maxlength="50" class="form-control"  v-model="recipeTitleCount">
    <p class="text-right">{{ recipeTitleCount.length }}/50</p>
  </div>
</template>

<script>
  export default {
    props: {
      initialRecipeTitleCount: {
        type: String,
        default: "",
      },
      initialRecipeContentCount: {
        type: String,
        default: "",
      },
      initialRecipeIngredientCount: {
        type: String,
        default: "",
      },
      initialRecipeIngredientCount: {
        type: String,
        default: "",
      },
      initialRecipeSeasoningCount: {
        type: String,
        default: "",
      },
      initialRecipeStep1Count: {
        type: String,
        default: "",
      },
      initialRecipeStep2Count: {
        type: String,
        default: "",
      },
      initialRecipeStep3Count: {
        type: String,
        default: "",
      },
      initialRecipeStep4Count: {
        type: String,
        default: "",
      },
      initialRecipeStep5Count: {
        type: String,
        default: "",
      },
      initialRecipeStep6Count: {
        type: String,
        default: "",
      },
      initialCookingPointCount: {
        type: String,
        default: "",
      },
    },
    data() {
      return {
        recipeTitleCount: this.initialRecipeTitleCount,
        recipeContentCount: this.initialRecipeContentCount,
        recipeIngredientCount: this.initialRecipeIngredientCount,
        recipeSeasoningCount: this.initialRecipeSeasoningCount,
        recipeStep1Count: this.initialRecipeStep1Count,
        recipeStep2Count: this.initialRecipeStep2Count,
        recipeStep3Count: this.initialRecipeStep3Count,
        recipeStep4Count: this.initialRecipeStep4Count,
        recipeStep5Count: this.initialRecipeStep5Count,
        recipeStep6Count: this.initialRecipeStep6Count,
        cookingPointCount: this.initialCookingPointCount
      }
    },
  }
</script>
