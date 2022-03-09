  <!--Main layout-->

    <div class="col-lg-4 col-md-12 mb-4 card-group">
      <div class="card">
        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
          <vue-pure-lightbox
            thumbnail='/storage/images/{{$recipe->image_path}}'
            :images="[
              '/storage/images/{{$recipe->image_path}}'
            ]"
          ></vue-pure-lightbox>
        </div>
        <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
          <img src="{{ Storage::disk('s3')->url("laravel-ci-myprefix/public/images/$recipe->image_path")}}">
        </div>
        <div class="card-body">
          <div class="card-body d-flex flex-row p-0">
            <a href="{{ route('users.show', ['name' => $recipe->user->name]) }}" class="text-dark">
              @if($recipe->user->profile_image !== NULL)
                <img src="/storage/icons/{{$recipe->user->profile_image }}" class="rounded-circle" style="object-fit: cover; width: 50 px; height: 50px;">
              @else
                <img src="/storage/default_icon.png" class="rounded-circle" style="object-fit: cover; width: 75px; height: 75px;">
              @endif
            </a>
            <div class="font-weight-bold mx-3">
              <a href="{{ route('users.show', ['name' => $recipe->user->name]) }}" class="text-dark">
                {{ $recipe->user->name }}
                <p class="font-weight-lighter">
                  {{ $recipe->created_at->format('Y/m/d H:i') }}
                </p>
              </a>
            </div>
            <!-- <div class="font-weight-lighter ml-2">
              {{ $recipe->created_at->format('Y/m/d H:i') }}
            </div> -->
            @if( Auth::id() === $recipe->user_id )
          <!-- dropdown -->
            <div class="ml-auto card-text">
              <div class="dropdown">
                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-v my-3"></i>
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

          <div class="d-flex my-box-light">
            <div class="my-box mr-auto">
            </div>
            <div class="my-box">
              @foreach($recipe->categories as $category)
                @if($loop->first)
                  <div class="card-body m-0 p-0">
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
              <div class="card-body ml-2 p-0">
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

          <div class="font-weight-bold text-truncate d-inline-block" style="width: 100%;">
            <a class="text-dark" href="{{ route('recipes.show', ['recipe' => $recipe]) }}">
              {{ $recipe->recipe_title }}
            </a>
          </div>

          <p class="card-text">
            {{$recipe->content}}
            <!-- {{ Str::limit($recipe->content, 50, '...') }} -->
          </p>
        </div>

        <div class="d-flex align-items-end my-box-light">
          <div class="my-box mr-auto p-2">
            @foreach($recipe->tags as $tag)
              @if($loop->first)
                <div class="card-body pt-0 pb-2 pl-0 pr-4">
                  <div class="card-text line-height">
              @endif
                  <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border ml-2 my-3 text-muted">
                    {{ $tag->hashtag }}
                  </a>
              @if($loop->last)
                  </div>
                </div>
              @endif
            @endforeach
          </div>
          
          <div class="my-box ml-3 p-2">
            <span class="text-muted">
              <recipe-comment
                :initial-count-comments='@json($recipe->count_comments)'
              >
              </recipe-comment>
            </span>
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
      <!--Section: Content-->

  <!--Main layout-->

  