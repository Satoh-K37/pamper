<nav class="navbar navbar-expand navbar-dark">
<!-- <nav class="navbar navbar-expand"> -->
  @if(app()->isLocal() || app()->runningUnitTests())
    <a class="navbar-brand" href="/">
      <img src='/storage/logo_transparent.png' style="object-fit: cover; width: 200px; height: 50px;">
      <!-- <i class="far fa-sticky-note mr-1" style="object-fit: cover; width: 50px; height: 50px;"></i>SPOILY -->
    </a>
  @else
    <a class="navbar-brand" href="/">
      <img src='{{ Storage::disk('s3')->url("logo_transparent.png") }}' style="object-fit: cover; width: 200px; height: 50px;">
    </a>
  @endif
  <ul class="navbar-nav ml-auto">
    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
    </li>
    @endguest

    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest

    @auth
    <li class="nav-item">
      <a class="nav-link" href="{{ route('recipes.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
    </li>
    @endauth
    

    @auth
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
          <i class="fas fa-user-circle"></i>
          マイページ
        </button>
        <div class="dropdown-divider"></div>
        <button form="logout-button" class="dropdown-item" type="submit">
          <i class="fas fa-sign-out-alt"></i>
          ログアウト
        </button>
      </div>
    </li>
    <form id="logout-button" method="POST" action="{{ route('logout') }}">
      @csrf
    </form>
    <!-- Dropdown -->
    @endauth

  </ul>

</nav>

