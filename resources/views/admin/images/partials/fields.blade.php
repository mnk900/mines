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
    <label for="gallery_id">Gallery/Album</label>
    <select class="form-control" id="gallery_id" name="gallery_id">
        <option value="">--Select Album--</option>
        @foreach ($gallery as $album)
        <option value="{{ $album->id }}" {{ $album->id == $model->gallery_id ? 'selected' : '' }}>
            {{ $album->title }}
        </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ $model->title }}">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control">
        {{ $model->description }}
    </textarea>
</div>
<div class="form-group">
    <label for="image">Upload Image</label>
    @if ($model->url)
            <div>
                <img src="{{ Storage::url($model->thumbnail_url) }}" alt="Current Image" width="150">
            </div>
        @endif
    <input type="file" name="image" id="image" class="form-control" >
</div>
<div class="">
    <input type="submit" class="btn btn-lg btn-danger" value="submit">
</div>
