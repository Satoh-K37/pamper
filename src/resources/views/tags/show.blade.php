@extends('app')

@section('title', $tag->hashtag)

@section('content')
  <div class="container">
    <div class="d-flex my-box-light justify-content-end mr-1 my-3">
      @include('recipes.search')
    </div>
    <div class="card mt-3">
      <div class="card-body">
        <h2 class="h4 card-title m-0">{{ $tag->hashtag }}</h2>
        <div class="card-text text-right">
          {{ $tag->recipes->count() }}件
        </div>
      </div>
    </div>
    <div class="d-flex my-box-light flex-wrap my-2">
      @foreach($tag->recipes as $recipe)
        @include('recipes.index_card')
      @endforeach
    </div>
  </div>
@endsection
