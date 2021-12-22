@extends('app')

@section('title', $user->name . 'のフォロワー')

@section('content')
  @include('nav')
  <div class="container">
    <div class="container mt-3">
      <div class="row">
        <div class="col-md-8 col-lg-12 mx-auto">
          <!-- Card -->
          <div class="card testimonial-card">
            <!-- Background color -->
            <div class="card-up warning-color-dark p-3 white-text">
              <a href="{{ route('users.show', ['name' => $user->name]) }}" class="white-text">
                <i class="fas fa-arrow-left"></i>
              </a>
              <a class="font-weight-normal ml-3">{{ $user->name }}</a>
            </div>
            @include('users.follow_tabs',['hasFollowers' => true, 'hasFollowings' => false])
            @foreach($followers as $person)
              @include('users.person')
            @endforeach
  </div>

@endsection
