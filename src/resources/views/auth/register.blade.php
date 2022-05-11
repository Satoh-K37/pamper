@extends('app')
@section('title', 'ユーザー登録')
@include('nav')
@section('content')
<div class="width-max container-fluid text-lg-left mw-100 p-0">
  <!--Section: Content-->
  <section class="mydark-grey-text mw-100">

    <!--Grid row-->
    <div class="row d-flex no-gutters justify-content-center width-max">
      <!--Grid column-->
      <div class="col-lg-6 w-auto bordered">

        <!--Image-->
        @if(app()->isLocal() || app()->runningUnitTests())
          <div class="view overlay mw-100">
            <img src="/storage/logo.png" class="img-fluid h-100">
            <a>
              <div class="mask rgba-white-light"></div>
            </a>
          </div>
        @else
          <div class="view overlay mw-100">
            <img src='{{ Storage::disk('s3')->url("logo.png")}}' class="img-fluid h-100">
            <a>
              <div class="mask rgba-white-light"></div>
            </a>
          </div>
        @endif

      </div>
      <!--Grid column-->
      <!--Grid column-->
      <div class="col-lg-6 mt-5 px-3 w-auto bordered">
        <!-- <img src="/storage/logo_transparent.png" class="img-fluid mb-2"> -->
        <h2 class="font-weight-bold">あなたを甘やかす、<p>ご褒美ごはんをここでみつけよう。</p></h2>

        <div class="container mt-5">
          <div class="mx-auto">
            <h4 class="text-muted">SPOILYをはじめよう</h4>
            <!-- <h1 class="text-center"><a class="text-dark" href="/">SPOILY</a></h1> -->
            <div class="mt-3">
              <div class="text-center">
                <!-- <h2 class="h3 card-title text-center mt-2">ユーザー登録</h2> -->
                <!-- エラーメッセージを表示させる -->
                @include('error_card_list')
                <!-- 成功時にメッセージを表示させる -->
                @include('flash_message')

                <div class="card-text">
                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="md-form">
                      <label for="name">ユーザー名</label>
                      <input class="form-control" type="text" id="name" name="name" required value="{{ old('name') }}">
                      <!-- <small>英数字3〜16文字(登録後の変更はできません)</small> -->
                    </div>
                    <div class="md-form">
                      <label for="email">メールアドレス</label>
                      <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}" >
                    </div>
                    <div class="md-form">
                      <label for="password">パスワード</label>
                      <input class="form-control" type="password" id="password" name="password" required>
                    </div>
                    <div class="md-form">
                      <label for="password_confirmation">パスワード(確認)</label>
                      <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <button class="btn btn-block blue-gradient my-1" type="submit">ユーザー登録</button>
                  </form>
                  <a href="{{ route('login.{provider}', ['provider' => 'google']) }}" class="btn btn-block btn-danger my-1">
                    <i class="fab fa-google mr-1"></i>Googleで登録
                  </a>

                  <div class="my-3">
                    <a href="{{ route('login') }}" class="card-text">ログインはこちら</a>
                  </div>              
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!--Grid column-->


    </div>
    <!--Grid row-->


  </section>
  <!--Section: Content-->


</div>

@endsection
