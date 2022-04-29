

@if (session('flash_message'))
  <div id='hideMe'>
    <div class="alert alert-primary text-center card-text">
      <ul class="mb-0">
        {{ session('flash_message') }}
      <ul>
    </div>
  </div>
@endif

@if (session('comment_flash_message'))
  <div id='hideMe'>
    <div class="alert alert-primary text-center card-text">
      <ul class="mb-0">
        {{ session('comment_flash_message') }}
      <ul>
    </div>
  </div>
@endif