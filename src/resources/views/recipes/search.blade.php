<div class="container">
  <div class="mx-auto">
    <br>
    <!-- <h2 class="text-center">レシピ検索</h2> -->
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
          <div class="form-group row">
            <label for="category_id" class="col-sm-2">カテゴリ</label>
            <div class="col-sm-3">
              <select name="category_id" class="form-control" value="{{ $category_id }}">
                @foreach($categories as $id => $name)
                  <option value="{{ $id }}" {{ old('category', $old_category_id ?? '') == $id ? 'selected' : ''}}>
                    {{ $name }}
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