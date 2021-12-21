@extends('app')

@section('title', $user->name . 'のいいねしたレシピ')

@section('content')
  @include('nav')
  <div class="container">
    
    @include('users.user')
    @include('users.tabs', ['hasRecipes' => true, 'hasLikes' => false])
      @foreach($recipes as $recipe)
        @include('recipes.card')
      @endforeach

    <div class="container">
      {{ $recipes->links() }}
    </div>
  </div>
@endsection
