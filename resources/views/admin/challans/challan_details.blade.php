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
      @if (session('status'))
                  <div class="alert alert-success">
              <p>{{ session('status') }}</p>
                  </div>
              @endif
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
          <i class="fa fa-receipt mr-1"></i>
          Challans Verification
        </h3>
                {{-- <div class="float-right">
                    <a class="btn btn-danger"  href="{{ route('new_applications.new_application')}}"><i class="fa fa-plus text-white"></i> New Application </a>
                </div> --}}
            </div>
        <div class="card-body" style="overflow:auto;">
            <div class="float-right mt-2 mb-3">
                {{-- <form class="form-inline">
                    <input type="text" class="form-control" name="search" placeholder="Search Challans">
                    <button type="submit" class="btn btn-primary ml-1">Search</button>
                </form> --}}
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center mt-2">Compare and Verify Challans</h3>
                    <p class="text-center">Please see the following System Generated and Orignal Submitted challan to verify that the application challan fees has been submitted. </p>
                    <form class="form-controle" method="POST" action="{{ route("admin.challan_fee_verify") }}">
                        @csrf

                        <table class="table" style="width:50%">
                            <tr>
                                <th>
                                    Challan Fee Paid(Amount in PKR):
                                </th>
                                <td>
                                    <input class="form-control" name="fee_amount_submitted" type="text" value="{{ old('fee_amount_submitted',$results[0]->fee_paid) }}">
                                    <input class="form-control" name="qr_code" type="hidden" value="{{ $results[0]->qr_code }}">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Challan Fee Submission Date:
                                </th>
                                <td>
                                    <input class="form-control" name="fee_submitted_date" type="date" value="{{ old('fee_submitted_date',\Carbon\Carbon::parse($results[0]->fee_paid_on)->format('Y-m-d')) }}">
                                </td>
                            </tr>
                            <tr>
                                <th>Challan Fee Verified:</th>
                                <td><div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fee_verify" value="1" {{ $results[0]->fee_verified == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label">Yes</label>
                                  </div>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <input type="submit" class="text-center btn btn-info" value="Verify">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="col-md-6">
                <div id="printArea">
                    <table class="mt-1" style="border:1px solid;">
                    <colgroup>
                        <col>
                        <col>
                        <col>
                    </colgroup>
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center" style="text-decoration: underline">System Generated Challan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="3" style="border-bottom:1px solid;">
                            <p style="text-align: center;font-weight:bold; margin:5px;">DEPARTMENT OF MINES &amp; MINERALS GOVERNMENT OF GILGIT-BALTISTAN</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom:1px solid;text-align: center;">
                            <p style="text-decoration:underline"><strong>Applicant Copy</strong></p>
                            <div class="qrcode" style="dislay:inline-block; width:100px; height:100px; margin:auto;">
                            {!! $qr_code !!}
                            </div>
                            <p><strong>Fee Challan</strong></p>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><strong>Account Title:</strong><strong class="bankaccount underline" style="margin-left: 10px;">{{ $results[0]->account_title }}</strong></p>

                            <p><strong>Account No: </strong><strong class="accountno underline" style="margin-left: 10px;">{{ $results[0]->account_no }}</strong></p>

                            <p><strong>Date:</strong>……………………………..</p>
                            <p><strong>M/S: </strong><strong class="company_name  underline" style="margin-left: 10px;">{{ $results[0]->company_name }}</strong></p>

                            <p>…………………………………………………………………………</p>
                            <p><strong>Type of Mineral Concession: </strong><strong class="concession  underline" style="margin-left: 10px;">{{ $results[0]->type_of_concession }}</strong></p>

                            <p><strong>Area: </strong><strong class="area  underline" style="margin-left:10px;">{{ $results[0]->covered_area }}</strong></p>

                            <p><strong>Location: </strong><strong class="location  underline" style="margin-left:10px;">{{ $results[0]->location }}</strong></p>

                            <p><strong>Type of Fee:</strong> <strong class="typefee  underline" style="margin-left:10px;"> <span  class="challanTitle ms-3"></span>{{ $results[0]->fee_title }}</strong></p>

                            <p><strong>Amount Rs: </strong><strong><span class="challanFee  underline"></span>{{ $results[0]->fee_amount }}</strong></p>
                            <p><strong>Amount In Words:</strong><strong><span class="challanFeeInWords underline"></span>{{ $results[0]->fee_amount_in_words }}</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="text-align: center;"><strong class="texunderline">For Bank Use Only</strong></p>

                            <p>Received Payment Rs………………</p>

                            <p>Sig &amp; Stamp Bank Officer</p>

                            <p> ________________________</p>
                        </td>
                    </tr>
                </tbody>
                </table>
                </div><!--printAreaDiv !-->
                </div>
                <div class="col-md-6">
                    <table class="mt-1" style="border:1px solid;">
                        <thead>
                            <tr>
                                <th class="text-center" style="text-decoration: underline;">Original Challan Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border-bottom:1px solid;">
                                    <p style="text-align: center;font-weight:bold;margin:5px;">DEPARTMENT OF MINES &amp; MINERALS GOVERNMENT OF GILGIT-BALTISTAN</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                @if($results[0]->challan_form)
                                    <img src="{{ Storage::url($results[0]->challan_form) }}" style="width: 90px; height: auto;" />
                                @else
                                <p>Not uploaded</p>
                                @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!--row !-->

</div>

</div>
</div>
      </div>
      </div>
  </section>
  <!-- /.content -->
@endsection
