@extends('app')

@section('title', $user->name)

@section('content')
  @include('nav')
  @include('error_card_list')
  @include('flash_message')
  <div class="container">
    @include('users.user')
    {{ $recipes->count() }}件

    @include('users.tabs', ['hasRecipes' => true, 'hasLikes' => false])
      @foreach($recipes as $recipe)
        @include('recipes.card')
      @endforeach
    <nav class="my-4" aria-label="...">
      <ul class="pagination pagination-circle justify-content-center">
        <li class="page-item">
          {{ $recipes->links() }}
        </li>
      </ul>
    </nav>

  </div>
@endsection
