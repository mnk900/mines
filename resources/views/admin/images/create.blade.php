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
              <li class="breadcrumb-item"><a href="{{ route('images.index') }}">Gallagery Images</a></li>
              <li class="breadcrumb-item active">Create</li>
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
            <div class="card">
                <div class="card-header bg-info">
                        <h3 class="card-title">
              <i class="fa fa-users mr-1"></i>
              Create Gallery Image
            </h3>
                    <div class="float-right">
                            <a href="{{ route('admin.index')}}" class="btn btn-danger text-white p-2">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                Dashboad
                            </a>
                    </div>
                </div>
            <div class="card-body" style="overflow:auto;">
                {{-- <h1>Create New</h1> --}}
                    <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                        @include('admin.images.partials.fields')
                    </form>
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
    @endsection

