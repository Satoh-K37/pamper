<!-- app.blade.phpをベースとして使うことを宣言 -->
@extends('app')

@section('title', 'レシピ一覧')

@section('content')
  @include('nav')
  <div class="container">
  @include('recipes.search')
  @foreach($recipes as $recipe) 
    @include('recipes.card')
  @endforeach
  </div>
@endsection
