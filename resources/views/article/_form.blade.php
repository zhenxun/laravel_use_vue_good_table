{{ Form::open(array('url' => $route, 'files' => false)) }}

  @if(isset($article))
    {{ method_field('PUT') }}
  @endif

<div class="form-group">
  <label for="exampleInputEmail1">Title</label>
  <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Article title" value="{{ $article->title or old('title') }}">
  <small id="emailHelp" class="form-text text-muted">Type your interesting title</small>
</div>

<div class="form-group">
  <label for="exampleInputPassword1">Content</label>
  <div class="form-group">
      <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3">{{ $article->content or old('content') }}</textarea>
  </div>
</div>

<div class="col text-right">
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> &nbsp; Save</button>
</div>
{{ Form::close() }}