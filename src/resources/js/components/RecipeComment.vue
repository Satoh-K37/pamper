<template>
  <div>
    <button
      type="button"
      class="btn m-0 p-1 shadow-none"
    >
      <i class="far fa-comment mr-1 my-1"/>
    </button>
    {{ countComments }}
  </div>
</template>

<script>
  export default {
    props: {
      initialCountComments: {
        type: Number,
        default: 0,
      },
      initialRecipeContentCount: {
        type: Number,
        default: 0,
      },
      initialRecipeTitleCount: {
        type: Number,
        default: 0,
      },
    },
    data() {
      return {
        countComments: this.initialCountComments,
        recipeContentCount: this.initialRecipeContentCount,
        recipeTitleCount: this.initialRecipeTitleCount,
      }
    },
  }
</script>
