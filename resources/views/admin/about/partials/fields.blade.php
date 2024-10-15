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
    <label for="mission">Mission</label>
    <textarea name="mission" id="mission" class="form-control">
        {{ $model->mission }}
    </textarea>
</div>
<div class="form-group">
    <label for="vision">Vision</label>
    <textarea name="vision" id="vision" class="form-control">
        {{ $model->vision }}
    </textarea>
</div>
<div class="form-group">
    <label for="history">History</label>
    <textarea name="history" id="history" class="form-control">
        {{ $model->history }}
    </textarea>
</div>
<div class="">
    <input type="submit" class="btn btn-lg btn-danger" value="submit">
</div>
