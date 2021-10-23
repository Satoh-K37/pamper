<!-- 検索結果の表示画面 -->
@extends('app')

@section('title')

@section('content')
  @include('nav')
  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <h2 class="h4 card-title m-0">検索結果</h2>
        <div class="card-text text-right">
          {{ $recipe->count() }}件
        </div>
      </div>
    </div>
    @if (!empty($result_recipes))
      @foreach($result_recipes as $recipe) 
        @include('recipes.card')
      @endforeach
    @endif
  </div>
