@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  <div class="container">
      @if (session('status'))
        <div class="card-text alert alert-success">
          {{ session('status') }}
        </div>
      @endif
    @include('users.user')
    {{ $recipes->count() }}件

    @include('users.tabs', ['hasRecipes' => true, 'hasLikes' => false])
      @foreach($recipes as $recipe)
        @include('recipes.card')
      @endforeach
      <div class="container">
        {{ $recipes->links() }}
      </div>

  </div>
@endsection
