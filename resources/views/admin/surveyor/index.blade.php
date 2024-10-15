@extends('layouts.leaseAppadmin')
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
            <div class="col-lg-4 col-6">
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
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $verifiedApplicationsCount }}</h3>

                        <p>Verified Applications</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <a href="{{ route('events.index') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $unVerifiedApplicationsCount }}</h3>

                        <p>Un Verified</p>
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
                    <th>License Type</th>
                    <th>Application Date</th>
                    <th>Received Date</th>
                    <th>Forwarded By</th>
                    <th>view</th>
                    <th>To Director</th>
                </tr>
            </thead>
            <tbody>


                @foreach ($surveyApplications as $key=>$apps)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td><a
                            href="{{ route('applicationsurveydetails',['id'=>$apps->appsid]) }}">{{ $apps->company_name }}</a>
                    </td>
                    <td>{{ $apps->licence_for }}</td>
                    <td>{{ $apps->created_at }}</td>
                    <td>{{$apps->sent_on}} </td>
                    <td>{{ $apps->name }}</td>
                    <td>
                        <a href="{{ route('applicationsurveydetails',['id'=>$apps->appsid]) }}" class="btn btn-primary"><i
                                class="fas fa-eye"></i></a>

                    </td>
                    <td>
                        @if(is_null($apps->app_sent_to_director))
                        <form action="{{ route('sendtodirector') }}" method="POST">
                            @csrf
                            <!-- Hidden fields to pass data -->
                            <input type="hidden" name="application_id" value="{{$apps->appsid}}">
                            <input type="hidden" name="sent_by" value="{{auth()->user()->id}}">
                            <input type="hidden" name="survey_id" value="{{$apps->survey_id}}">

                            <!-- The button that submits the form -->
                            <button class="btn btn-primary" type="submit">Send</button>
                        </form>
                        @else
                        <span>Sent to Director</span>
                        @endif

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>




</section>
<!-- /.content -->
@endsection