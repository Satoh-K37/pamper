@extends('app')

@section('title', 'ログイン')
@include('nav')
@section('content')
  <div class="container my-5">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <h1 class="text-center"><a class="text-dark" href="/">SPOILY</a></h1>
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">ログイン</h2>

            <!-- <a href="{{ route('login.{provider}', ['provider' => 'google']) }}" class="btn btn-block btn-danger">
              <i class="fab fa-google mr-1"></i>Googleでログイン
            </a> -->
            
            @include('error_card_list')
            @include('flash_message')
            
            <div class="card-text">
              <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="md-form">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}">
                </div>

                <div class="md-form">
                  <label for="password">パスワード</label>
                  <input class="form-control" type="password" id="password" name="password" required>
                </div>
                
                <input type="hidden" name="remember" id="remember" value="on">

                <div class="text-right my-2">
                  <a href="{{ route('password.request') }}" class="card-text">パスワードを忘れた方はこちら</a>
                </div>

                <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">ログイン</button>

                <a href="{{ route('login.{provider}', ['provider' => 'google']) }}" class="btn btn-block btn-danger mt-2 mb-2">
                  <i class="fab fa-google mr-1"></i>Googleでログイン
                </a>
                
                <a href="{{ route('login.guest') }}" class="btn btn-block peach-gradient mt-2 mb-2">
                  ゲストログイン
                </a>
                <!-- </button> -->
                


              </form>

              <div class="my-2">
                <a href="{{ route('register') }}" class="card-text">ユーザー登録はこちら</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
  