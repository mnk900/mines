@extends('layouts.leaseAppAdmin')
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
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if (session('status'))
        <div class="alert alert-success">
            <p>{{ session('status') }}</p>
        </div>
        @endif
        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- These display challan related errors -->
@if (session('errors'))
   
        @foreach (session('errors') as $error)
        <div class="alert alert-danger">
            <p>{!! $error !!}</p>
            </div>
        @endforeach
   
@endif

        <!-- Small boxes (Stat box) -->
        <div class="row">

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalApplicationsCount }}</h3>

                        <p>Total Applications</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <a href="{{ route('blog.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $DirectorApplicationsCount }}</h3>

                        <p> Applications At Director Desk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <a href="{{ route('events.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $AdApplicationsCount }}</h3>

                        <p>Applications At AD Desks</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <a href="{{ route('images.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $SurveyApplicationsCount }}</h3>

                        <p>Applications At Surveyor Desk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <a href="{{ route('images.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row"></div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->

    <div class="card-body" style="overflow:auto;">
        <!-- <div class="float-right mt-2 mb-3">
                    <form class="form-inline">
                        <input type="text" class="form-control" name="search" placeholder="Search Areas of Work">
                        <button type="submit" class="btn btn-primary ml-1">Search Partners</button>
                    </form>
                </div> -->
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Company Name</th>
                    <th>Licence For</th>
                    <th>Mineral </th>
                    <th>Company Documents</th>
                    <th>Partnership Documents</th>
                    <th>Challan Documents</th>
                    <th>Surveyor Comments</th>
                    <th>view</th>
                    <th>surveyor</th>
                </tr>
            </thead>
            <tbody>


                @foreach ($leaseapplications as $key=>$apps)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td><a
                            href="{{ route('applicationsdetails',['email'=>$apps->email]) }}">{{ $apps->company_name }}</a>
                    </td>
                    <td>{{ $apps->licence_For }}</td>
                    <td>{{ $apps->name_mineral }}</td>
                    <td>{{$apps->deed_partnership_comment}}
                            
                    </td>
                    <td>{{ $apps->company_registration_comment }}</td>
                    <td>{{ $apps->coordinates_comment }}</td>
                   
                    <td>
                        {{$apps->challan_comment}}
                    

                    </td>
                    <td>
                        <a href="{{ route('applicationsdetails',['email'=>$apps->email]) }}" class="btn btn-primary"><i
                                class="fas fa-eye"></i></a>

                    </td>
                    <td>
                        <a href="{{ route('applicationsdetails',['email'=>$apps->email]) }}" class="btn btn-primary"><i
                                class="fas fa-eye"></i></a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>




</section>
<!-- /.content -->
@endsection