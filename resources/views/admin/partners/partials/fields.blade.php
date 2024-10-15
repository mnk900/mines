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
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ $model->name }}">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control">
        {{ $model->description }}
    </textarea>
</div>
<div class="form-group">
    <label for="website">Website Link</label>
    <input type="text" name="website" id="website" class="form-control" value="{{ $model->website }}">
</div>

<div class="form-group">
    <label for="logo">Upload Logo</label>
    @if ($model->logo)
            <div>
                <img src="{{ Storage::url($model->logo) }}" alt="Current Image" width="150">
            </div>
    @endif
    <input type="file" name="logo" id="logo" class="form-control" >
</div>
<div class="">
    <input type="submit" class="btn btn-lg btn-danger" value="submit">
</div>
