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
    <label for="key">Title</label>
    <input type="text" name="key" id="key" class="form-control" value="{{ $model->key }}">
</div>

<div class="form-group">
    <label for="value">Description</label>
    <textarea name="value" id="value" class="form-control">
        {{ $model->value }}
    </textarea>
</div>

<div class="form-group">
    <label for="image">Upload Image(Optional)</label>
    @if ($model->image)
            <div>
                <img src="{{ Storage::url($model->image) }}" alt="Current Image" width="150">
            </div>
    @endif
    <input type="file" name="image" id="image" class="form-control" >
</div>
<div class="">
    <input type="submit" class="btn btn-lg btn-danger" value="submit">
</div>
