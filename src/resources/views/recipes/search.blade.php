<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
  検索
</button>

<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">レシピ検索</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

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
                    <!-- <div class="col-sm-auto">
                      <button type="submit" class="btn btn-primary ">検索</button>
                    </div> -->
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
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="sbumit" class="btn btn-primary">検索</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
