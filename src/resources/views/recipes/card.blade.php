<!-- コンテンツスタート２ -->
<div class="card my-5">
  <div class="row g-0">
    <div class="col-md-12 card-group">
      <div class="card">
        @if(app()->isLocal() || app()->runningUnitTests())
          <vue-pure-lightbox
            thumbnail='/storage/images/{{$recipe->image_path}}'
            :images="[
              
              '/storage/images/{{$recipe->image_path}}'
            ]"
          ></vue-pure-lightbox>
        @else
          <vue-pure-lightbox
            thumbnail='{{ Storage::disk('s3')->url("$recipe->image_path") }}'
            :images="[
              '{{ Storage::disk('s3')->url("$recipe->image_path") }}'
            ]"
          ></vue-pure-lightbox>
        @endif
      </div>
    </div>
    <div class="col-md-12">
      <div class="card-body my-0 py-0">
        <div class="card-title px-0 py-0 mx-0 my-0">
          <div class="card-body d-flex flex-row px-0">
            <a href="{{ route('users.show', ['name' => $recipe->user->name]) }}" class="text-dark">
              @if(app()->isLocal() || app()->runningUnitTests())
                @if($recipe->user->profile_image !== NULL)
                  <img src="/storage/icons/{{$recipe->user->profile_image }}" class="rounded-circle" style="object-fit: cover; width: 50px; height: 50px;">
                @else
                  <img src="/storage/default_icon.png" class="rounded-circle" style="object-fit: cover; width: 50px; height: 50px;">
                @endif
              @else
                @if($recipe->user->profile_image !== NULL)
                  <img src="{{ Storage::disk('s3')->url("$recipe->user->profile_image") }}" class="rounded-circle" style="object-fit: cover; width: 50px; height: 50px;">
                @else
                  <img src="{{ Storage::disk('s3')->url("default_icon.png") }}" class="rounded-circle" style="object-fit: cover; width: 50px; height: 50px;">
                @endif
              @endif
            </a>
            <div class="font-weight-bold ml-2 my-auto">
              <a href="{{ route('users.show', ['name' => $recipe->user->name]) }}" class="text-dark">
                {{ $recipe->user->name }}
                <p class="font-weight-lighter">
                  {{ $recipe->created_at->format('Y/m/d H:i') }}  
                </p>
              </a>
            </div>
            <!-- <div class="font-weight-lighter ml-2 my-auto">
              {{ $recipe->created_at->format('Y/m/d H:i') }}
            </div> -->
        @if( Auth::id() === $recipe->user_id )
          <!-- dropdown -->
            <div class="ml-auto card-text ml-5 my-auto">
              <div class="dropdown px-3">
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
          <div class="d-flex my-box-light py-0 my-0">
            <div class="my-box mr-auto">
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
          <h4 class="font-weight-bold text-truncate d-inline-block" style="width: 100%;">
            <a class="text-dark" href="{{ route('recipes.show', ['recipe' => $recipe]) }}">
              {{ $recipe->recipe_title }}
            </a>
          </h4>
            <div class="card-text mb-5">
              {{ $recipe->content }}
            </div>
          @if(Route::is('recipes.show'))
            @if(isset($recipe->ingredient) || isset($recipe->seasoning))
            <div class="recipe-label ml-2 my-2 text-center font-weight-bold">
              材料・調味料（{{ $recipe->serving }}人前）
            </div>
            <ol class="list-wrap">
                @if(isset($recipe->ingredient))
                <li class="list">
                  <p class="my-2">{{ $recipe->ingredient }}</p>
                </li>
                @endif
                @if(isset($recipe->seasoning))
                <li class="list">
                  <p class="my-2">{{ $recipe->seasoning }}</p>
                </li>
                @endif
            </ol>
            @endif
              

            @if(isset($recipe->step_content) || isset($recipe->step_content2)|| isset($recipe->step_content3) 
                || isset($recipe->step_content4) || isset($recipe->step_content5) || isset($recipe->step_content6))
            <div class="recipe-label ml-2 my-2 text-center font-weight-bold">
              作り方・食べ方
            </div>

            <ol class="list-wrap">
                @if(isset($recipe->step_content))
                <li class="list">
                  <p class="my-2">{{ $recipe->step_content }}</p>
                </li>
                @endif
                @if(isset($recipe->step_content2))
                <li class="list">
                  <p class="my-2">{{ $recipe->step_content2 }}</p>
                </li>
                @endif
                @if(isset($recipe->step_content3))
                <li class="list">
                  <p class="my-2">{{ $recipe->step_content3 }}</p>
                </li>
                @endif
                @if(isset($recipe->step_content4))
                <li class="list">
                  <p class="my-2">{{ $recipe->step_content4 }}</p>
                </li>
                @endif
                @if(isset($recipe->step_content5))
                <li class="list">
                  <p class="my-2">{{ $recipe->step_content5 }}</p>
                </li>
                @endif
                @if(isset($recipe->step_content6))
                <li class="list">
                  <p class="my-2">{{ $recipe->step_content6 }}</p>
                </li>
                @endif
            </ol>
            @endif
            @if(isset($recipe->cooking_point))
            <div class="recipe-label ml-2 my-2 text-center font-weight-bold">
              コツ・ポイント
            </div>
            <ol class="list-wrap">
              <li class="list my-2">
                <p class="my-2">{{ $recipe->cooking_point }}</p>
              </li>
            </ol>
            @endif
          @endif
          <div class="d-flex my-box-light mt-5">
            <div class="my-box mr-auto p-2">
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
            <div class="my-box p-2">
              <recipe-comment
                :initial-count-comments='@json($recipe->count_comments)'
              >
              </recipe-comment>
            </div>
            <div class="my-box p-2">
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