@extends('app')

@section('title', 'レシピ投稿')


@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card my-5">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
                @include('recipes.form')
                <button type="submit" class="btn blue-gradient btn-block">投稿する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
