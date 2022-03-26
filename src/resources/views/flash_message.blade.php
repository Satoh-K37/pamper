@if (session('flash_message'))
  <div class="flash_message alert alert-primary text-center card-text" v-bind:class="{'is-active': isActive}" >
    <ul class="flash_message mb-0">
      {{ session('flash_message') }}
      <!-- <ToastMessage name="{{ session('flash_message') }}" /> -->
    </ul>
  </div>
@endif

@if (session('comment_flash_message'))
  <div class="flash_message alert alert-primary text-center card-text" v-bind:class="{'is-active': isActive}" >
    <div class="flash_message mb-0">
      {{ session('comment_flash_message') }}
    </div>
  </div>
@endif


