<!-- 検索結果の表示画面 -->
@extends('app')

@section('title')

@section('content')
  @include('nav')
  <div class="container">
    @include('recipes.search')
    <div class="card mt-3">
      <div class="card-body">
        <!-- <h2 class="h4 card-title m-0">検索キーワード：{{$keyword}}</h2> -->
        <h2 class="h4 card-title m-0">検索結果</h2>
        <div class="card-text text-right">
          @if (count($result_recipes) >0)
            全{{ $result_recipes->total() }}件中
            {{  ($result_recipes->currentPage() -1) * $result_recipes->perPage() + 1}} - 
            {{ (($result_recipes->currentPage() -1) * $result_recipes->perPage() + 1) + (count($result_recipes) -1)  }}件のレシピ</p>
          @else
            <p>データがありません。</p>
          @endif
        </div>
      </div>
    </div>
    @foreach($result_recipes as $recipe)
      @include('recipes.card')
    @endforeach
    {{ $result_recipes->appends(request()->query())->links() }}
    
  </div>
@endsection