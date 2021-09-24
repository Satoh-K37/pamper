@extends('app')

@section('title', 'レシピ詳細')

@section('content')
  @include('nav')

  <div class="container">
    @include('recipes.card')
  </div>
@endsection
