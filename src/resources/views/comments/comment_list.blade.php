@foreach ($recipe->comments as $comment)
<div class="card mt-3">
  <div class="card-body d-flex flex-row">
    <a href="{{ route('users.show', ['name' => $comment->user->name]) }}" class="text-dark">
      <!-- <i class="fas fa-user-circle fa-3x mr-1"></i> -->
      @if($comment->user->profile_image !== NULL)
        <img src="/storage/icons/{{$comment->user->profile_image }}" class="rounded-circle" style="object-fit: cover; width: 75px; height: 75px;">
      @else
        <img src="/storage/default_icon.png" class="rounded-circle" style="object-fit: cover; width: 75px; height: 75px;">
      @endif
    </a>
    <div>
      <div class="font-weight-bold">
        <a href="{{ route('users.show', ['name' => $comment->user->name]) }}" class="text-dark">
          {{ $comment->user->name }}
        </a>
      </div>
      <div class="font-weight-lighter">
        {{ $comment->created_at->format('Y/m/d H:i') }}
      </div>
    </div>

  @if( Auth::id() === $comment->user_id )
    <!-- dropdown -->
      <div class="ml-auto card-text">
        <div class="dropdown">
          <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" data-toggle="modal" data-target="#modal-delete-{{ $comment->id }}">
              <i class="fas fa-trash-alt mr-1"></i>コメントを削除する
            </a>
          </div>
        </div>
      </div>
      <!-- dropdown -->

      <!-- modal -->
      <div id="modal-delete-{{ $comment->id }}" class="modal fade" tabindex="-1" role="dialog">
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
                コメントを削除します。よろしいですか？（仮でレシピ削除のルートを貼ってるので削除するを押さないで）
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

    <div class="mb-2">
      <!-- <div>
        <div class="font-weight-bold">
          <a href="{{ route('users.show', ['name' => $recipe->user->name]) }}" class="text-dark">
            {{ $comment->user->name  }}
          </a>
        </div>
        <div class="font-weight-lighter">
          {{ $comment->created_at->format('Y/m/d H:i') }}
      </div> -->
      <div class="card-body pt-0">
        <div class="card-text">
          {{ $comment->comment }}
        </div>
      </div>
      <!-- 削除できるけどレシピごと消える -->
      <!-- @if ($comment->user->id == Auth::user()->id)
        <form method="POST"  href="/comments/{{ $comment->id }}" >
        @csrf
        {{ method_field('delete') }}
        <input type="submit" value="削除" class="btn btn-danger btn-sm" onclick='return confirm("君は本当に削除するつもりかい？");'>
        </form>
      @endif -->
    </div>

  </div>
</div>

@endforeach
