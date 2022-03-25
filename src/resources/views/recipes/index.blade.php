<!-- app.blade.phpをベースとして使うことを宣言 -->
@extends('app')

@section('title', 'レシピ一覧')

@section('content')
  @include('nav')
  
    @include('error_card_list')
    @include('flash_message')
    
    @auth
      <div class="d-flex my-box-light justify-content-end mr-3">
        @include('recipes.search')
      </div>
    @endauth
    
    <div id="app">
      <toast-message></toast-message>
    </div>
    <div class="d-flex my-box-light flex-wrap my-3">
      @foreach($recipes as $recipe)
        @include('recipes.index_card')
      @endforeach
    </div>
    <nav class="my-4" aria-label="...">
      <ul class="pagination pagination-circle justify-content-center">
        <li class="page-item">
          {{ $recipes->links() }}
        </li>
      </ul>
    </nav>

    <!-- <div class="contents">
        <div v-for="recipe in recipes" :key="recipe.id">
            @{{ recipe.recipe }}
        </div>
        <infinite-loading @infinite="fetchRecipes"></infinite-loading>
        <InfiniteRecipe></InfiniteRecipe>
    </div> -->
@endsection



