@extends('layouts.leaseApplications')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">My Applications</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">My Applications</a></li>
              <li class="breadcrumb-item active">New Application</li>
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
              New Application Form
            </h3>
                </div>
            <div class="card-body multi_step_form" style="overflow:auto;">
                <form id="registrationform" action="{{ route('new_applications.new_application_store') }}" method="POST" enctype="multipart/form-data" >
                    {{  csrf_field() }}

                    <!-- <div class="row mt-4">
                        
                    <ul id="progressbar">
                    <li class="active">Verify Phone</li>  
                    <li>Upload Documents</li> 
                    <li>Security Questions</li>
                    </ul>
                    </div> -->
                    <div class="row">
                        <div class="col-md-12  bg-secondary">
                            <div class="card-title">
                                <h3 class="mt-2 mb-2">Attached Company Documents</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label for="firm_registration">Firm/Company Registration Certificate:</label>
                            <input id="firm_registration" type="file" name="firm_registration" value="" class="form-control @error('firm_registration') is-invalid @enderror" >
                            @error('firm_registration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="deed_partnership">Firm/Company Form/MOA/Deed Partnership:</label>
                            <input id="deed_partnership" type="file" name="deed_partnership" value="" class="form-control @error('deed_partnership') is-invalid @enderror" placeholder="Enter Your Firm Deed_partnership">
                            @error('deed_partnership')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-12  bg-secondary">
                            <div class="card-title">
                                <h3 class="mt-2 mb-2">Title Category</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mt-3">
                            <label for="licence">Type of Concession:</label>
                            <select id="licence" name="licence" value="" class="form-control @error('licence') is-invalid @enderror" fdprocessedid="s6mqn">
                                <option value="">Select Status</option>
                                <option value="Reconnaissance">Reconnaissance License</option>
                                <option value="Exploration">Exploration License</option>
                                <option value="Mineral Deposit Retention">Mineral Deposit Retention License</option>
                                <option value="Minning">Minning lease </option>
                                <option value="Gem Stone Permit">Gem Stone Permit</option>
                                <option value="Registration of Traders">Registration of Traders</option>
                            </select>
                            @error('licence')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="name_mineral">Name of Mineral for which Title is required:</label>
                            <input id="name_mineral" type="text" name="name_mineral" value="" class="form-control @error('name_mineral') is-invalid @enderror"  placeholder="Enter Name of Mineral for which title is required" fdprocessedid="z92vz">
                            @error('name_mineral')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="location">Location:</label>
                            <input id="location" type="text" name="location" value="" class="form-control @error('location') is-invalid @enderror"  placeholder="Enter your Location" fdprocessedid="9045rq">
                            @error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="covered_area">Covered Area:</label>
                            <input id="covered_area" type="text" name="covered_area" value="" class="form-control @error('covered_area') is-invalid @enderror" placeholder="Enter your Covered Area" fdprocessedid="mn6ilc">
                            @error('covered_area')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                        <label for="district">District:</label>
                        <select class="form-control @error('district') is-invalid @enderror" id="district" name="district" fdprocessedid="mge2rf">
                            <option value="">Select District</option>
                                    <option value="10">Astore</option>
                                    <option value="11">Diamer</option>
                                    <option value="12">Ghanche</option>
                                    <option value="13">Ghizar</option>
                                    <option value="14">Gilgit</option>
                                    <option value="15">Hunza</option>
                                    <option value="16">Kharmang</option>
                                    <option value="17">Nagar</option>
                                    <option value="18">Shigar</option>
                                    <option value="19">Skardu</option>
                            </select>
                            @error('district')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    <div class="col-md-6">
                    <label for="tehsil">Tehsil:</label>
                    <select class="form-control @error('tehsil') is-invalid @enderror" id="tehsil" name="tehsil" fdprocessedid="qtd85k">
                        <option value="">Select Tehsil</option>
                    </select>
                    @error('tehsil')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                    </div>
                </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-danger mt-3" fdprocessedid="aum7e7">Submit New Application</button>
                </div>
            </div>
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
<script>
    $(document).ready(function() {
        $('#district').on('change', function() {
            var districtId = $(this).val();
            if(districtId) {
                $.ajax({
                    url: '/tehsils/' + districtId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#tehsil').empty();
                        $('#tehsil').append('<option value="">Select Tehsil</option>');
                        $.each(data, function(key, value) {
                            $('#tehsil').append('<option value="'+ value.Tehsil +'">'+ value.TehsilName +'</option>');
                        });
                    }
                });
            } else {
                $('#tehsil').empty();
                $('#tehsil').append('<option value="">Select Tehsil</option>');
            }
        });
    });
    </script>
@endsection
