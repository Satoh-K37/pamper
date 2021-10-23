<div class="container">
  <div class="mx-auto">
    <br>
    <h2 class="text-center">レシピ検索</h2>
    <br>
    <!--検索フォーム-->
    <div class="row">
      <div class="col-sm">
        <form method="GET" action="{{ route('recipes.searchresult')}}">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">キーワード</label>
            <!--入力-->
            <div class="col-sm-5">
              <input type="text" class="form-control" name="keyword" value="{{ $keyword }}" placeholder="キーワードを入力してください">
            </div>
            <div class="col-sm-auto">
              <button type="submit" class="btn btn-primary ">検索</button>
            </div>
          </div>     
        </form>
      </div>
    </div>
  </div>

</div>