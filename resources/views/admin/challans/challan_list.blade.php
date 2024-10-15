@extends('layouts.LeaseAppAdmin')
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

      <!-- Small boxes (Stat box) -->
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
          Applications
        </h3>
                <div class="float-right">
                    <a class="btn btn-danger"  href="{{ route('new_applications.new_application')}}"><i class="fa fa-plus text-white"></i> New Application </a>
                </div>
            </div>
        <div class="card-body" style="overflow:auto;">
            <div class="float-right mt-2 mb-3">
                <form class="form-inline">
                    <input type="text" class="form-control" name="search" placeholder="Search Challans">
                    <button type="submit" class="btn btn-primary ml-1">Search</button>
                </form>
            </div>
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Company</th>
                <th>Challan QR Code</th>
                <th>Challan Generated On</th>
                <th>Is Challan Valid?</th>
                <th>Is Amount Paid?</th>
                <th>Amount Paid(PKR)</th>
                <th>Payment Date</th>
                <th>Is Payment Verified?</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $key=>$result)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $result->company_name }}</td>
                    <td>
                        <a href="{{ route('admin.challans.challan_details',["qr_code"=>$result->qr_code]) }}">
                            {{ $result->qr_code }}
                        </a>
                    </td>
                    <td>
                        @if(!is_null($result->created_on))
                        {{ \Carbon\Carbon::parse($result->created_on)->format('j F Y H:i') }}
                       @endif
                    </td>
                    <td>
                        @if($result->challan_active==1)
							<span class="badge badge-success" style="width: 100%;">Yes
                            </span>
                        @else
                            <span class="badge badge-danger" style="width: 100%;">No
                            </span>
                        @endif

                    </td>
                    <td>
                        @if($result->challan_uploaded==1)
							<span class="badge badge-success" style="width: 100%;">Yes
                            </span>
                        @else
                            <span class="badge badge-danger" style="width: 100%;">No
                            </span>
                        @endif
                    <td>{{ $result->fee_amount }}</td>
                    <td>
                        @if(!is_null($result->fee_paid_on))
                        {{ \Carbon\Carbon::parse($result->fee_paid_on)->format('j F Y') }}
                       @endif
                    </td>
                    <td>
                        @if($result->fee_verified==1)
							<span class="badge badge-success" style="width: 100%;">Yes
                            </span>
                        @else
                            <span class="badge badge-danger" style="width: 100%;">No
                            </span>
                        @endif
                    <td>
                        <a class="btn btn-info" href="{{ route('admin.challans.challan_details',["qr_code"=>$result->qr_code]) }}">
                           <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

</div>
</div>
      </div>
      </div>
  </section>
  <!-- /.content -->
@endsection
