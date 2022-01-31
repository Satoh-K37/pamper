@if (session('flash_message'))
  <div class="flash_message alert alert-primary text-center card-text">
    <ul class="flash_message mb-0">
      <li>{{ session('flash_message') }}</li>
    </ul>
  </div>
@endif

@if (session('comment_flash_message'))
  <div class="flash_message alert alert-primary text-center card-text">
    <div class="flash_message mb-0">
      {{ session('comment_flash_message') }}
    </div>
  </div>
@endif
