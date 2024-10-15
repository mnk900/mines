{{  csrf_field() }}
@if(!$errors->isEmpty())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ $model->title }}">
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" class="form-control" value="{{ $model->slug }}">
</div>
<div class="form-group">
    <label for="excerpt">Excerpt</label>
    <input type="text" name="excerpt" id="excerpt" class="form-control" value="{{ $model->excerpt }}">
</div>
<div class="form-group">
    <label for="body">Body</label>
    <textarea name="body" id="body" class="form-control">
        {{ $model->body }}
    </textarea>
</div>
<div class="form-group">
    <label for="published_at">Published</label>
    <input type="datetime-local" name="published_at" id="published_at" class="form-control" value="{{ $model->published_at }}">
</div>
<div class="form-group">
    <label for="post_image">Upload Post Image</label>
    @if ($model->post_image)
            <div>
                <img src="{{ Storage::url($model->post_image_thumbnail) }}" alt="Current Image" width="150">
            </div>
    @endif
    <input type="file" name="post_image" id="post_image" class="form-control" >
</div>
<div class="">
    <input type="submit" class="btn btn-lg btn-danger" value="submit">
</div>
