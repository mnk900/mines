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
<div class="">
    <input type="submit" class="btn btn-lg btn-danger" value="submit">
</div>
