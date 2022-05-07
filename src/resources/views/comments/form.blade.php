<div id="comment-post-{{ $recipe->id }}">
  </div>
  <!-- <a class="light-color post-time no-text-decoration" href="/recipes/{{ $recipe->id }}">{{ $recipe->created_at }}</a> -->
  <div class="row actions" id="comment-form-post-{{ $recipe->id }}">
      <!-- <form class="w-100" id="new_comment" action="/recipe/{{ $recipe->id }}/comments" accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden" value="&#x2713;" /> -->
      <form class="w-100" id="new_comment" action="{{ route('comments.store', ['recipe' => $recipe]) }}"accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden" value="&#x2713;" />
      <!-- {{csrf_field()}}  -->
      @csrf
      <input value="{{ Auth::user()->id }}" type="hidden" name="user_id" />
      <input value="{{ $recipe->id }}" type="hidden" name="recipe_id" />
      <div class="md-form form-lg">
        <input v-model.trim="commentCount" maxlength="100" required class="form-control form-control-lg comment-input" placeholder="" autocomplete="off" type="text" name="comment" />
        <label for="comment">コメント</label>
      </div>
        <p>@{{ commentCount.length }}/100</p>
      <button type="submit" class="btn btn-outline-warning waves-effect">コメントする</button>
    </form>
  </div>

</div>