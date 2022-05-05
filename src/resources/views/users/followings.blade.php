@extends('app')

@section('title', $user->name . 'のフォロー中')

@section('content')
  @include('nav')
  <div class="container">
    <div class="container mt-3">
      <div class="row">
        <div class="col-md-8 col-lg-12 mx-auto">
          <!-- Card -->
          <div class="card testimonial-card">
            <!-- Background color -->
            <div class="card-up p-3 white-text" style="background: #fca326">
              <a href="{{ route('users.show', ['name' => $user->name]) }}" class="white-text">
                <i class="fas fa-arrow-left"></i>
              </a>
              <a class="font-weight-normal ml-3">{{ $user->name }}</a>
            </div>
            @include('users.follow_tabs',['hasFollowers' => false, 'hasFollowings' => true ])
            @foreach($followings as $person)
              @include('users.person')
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
