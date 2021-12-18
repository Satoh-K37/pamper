<!-- コンテンツスタート２ -->
<div class="card my-5">
  <div class="row g-0">
    <div class="col-md-12">
      <div class="card">
        <vue-pure-lightbox
          thumbnail='/storage/images/{{$recipe->image_path}}'
          :images="[
            
            '/storage/images/{{$recipe->image_path}}'
          ]"
        ></vue-pure-lightbox>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card-body my-0 py-0">
        <div class="card-title pt-0">
          <div class="card-body d-flex flex-row">
            <a href="{{ route('users.show', ['name' => $recipe->user->name]) }}" class="text-dark">
              @if($recipe->user->profile_image !== NULL)
                <img src="/storage/icons/{{$recipe->user->profile_image }}" class="rounded-circle" style="object-fit: cover; width: 75px; height: 75px;">
              @else
                <img src="/storage/default_icon.png" class="rounded-circle" style="object-fit: cover; width: 75px; height: 75px;">
              @endif
            </a>
            <div class="font-weight-bold ml-2 my-auto">
              <a href="{{ route('users.show', ['name' => $recipe->user->name]) }}" class="text-dark">
                {{ $recipe->user->name }}
              </a>
            </div>
            <div class="font-weight-lighter ml-2 my-auto">
              {{ $recipe->created_at->format('Y/m/d H:i') }}
            </div>
        @if( Auth::id() === $recipe->user_id )
          <!-- dropdown -->
            <div class="ml-auto card-text ml-5 my-auto">
              <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="{{ route("recipes.edit", ['recipe' => $recipe]) }}">
                    <i class="fas fa-pen mr-1"></i>レシピを更新する
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $recipe->id }}">
                    <i class="fas fa-trash-alt mr-1"></i>レシピを削除する
                  </a>
                </div>
              </div>
            </div>
            <!-- dropdown -->

            <!-- modal -->
            <div id="modal-delete-{{ $recipe->id }}" class="modal fade" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="POST" action="{{ route('recipes.destroy', ['recipe' => $recipe]) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                      {{ $recipe->recipe_title }}を削除します。よろしいですか？
                    </div>
                    <div class="modal-footer justify-content-between">
                      <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                      <button type="submit" class="btn btn-danger">削除する</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- modal -->
          @endif
        </div>
      </div>
      <!--  -->
          <div class="d-flex my-box-light">
            <div class="my-box mr-auto">
              <h4 class="card-title">
                <a class="text-dark" href="{{ route('recipes.show', ['recipe' => $recipe]) }}">
                  {{ $recipe->recipe_title }}
                </a>
              </h4>
            </div>
            <div class="my-box">
              @foreach($recipe->categories as $category)
                @if($loop->first)
                  <div class="card-body">
                    <div class="card-text line-height">
                @endif
                    {{ $category->name }}
                @if($loop->last)
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
            <div class="my-box">
              <div class="card-body">
                <div class="card-text line-height">
                  @if($recipe->cooking_time === 5)
                      <p>5分以内</p>
                  @elseif($recipe->cooking_time === 60)
                      <p>1時間以上</p>
                  @else
                    {{ $recipe->cooking_time }}分
                  @endif
                </div>
              </div>
            </div>
          </div>
            <div class="mb-5">
              {{ $recipe->content }}
            </div>
          @if(Route::is('recipes.show'))
            <div class="recipe-label ml-2 my-2 text-center font-weight-bold">
              材料・調味料（{{ $recipe->serving }}人前）
            </div>
            <ol class="list-wrap">
                <li class="list">
                  <p class="my-2">{{ $recipe->ingredient }}</p>
                </li>
                <li class="list">
                  <p class="my-2">{{ $recipe->seasoning }}</p>
                </li>
            </ol>
              

            <div class="recipe-label ml-2 my-2 text-center font-weight-bold">
              作り方
            </div>

            <ol class="list-wrap">
                <li class="list">
                  <p class="my-2">{{ $recipe->step_content }}</p>
                </li>
                <li class="list">
                  <p class="my-2">{{ $recipe->step_content2 }}</p>
                </li>
                <li class="list">
                  <p class="my-2">{{ $recipe->step_content3 }}</p>
                </li>
                <li class="list">
                  <p class="my-2">{{ $recipe->step_content4 }}</p>
                </li>
                <li class="list">
                  <p class="my-2">{{ $recipe->step_content5 }}</p>
                </li>
                <li class="list">
                  <p class="my-2">{{ $recipe->step_content6 }}</p>
                </li>
            </ol>
            <div class="recipe-label ml-2 my-2 text-center font-weight-bold">
              コツ・ポイント
            </div>
            <ol class="list-wrap">
              <li class="list my-2">
                <p class="my-2">{{ $recipe->cooking_point }}</p>
              </li>
            </ol>
          @endif


          <div class="d-flex my-box-light mt-5">
            <div class="my-box mr-auto">
              @foreach($recipe->tags as $tag)
                @if($loop->first)
                  <div class="card-body pt-0 pb-4 pl-3">
                    <div class="card-text line-height">
                @endif
                    <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
                      {{ $tag->hashtag }}
                    </a>
                @if($loop->last)
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
            <div class="my-box">
              <i class="far fa-comment mr-1 my-1">
                ここにコメントの数を入れる
              </i>
            </div>
            <div class="my-box">
              <recipe-like
                :initial-is-liked-by='@json($recipe->isLikedBy(Auth::user()))'
                :initial-count-likes='@json($recipe->count_likes)'
                :authorized='@json(Auth::check())'
                endpoint="{{ route('recipes.like', ['recipe' => $recipe]) }}"
              >
              </recipe-like>
            </div>
          </div>

      </div>
    </div>
  </div>
</div>