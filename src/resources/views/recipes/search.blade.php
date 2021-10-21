<div class="container">
    <div class="mx-auto">
      <br>
      <h2 class="text-center">レシピ検索</h2>
      <br>
      <!--検索フォーム-->
      <div class="row">
        <div class="col-sm">
          <form method="GET" action="{{ route('recipes.search')}}">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">キーワード</label>
              <!--入力-->
              <div class="col-sm-5">
                <input type="text" class="form-control" name="searchWord"  placeholder="キーワードを入力してください">
              </div>
              <div class="col-sm-auto">
                <button type="submit" class="btn btn-primary ">検索</button>
              </div>
            </div>     
            <!--プルダウンカテゴリ選択-->
            <div class="form-group row">
              <label class="col-sm-2">レシピカテゴリ</label>
              <div class="col-sm-3">
                <select name="category_id" class="form-control" value=>
                  @foreach($categories as $id => $category_name)
                  <option value="{{ $id }}">
                    {{ $category_name }}
                  </option>  
                  @endforeach
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>