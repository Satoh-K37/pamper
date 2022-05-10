@extends('app')

@section('title', 'パスワード変更')

@section('content')
@include('nav')


<div class="container">
  <div class="row">
    <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
      <!-- <h1 class="text-center"><a class="text-dark" href="/">SPOILY</a></h1> -->
      <div class="card mt-3">
        <div class="card-body text-center">
          <h2 class="h3 card-title text-center mt-2">パスワード変更</h2>

          @include('error_card_list')
          @include('flash_message')

          <div class="card-text">
              <form method="POST" action="{{ route('password.change') }}">
                  @csrf

                  <div class="md-form">
                      <label for="current_password" >現在のパスワード</label>
                        <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="new-password">

                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>

                  <div class="md-form">
                    <label for="password">新しいパスワード</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                  </div>

                  <div class="md-form">
                      <label for="password-confirm">新しいパスワード（確認用）</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  </div>

                  <button type="submit" class="btn btn-block blue-gradient mt-2 mb-2">
                      パスワードの変更
                  </button>
                      
              </form>
              </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">パスワード変更</div>
                @include('error_card_list')
                @include('flash_message')
                
                <div class="card-body">
                    <form method="POST" action="{{ route('password.change') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">
                              現在のパスワード
                            </label>

                            <div class="col-md-6">
                              <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="new-password">

                              @error('current_password')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                              新しいパスワード
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                              新しいパスワード（確認用
                            </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    パスワードの変更
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div> -->
@endsection


