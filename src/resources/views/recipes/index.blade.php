<!-- app.blade.phpをベースとして使うことを宣言 -->
@extends('app')

@section('title', '記事一覧')

@section('content')
  @include('nav')
  <div class="container">
  @foreach($recipes as $recipe) 
    @include('recipes.card')
  @endforeach
  </div>
@endsection
