@extends('layouts.appHome')
@push('styles')
    <style>
        .news_tick:hover{
            cursor: pointer;
        }
        .error {
    border-color: red;
}
.error {
    color: red;
}
    </style>
@endpush
<style>

</style>
@section('content')
<div class="container">
    <div class="row">
        <h4 style="text-align: center;">GOVERNMENT OF GILGIT-BALTISTAN<br> DIRECTORATE OF MINES & MINERALS
            </br> GILGIT-BALTISTAN</h4>
        <h5 class="text-center text-white" style="background-color:#05361c;width:60%;margin:auto;padding:7px">If your
            are already Registered please go to login Form
            <a href="/login"><span class="text-info">Login</span></a>
        </h5>

        <h5 style="text-align: center;text-decoration:underline">Application Form for Mineral Title</h5>


    </div>

    @if(session('error_message'))
    <div class="alert alert-danger">
        {{ session('error_message') }}
    </div>
    @endif


    @if ($errors->has('mysql_error'))
    <div class="alert alert-danger">
        {{ $errors->first('mysql_error') }}
    </div>
    @endif

    @if ($errors->has('error'))
    <div class="alert alert-danger">
        {{ $errors->first('error') }}
    </div>
    @endif
    <form id="registrationform" action="{{route('home.register_post')}}" method="POST" enctype="multipart/form-data" style="width:80%; margin:auto">
        {{csrf_field()}}
        <div class="row">
            <h3 class="mt-3"> 1. Applicant's Company /Firm Name </h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="authorize_person">Authorized Person Name:</label>
                <input id="authorize_person" type="text" name="authorize_person" value="{{ old('authorize_person') }}"
                    class="form-control @error('authorize_person') is-invalid @enderror" required
                    placeholder="Enter Authorized Person Name">
                @error('authorize_person')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="designation">Designation:</label>
                <input id="designation" type="text" name="designation" value="{{ old('designation') }}"
                    class="form-control @error('designation') is-invalid @enderror" required
                    placeholder="Enter Authorized Person Designation">
                @error('designation')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="cnic">Cnic No:</label>
                <input id="cnic" type="text" name="cnic" value="{{ old('cnic') }}"
                    class="form-control @error('cnic') is-invalid @enderror" required placeholder="Enter Authorized Person CNIC">
                @error('cnic')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="email">Email:</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror" required placeholder="Enter Company Email">
                @error('email')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="office_no">Office No:</label>
                <input id="office_no" type="text" name="office_no" value="{{ old('office_no') }}"
                    class="form-control @error('office_no') is-invalid @enderror" 
                    placeholder="Enter your Office No">
                @error('office_no')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="cell_no">Cell No:</label>
                <input id="cell_no" type="text" name="cell_no" value="{{ old('authorize_person') }}"
                    class="form-control @error('cell_no') is-invalid @enderror" required
                    placeholder="Enter Official Cell No">
                @error('cell_no')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

     
        <div class="row">
            <div class="col-md-6"> <h3 mt-3>2. Organization Details </h3></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="compname">Name of (Firm/Company):</label>
                <input id="compname" type="company_name" name="company_name" value="{{ old('company_name') }}"
                    class="form-control @error('company_name') is-invalid @enderror" required
                    placeholder="Enter Company Name">
                @error('company_name')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="business_address">Business Office Address:</label>
                <input id="business_address" type="text" name="business_address" value="{{ old('business_address') }}"
                    class="form-control @error('business_address') is-invalid @enderror" required
                    placeholder="Enter your Office Business address">
                @error('business_address')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="ntn_no">NTN No:</label>
                <input id="ntn_no" type="text" name="ntn_no" value="{{ old('ntn_no') }}"
                    class="form-control @error('ntn_no') is-invalid @enderror"  placeholder="Enter Your NTN No">
                @error('ntn_no')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="gst_no">GST NO:</label>
                <input id="gst_no" type="text" name="gst_no" value="{{ old('gst_no') }}"
                    class="form-control @error('gst_no') is-invalid @enderror"  placeholder="Enter your GST No">
                @error('gst_no')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="nature_business">Nature of Business:</label>
                <input id="nature_business" type="text" name="nature_business" value="{{ old('nature_business') }}"
                    class="form-control @error('nature_business') is-invalid @enderror" required
                    placeholder="Enter your Nature of Business">
                @error('nature_business')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <h3 class="mt-2 mb-2">3. Attached Company Documents </h3>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <label for="firm_registration">Firm/Company Registration Certificate:</label>
                <input id="firm_registration" type="file" name="firm_registration"
                    value="{{ old('firm_registration') }}"
                    class="form-control @error('firm_registration') is-invalid @enderror" required>
                @error('firm_registration')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="deed_partnership">Firm/Company Form/MOA/Deed Partnership:</label>
                <input id="deed_partnership" type="file" name="deed_partnership" value="{{ old('deed_partnership') }}"
                    class="form-control @error('deed_partnership') is-invalid @enderror" required
                    placeholder="Enter Your Firm Deed_partnership">
                @error('deed_partnership')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h3 class="mt-2 mb-2">4. Title Category </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-3">
                <label for="licence">Type of Concession:</label>
                <select id="licence" name="licence" value="{{ old('licence') }}"
                    class="form-control @error('licence') is-invalid @enderror" required>
                    <option value="">Select Status</option>
                    <option value="Reconnaissance">Reconnaissance License</option>
                    <option value="Exploration">Exploration License</option>
                    <option value="Mineral Deposit Retention">Mineral Deposit Retention License</option>
                    <option value="Minning">Minning lease </option>
                    <option value="Gem Stone Permit">Gem Stone Permit</option>
                    <option value="Registration of Traders">Registration of Traders</option>
                </select>
                @error('licence')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="name_mineral">Name of Mineral for which Title is required:</label>
                <input id="name_mineral" type="text" name="name_mineral" value="{{ old('name_mineral') }}"
                    class="form-control @error('name_mineral') is-invalid @enderror" required
                    placeholder="Enter Name of Mineral for which title is required">
                @error('name_mineral')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="location">Location:</label>
                <input id="location" type="text" name="location" value="{{ old('location') }}"
                    class="form-control @error('location') is-invalid @enderror" required
                    placeholder="Enter your Location">
                @error('location')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="covered_area">Covered Area:</label>
                <input id="covered_area" type="text" name="covered_area" value="{{ old('covered_area') }}"
                    class="form-control @error('covered_area') is-invalid @enderror" required
                    placeholder="Enter your Covered Area">
                @error('covered_area')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">

