<div id="comment-post-{{ $recipe->id }}">
      </div>
      <!-- <a class="light-color post-time no-text-decoration" href="/recipes/{{ $recipe->id }}">{{ $recipe->created_at }}</a> -->
      <hr>
      <div class="row actions" id="comment-form-post-{{ $recipe->id }}">
          <form class="w-100" id="new_comment" action="/recipe/{{ $recipe->id }}/comments" accept-charset="UTF-8" data-remote="true" method="post"><input name="utf8" type="hidden" value="&#x2713;" />
          {{csrf_field()}} 
          <input value="{{ Auth::user()->id }}" type="hidden" name="user_id" />
          <input value="{{ $recipe->id }}" type="hidden" name="recipe_id" />
          <input v-model.trim="commentCount" maxlength="100" class="form-control comment-input border-0" placeholder="コメント ..." autocomplete="off" type="text" name="comment" />
            <p>@{{ commentCount.length }}/100</p>
          <button type="submit" class="btn blue-gradient btn-block">コメントする</button>
        </form>
      </div>
</div>