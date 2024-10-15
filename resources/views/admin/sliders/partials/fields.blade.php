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
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control">
        {{ $model->description }}
    </textarea>
</div>
<div class="form-group">
    <label for="page_link">Select Page Link</label>
    <select class="form-control" id="page_link" name="page_link">
        <option value="">--Select Link--</option>
        @foreach ($page_links as $links)
        <option value="{{ $links->url }}" {{ $links->url == $model->page_link ? 'selected' : '' }}>
            {{ $links->url }}
        </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="slider_image">Upload Image</label>
    @if ($model->slider_image)
            <div>
                <img src="{{ Storage::url($model->slider_image) }}" alt="Current Image" width="150">
            </div>
    @endif
    <input type="file" name="slider_image" id="slider_image" class="form-control" >
</div>
<div class="">
    <input type="submit" class="btn btn-lg btn-danger" value="submit">
</div>