<div class="col-md-6">
<label for="district">District:</label>
<select  class="form-control" id="district" name="district">
    <option value="">Select District</option>
    @foreach($districts as $district)
        <option value="{{ $district->District }}">{{ $district->DistrictName }}</option>
    @endforeach
</select>
</div>

<div class="col-md-6">
<label for="tehsil">Tehsil:</label>
<select class="form-control" id="tehsil" name="tehsil">
    <option value="">Select Tehsil</option>
</select>
</div>
</div>
        <!-- <div class="row">
            <div class="col-md-12">
                <label>Coordinates:</label>

            </div>
        </div>
        <div class="row">
            <div id="coordinates-container">
                <div class="coordinates-group">
                    <div class="row">
                    <div class="col-md-6">
                        <label for="longitude_1">Longitude:</label>
                        <input type="text" id="longitude_1" name="longitudes[]" class="form-control" required
                            placeholder="Enter your Longitude">
                    </div>
                    <div class="col-md-6">
                        <label for="latitude_1">Latitude:</label>
                        <input id="latitude_1" type="text" name="latitudes[]" class="form-control" required
                            placeholder="Enter your Latitude">
                    </div>
                    </div>
                </div>
               
               
            </div>
            <div class="col-md-12 mt-2">
                    <button type="button" class="btn btn-small btn-primary" onclick="addField()">Add More Coordinates</button>
                </div>

        </div> -->
        <div class="row">
            <div class="col-md-6">
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" value="{{ old('password') }}"
                    class="form-control @error('password') is-invalid @enderror" required
                    placeholder="Enter your password">
                @error('password')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="password_confirmation">Confirm Password:</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    value="{{ old('password_confirmation') }}"
                    class="form-control @error('password_confirmation') is-invalid @enderror" required
                    placeholder="Confirm your password">
                @error('password_confirmation')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary mt-3">Register</button>
            </div>
        </div>
    </form>

</div>
<script>
let index = 1;

function addField() {
    index++;
    const container = document.getElementById('coordinates-container');
    const newField = document.createElement('div');
    newField.classList.add('coordinates-group');
    
    newField.innerHTML = `
                <div class="row mt-1">
                <div class="col-md-6">
                   <!-- <label for="longitude_${index}">Longitude:</label> -->
                    <input type="text" id="longitude_${index}" name="longitudes[]" class="form-control" required placeholder="Enter your Longitude ${index}">
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <!-- <label for="latitude_${index}">Latitude:</label> -->
                    <input id="latitude_${index}" type="text" name="latitudes[]" class="form-control" required placeholder="Enter your Latitude ${index}">
                 <div class=" btn btn-small btn-primary ml-auto" onclick="removeField(this)">X</div>
                    </div>
                
           
               
                </div>
            `;
    container.appendChild(newField);
}

function removeField(element) {
    var coordinatesGroup = element.closest('.coordinates-group');
            
            // Remove that parent div from the DOM
            if (coordinatesGroup) {
                coordinatesGroup.remove();
            }
}
</script>

    <script type="text/javascript">
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


/// jquery validation and masking


 // Apply input mask for cell_no (Allows + followed by 15 digits)
                $('#cell_no').inputmask({
                        mask: '[+]{0,1}99999999999[9][9][9][9]',  // Max 15 digits with an optional + sign
                        placeholder: '___________', // Optional placeholder
                        showMaskOnHover: false
                    });

            $('#cnic').inputmask('99999-9999999-9', { placeholder: "--_" });
            $('#registrationform').validate({
                rules: {
                    cnic: {
                        required: true,
                        minlength: 15, // The exact length of the masked input
                        maxlength: 15  // Ensures the input matches the exact mask length
                    },
                 cell_no: {
                required: true,
                minlength: 11, // At least 11 digits (without the +)
                maxlength: 16 // 16 to account for the + and 15 digits
            },
                },
                messages: {
                    cell_no: {
                required: "Please enter your cell number",
                minlength: "Cell number must be at least 11 digits long",
                maxlength: "Cell number can't exceed 15 digits"
            },
                    cnic: {
                        required: "Please enter your name",
                         minlength: "Please enter the full format #####-#######-#",
                    maxlength: "Please enter the correct format #####-#######-#"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter a password",
                        minlength: "Password must be at least 6 characters long"
                    }
                }
            });
     
  








            // end document ready
        });
    </script>

@endsection


