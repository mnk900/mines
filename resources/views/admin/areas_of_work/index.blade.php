@extends('layouts.appAdmin')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Areas of Work</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">
                <p>{{ session('status') }}</p>
                    </div>
                @endif
            <div class="card">
                <div class="card-header bg-info">
                        <h3 class="card-title">
              <i class="fa fa-users mr-1"></i>
              Areas of Work
            </h3>
                    <div class="float-right">
                            <a href="{{ route('admin.index')}}" class="btn btn-danger text-white p-2">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                Dashboad
                            </a>
                            <a class="btn btn-danger"  href="{{ route('areas_of_work.create')}}"><i class="fa fa-plus text-white"></i></a>
                    </div>
                </div>
            <div class="card-body" style="overflow:auto;">
                <div class="float-right mt-2 mb-3">
                    <form class="form-inline">
                        <input type="text" class="form-control" name="search" placeholder="Search Areas of Work">
                        <button type="submit" class="btn btn-primary ml-1">Search</button>
                    </form>
                </div>
                <table class="table table-sm table-striped" >
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Tags</th>
                            <th>Image</th>
                            <th>Added By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($model as $key=>$areas_of_work)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><a href="{{ route('areas_of_work.edit',['areas_of_work'=>$areas_of_work->id]) }}">{{ $areas_of_work->title }}</a></td>
                        <td>{{ $areas_of_work->description }}</td>
                        <td>{{ $areas_of_work->tags }}</td>
                        <td><img src="{{ Storage::url($areas_of_work->theme_image_thumbnail) }}"/></td>
                        <td>{{ $areas_of_work->user()->first()->name }}</td>
                        <td>
                            <a href="{{ route('areas_of_work.edit',['areas_of_work'=>$areas_of_work->id]) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <a href="{{ route('areas_of_work.destroy', ['areas_of_work' => $areas_of_work->id]) }}" class="btn btn-danger delete-post"
                                data-message="Are you sure you want to delete this team?">
                                    <i class="fas fa-trash"></i>
                                </a>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $model->links() }}
            </div>

        </div>
        </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @endsection
    @section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-post');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const url = button.getAttribute('href');
                    const message = button.getAttribute('data-message');

                    if (confirm(message)) {
                        const form = document.createElement('form');
                        form.setAttribute('method', 'POST');
                        form.setAttribute('action', url);
                        form.innerHTML = '<input type="hidden" name="_method" value="DELETE">' +
                                        '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
    @endsection
