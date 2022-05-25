<div class="card mt-3">
  <div class="card-body">
    <div class="d-flex flex-row">
      <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark">
        @if(app()->isLocal() || app()->runningUnitTests())
          <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark">
            @if($person->profile_image !== NULL)
              <img src='/storage/icons/{{$person->profile_image}}' class="rounded-circle" style="object-fit: cover; width: 50px; height: 50px;">
            @else
              <img src='/storage/default_icon.png' class="rounded-circle" style="object-fit: cover; width: 50px; height: 50px;">
            @endif
          </a>
        @else
          <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark">
            @if($person->profile_image !== NULL)
              <img src="{{ $person->profile_image }}" class="rounded-circle" style="object-fit: cover; width: 50px; height: 50px;">
            @else
              <img src="{{ Storage::disk('s3')->url("default_icon.png") }}" class="rounded-circle" style="object-fit: cover; width: 50px; height: 50px;">
            @endif
          </a>
        @endif
      </a>

      @if( Auth::id() !== $person->id )
        <follow-button
          class="ml-auto"
          :initial-is-followed-by='@json($person->isFollowedBy(Auth::user()))'
          :authorized='@json(Auth::check())'
          endpoint="{{ route('users.follow', ['name' => $person->name]) }}"
        >
        </follow-button>
      @endif
    </div>
    <h2 class="h5 card-title m-0">
      <a href="{{ route('users.show', ['name' => $person->name]) }}" class="text-dark">{{ $person->name }}</a>
    </h2>
  </div>
</div>
