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
    <label for="position">Position</label>
    <input type="text" name="position" id="position" class="form-control" value="{{ $model->position }}">
</div>
<div class="form-group">
    <label for="bio">Bio</label>
    <textarea name="bio" id="bio" class="form-control">
        {{ $model->bio }}
    </textarea>
</div>
<div class="form-group">
    <label for="photo">Upload Image</label>
    @if ($model->photo)
            <div>
                <img src="{{ Storage::url($model->photo) }}" alt="Current Image" width="150">
            </div>
    @endif
    <input type="file" name="photo" id="photo" class="form-control" >
</div>
<div class="">
    <input type="submit" class="btn btn-lg btn-danger" value="submit">
</div>
