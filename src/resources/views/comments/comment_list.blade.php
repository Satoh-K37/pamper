@foreach ($recipe->comments as $comment) 
  <div class="mb-2">
    @if ($comment->user->id == Auth::user()->id)
      <!-- <a class="delete-comment" data-remote="true" value="削除" rel="nofollow" data-method="delete" href="/comments/{{ $comment->id }}"></a> -->
      <form method="DELETE" href="/comments/{{ $comment->id }}">
      {{ csrf_field() }}
      <input type="submit" value="削除" class="btn btn-danger btn-sm" onclick='return confirm("君は本当に削除するつもりかい？");'>
      </form>
    @endif
    <!-- <span>
      <strong>
        <a class="no-text-decoration black-color" href="/users/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
      </strong>
    </span>
    <span>{{ $comment->comment }}</span>
  </div> -->

    <div>
      <!-- @if ($comment->user->id == Auth::user()->id)
        <a class="delete-comment" data-remote="true" rel="nofollow" data-method="delete" href="/comments/{{ $comment->id }}"></a>
      @endif -->
      <div class="font-weight-bold">
        <a href="{{ route('users.show', ['name' => $recipe->user->name]) }}" class="text-dark">
          {{ $comment->user->name  }}
        </a>
      </div>
      <div class="font-weight-lighter">
        {{ $comment->created_at->format('Y/m/d H:i') }}
    </div>
    <div class="card-body pt-0">
      <div class="card-text">
        {{ $comment->comment }}
      </div>
    </div>

  </div>

@endforeach
