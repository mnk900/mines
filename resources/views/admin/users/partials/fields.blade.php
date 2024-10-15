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
        <label for="district">District:</label>
        <select id="district" name="district" class="form-control">
            <option value="">Select District</option>
            @foreach($districts as $district)
                <option value="{{ $district->District }}">{{ $district->DistrictName }}</option>
            @endforeach
        </select>
    </div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" class="form-control" value="{{ $model->email }}">
</div>
@if(is_null($model->id))
<div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control" value="{{ $model->email }}">
</div>
<div class="form-group">
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ $model->email }}">
</div>
@endif
<h3>Choose Roles for this User</h3>
@foreach ($roles as $role)
    <div class="checkbox">
        <label>
            <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $model->hasRole($role->name)?'checked':''}} />
            {{ $role->name }}
        </label>
    </div>
@endforeach
    <input type="submit" class="btn btn-lg btn-danger" value="submit">
