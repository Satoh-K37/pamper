
            <ul class="nav nav-tabs nav-justified my-1">
                <li class="nav-item">
                  <a class="nav-link text-muted {{ $hasFollowers ? 'active' : '' }}" href="{{ route('users.followers', ['name' => $user->name]) }}">
                      フォロワー
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-muted tab {{ $hasFollowings ? 'active' : '' }}" href="{{ route('users.followings', ['name' => $user->name]) }}">
                      フォロー中
                  </a>
                </li>
            </ul>

