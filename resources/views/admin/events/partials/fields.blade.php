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
<div class="row">
<div class="col-sm-6">
<div class="form-group">
    <label for="eventName">Event Title</label>
    <input type="text" name="eventName" id="eventName" class="form-control" value="{{ $model->eventName }}">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
    <label for="eventDescription">Description</label>
    <textarea name="eventDescription" id="eventDescription" class="form-control">
        {{ $model->eventDescription }}
    </textarea>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
    <label for="eventDate">Event Date</label>
    <input type="date" name="eventDate" id="eventDate" class="form-control" value="{{ $model->eventDate }}">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
    <label for="eventTime">Event Time</label>
    <input type="time" name="eventTime" id="eventTime" class="form-control" value="{{ $model->eventTime }}">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
    <label for="eventLocation">Event Location</label>
    <textarea name="eventLocation" id="eventLocation" class="form-control">
        {{ $model->eventLocation }}
    </textarea>
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
    <label for="eventOrganizer">Event Organizer</label>
    <input type="text" name="eventOrganizer" id="eventOrganizer" class="form-control" value="{{ $model->eventOrganizer }}">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
    <label for="availableSeats">Avaialable Seats</label>
    <input type="number" name="availableSeats" id="availableSeats" class="form-control" value="{{ $model->availableSeats }}">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
    <label for="eventCategory">Event Category</label>
    <input type="text" name="eventCategory" id="eventCategory" class="form-control" value="{{ $model->eventCategory }}">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
    <label for="eventTags">Tags(Comma Seperated)</label>
    <input type="text" name="eventTags" id="eventTags" class="form-control" value="{{ $model->eventTags }}">
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
    <div class="form-group">
        <label for="eventImage">Upload Event Image</label>
        @if ($model->eventImage)
                <div>
                    <img src="{{ Storage::url($model->eventImageThumbnail) }}" alt="Current Image" width="150">
                </div>
        @endif
        <input type="file" name="eventImage" id="eventImage" class="form-control" >
    </div>
</div>
<div class="">
    <input type="submit" class="btn btn-lg btn-danger" value="submit">
</div>
</div>
