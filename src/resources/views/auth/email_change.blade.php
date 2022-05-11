@extends('app')

@section('title', 'メールアドレス変更')

@section('content')
@include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <!-- <h1 class="text-center"><a class="text-dark" href="/">メールアドレスの変更</a></h1> -->
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">メールアドレス変更</h2>

            @include('error_card_list')
            @include('flash_message')

            <div class="card-text">
              <form action="{{ route('email.change') }}" method="POST">
                @csrf
                <!-- {{ csrf_field() }} -->
                <div class="md-form">
                  <label for="new_email">新しいメールアドレス</label>
                  <input class="form-control" type="email" id="new_email" name = "new_email" required>
                </div>

                <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">メール送信</button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
