<!-- app.blade.phpをベースとして使うことを宣言 -->
@extends('app')

@section('title', 'レシピ一覧')

@section('content')
  @include('nav')
  <div class="container">
    @include('error_card_list')
    @include('recipes.search')
    @foreach($recipes as $recipe) 
      @include('recipes.card')
    @endforeach
    <div class="container">
      {{ $recipes->links() }}
    </div>
  </div>
    <!-- <div class="contents">
        <div v-for="recipe in recipes" :key="recipe.id">
            @{{ recipe.recipe }}
        </div>
        <infinite-loading @infinite="fetchRecipes"></infinite-loading>
        <InfiniteRecipe></InfiniteRecipe>
    </div> -->
@endsection



