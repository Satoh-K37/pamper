<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
        @if($user->profile_image !== NULL)
          <!-- <img src="/storage/icons{{$user->profile_image}}" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;"> -->
          <img src="/storage/icons/{{$user->profile_image}}" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
        @else
          <img src="/storage/default_icon.png" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
        @endif
      </a>
      @if( Auth::id() !== $user->id )
        <follow-button
          class="ml-auto"
          :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
          :authorized='@json(Auth::check())'
          endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
        >
        </follow-button>
      @endif
    </div>
    <h2 class="h5 card-title m-0">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
        {{ $user->name }}
      </a>
      <p></p>
    </h2>
    @if( Auth::id() === $user->id )
      <a href="{{ route('users.edit', ['name' => $user->name] )}}">
        <!-- <button class="user-btn"> -->
        <button class="btn blue-gradient btn-block" style="width: 25%; padding: 10px;">
          ユーザー登録内容の編集
        </button>
      </a>
      
    @endif

    <br>
    <p class="text-dark">
        {{ $user->self_introduction }}
    </p>


  </div>
  <div class="card-body">
    <div class="card-text">
      <a href="{{ route('users.followings', ['name' => $user->name]) }}" class="text-muted">
        {{ $user->count_followings }} フォロー
      </a>
      <a href="{{ route('users.followers', ['name' => $user->name]) }}" class="text-muted">
        {{ $user->count_followers }} フォロワー
      </a>
    </div>
  </div>
</div>
