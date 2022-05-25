@extends('app')

@section('title', 'レシピ更新')


@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card my-5">
          <div class="card-body pt-0">
            @include('error_card_list')
            <div class="card-text">
              <form method="POST" action="{{ route('recipes.update', ['recipe' => $recipe]) }}" enctype="multipart/form-data">
                @method('PATCH')
                @include('recipes.form')
                <button type="submit" class="orign-btn btn-block ">更新する</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
