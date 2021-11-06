<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
        <i class="fas fa-user-circle fa-3x"></i>
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
      <a href="" class="text-dark">
        {{ $user->self_introduction }}
      </a>
    </h2>
    @if( Auth::id() === $user->id )
      <a href="{{ route('users.edit', ['name' => $user->name] )}}">
        <!-- <button class="user-btn"> -->
        <button class="btn blue-gradient btn-block" style="width: 25%; padding: 10px;">
          ユーザー登録内容の編集
        </button>
      </a>
      <p></p>
      
      
      <a href="{{ route('password.form', ['name' => $user->name]) }}">
      

        <button class="btn blue-gradient btn-block" style="width: 25%; padding: 10px;">
          <!-- {{ __('Change Password') }} -->
          パスワードの変更
        </button>
      </a>
    @endif


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
