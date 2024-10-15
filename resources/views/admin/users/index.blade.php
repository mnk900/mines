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
              <li class="breadcrumb-item active">Users</li>
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
              Users Managment
            </h3>
                    <div class="float-right">
                            <a href="{{ route('admin.index')}}" class="btn btn-danger text-white p-2">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                Dashboad
                            </a>
                            <a class="btn btn-danger"  href="{{ route('users.create')}}"><i class="fa fa-plus text-white"></i></a>
                    </div>
                </div>
            <div class="card-body" style="overflow:auto;">
                <div class="float-right mt-2 mb-3">
                    <form class="form-inline">
                        <input type="text" class="form-control" name="search" placeholder="Search Users">
                        <button type="submit" class="btn btn-primary ml-1">Search</button>
                    </form>
                </div>
                <table class="table table-sm table-striped" >
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($model as $key=>$user)
                    <tr>
                        <td>{{ $key++ }}</td>
                        <td><a href="{{ route('users.edit',['user'=>$user->id]) }}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ implode(',',$user->roles()->get()->pluck('name')->toArray()) }}</td>
                        <td>
                            <a href="{{ route('users.edit',['user'=>$user->id]) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-delete" data-url=""><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $data->render() }} --}}
            </div>
            {{ $model->links() }}
        </div>
        </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @endsection
