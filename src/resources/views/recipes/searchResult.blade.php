<!-- 検索結果の表示画面 -->
@extends('app')

@section('title')

@section('content')
  @include('nav')
  <div class="container">
    @include('recipes.search')
    <h2 class="h4 card-title m-0">検索結果</h2>
    <!-- 何件とか表示させるようにさせたい -->
    @foreach($result_recipes as $recipe)
      @include('recipes.card')
    @endforeach
  </div>
@endsection

    <!-- <div class="container">
        <div class="card mt-3">
          <div class="card-body">
            <h2 class="h4 card-title m-0">検索結果</h2>
            <div class="card-text text-right">
              {{ $recipe->count() }}件
            </div>
          </div>
        </div>
    </div> -->