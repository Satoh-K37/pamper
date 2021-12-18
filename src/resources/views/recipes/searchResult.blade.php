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
    <div class="d-flex my-box-light flex-wrap my-2">
      @foreach($result_recipes as $recipe)
        @include('recipes.index_card')
      @endforeach
    </div>
    <nav class="my-4" aria-label="...">
      <ul class="pagination pagination-circle justify-content-center">
        <li class="page-item">
          {{ $result_recipes->appends(request()->query())->links() }}
        </li>
      </ul>
    </nav>
    
    
  </div>
@endsection