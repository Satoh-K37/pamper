<div class="card mt-3">
  <div class="card-body d-flex flex-row">
    <i class="fas fa-user-circle fa-3x mr-1"></i>
    <div>
      <div class="font-weight-bold">{{ $recipe->user->name }}</div>
      <div class="font-weight-lighter">{{ $recipe->created_at->format('Y/m/d H:i') }}</div>
    </div>

  @if( Auth::id() === $recipe->user_id )
    <!-- dropdown -->
      <div class="ml-auto card-text">
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
  <div class="card-body pt-0">
    <h3 class="h4 card-title">
      <a class="text-dark" href="{{ route('recipes.show', ['recipe' => $recipe]) }}">
        {{ $recipe->recipe_title }}
      </a>
    </h3>
    <div class="card-text">
      {{ $recipe->content }}
    </div>
    
    <div class="card-text">
      {{ $recipe->serving }}
    </div>
    <div class="card-text">
      {{ $recipe->ingredient }}
    </div>
    <div class="card-text">
      {{ $recipe->seasoning }}
    </div>
    <div class="card-text">
      {{ $recipe->step_content }}
    </div>
    <div class="card-text">
      {{ $recipe->step_content2 }}
    </div>
    <div class="card-text">
      {{ $recipe->step_content3 }}
    </div>
    <div class="card-text">
      {{ $recipe->step_content4 }}
    </div>
    <div class="card-text">
      {{ $recipe->step_content5 }}
    </div>
    <div class="card-text">
      {{ $recipe->step_content6 }}
    </div>
    <div class="card-text">
      {{ $recipe->cooking_point }}
    </div>

  </div>
</div>
