@extends('app')

@section('title', '退会確認画面')

@section('content')
@include('nav')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <!-- <h1 class="text-center"><a class="text-dark" href="/">SPOILY</a></h1> -->
        <div class="card mt-3">
          <div class="card-body text-center">
            <h3 class="h3 card-title text-center mt-2">退会確認画面</h3>
            @include('error_card_list')
            @include('flash_message')

            <div class="card-text">
              <div>
                <a class="font-weight-normal ml-3">{{ $user->name }}さん、SPOILYを退会しますか？</a>
                  @if( Auth::id() === $user->id )
                      <button class="btn btn-block blue-gradient mt-2 mb-2" data-toggle="modal" data-target="#modal-delete-{{ $user->id }}">退会する</button>

                      <!-- modal -->
                      <div id="modal-delete-{{ $user->id }}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form method="POST" action="{{ route('users.destroy', ['name' => $user->name]) }}">
                              @csrf
                              @method('DELETE')
                              <div class="modal-body">
                                {{$user->name}}さん、本当にSPOILYを退会しますか？
                              </div>
                              <div class="modal-footer justify-content-between">
                                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                                <button type="submit" class="btn btn-danger">退会する</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- modal -->
                    @endif
              </div>      
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
