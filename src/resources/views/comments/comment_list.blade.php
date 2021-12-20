<div class="card my-5">
  <!-- Section: Block Content -->
  <section>
    <div class="card">
      <div class="card-body">
        <div class="text-right mb-4">
          @include('comments.form')
        </div>
        <hr>
        @foreach ($recipe->comments as $comment)
        <!--Grid row-->
        <div class="row">
          <!--Grid column-->
          <div class="col-12 mb-3 mx-auto">
            <div class="media">
              <a href="{{ route('users.show', ['name' => $comment->user->name]) }}" class="text-dark">
                <!-- <i class="fas fa-user-circle fa-3x mr-1"></i> -->
                @if($comment->user->profile_image !== NULL)
                  <img src="/storage/icons/{{$comment->user->profile_image }}" class="rounded-circle" style="object-fit: cover; width: 75px; height: 75px;">
                @else
                  <img src="/storage/default_icon.png" class="rounded-circle" style="object-fit: cover; width: 75px; height: 75px;">
                @endif
              </a>
              <div class="media-body">
                <h6 class="mt-1 font-weight-bold">
                <a href="{{ route('users.show', ['name' => $comment->user->name]) }}" class="text-dark">
                  {{ $comment->user->name }}
                </a>
                <a class="font-weight-lighter">
                  {{ $comment->created_at->format('Y/m/d H:i') }}
                </a>
                  
                  <span class="float-right mr-4">
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
                            <form method="POST" action="{{ route('comments.destroy', ['comment' => $comment]) }}">
                              @csrf
                              @method('DELETE')
                              <div class="modal-body">
                              コメント「{{ $comment->comment }}」を削除します。よろしいですか？
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
                  </span>
                </h6>
                <p class="text-muted">
                  {{ $comment->comment }}
                </p>
              </div>
            </div>
            <hr>
          </div>
          <!--Grid column-->
          
        </div>
        <!--Grid row-->
        @endforeach
      </div>
      
    </div>
    
  </section>
  <!-- Section: Block Content -->

</div>