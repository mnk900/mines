@extends('layouts.leaseApplications')


<link href="https://fonts.googleapis.com/css2?family=Carlito:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

<style>

  @media print {
    @page {
      size: A4 landscape; /* Set page orientation to landscape */
      margin: 20mm; /* Adjust margins as needed */
    }

    /* Additional print styles */
    body {
      margin: 0;
      padding: 0;
    }

    .no-print {
      display: none; /* Hide elements not needed in print */
    }
  }

        p{
            font-family: "Carlito", system-ui;
            margin: 7px 0px;
        }


        td {
            border-right: solid 1px;
            font-family: "Carlito", system-ui;
            padding-left: 7px;
        }
        strontg{
            font-family: "Carlito", system-ui;
        }

        .underline {
            text-decoration: underline dotted 2px;
            padding-left: 5px;

        }
        .texunderline{
            text-decoration: underline 1px;


        }

.card-body.user-profile h3 {
    width: 100%;
    margin-bottom: 20px;
}

@keyframes blink {
    0% {
        opacity: 1;
    }

    50% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }
}

.blinking-text {
    text-align: center;
    margin-top: 20%;
    font-size: 24px;
    color: green;
    animation: blink 1s infinite;
}
</style>

<style>
.section-heading {
    background-color: #f8f9fa;
    padding: 10px;
    border-left: 5px solid #007bff;
    margin-top: 20px;
    margin-bottom: 20px;
    font-weight: bold;
    font-size: 1.5rem;
}

.section-heading span {
    font-size: 1.25rem;
    color: #007bff;
}

.card-body p {
    margin-bottom: 10px;
}

.card-body a {
    color: #007bff;
    text-decoration: none;
}

.card-body a:hover {
    text-decoration: underline;
}
</style>

@section('content')
<!-- Main content -->
<section class="content">

    <div class="container">
        <div class="clearfix blog-list">

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif



            <div class="container mt-2">


            <div>

            <div class="row">
            <div class="col-md-12">
            <h1 class="text-center">Generate Challan</h1>
            <p class="text-center">Select the application and challan type and click submit button. Your online challan would be generated.
                After a challan is generated hit save button to get a soft copy of challan. Download the saved challan through save button and
                after submitting your challan fee upload it in our portal as soon as possible.
            </p>
            </div>

            <div class="col-md-4">

            <form class="form-group" id="challanFeeForm" action="getchallanfee" method="get">
        @csrf
        <label for="challanfee">Select Challan:</label>
        <select class="form-control" name="challanfee" id="challanfee">
            <option value="">Select Challan Type</option>
            @foreach($challanfees as $challanfee)
                <option value="{{ $challanfee->id }}">{{ $challanfee->fee_title }}</option>
            @endforeach
        </select>
            </div>
            <div class="col-md-4">
        <label for="applicationid">Select Your Application:</label>
        <select class="form-control" name="applicationid" id="applicationid">
            <option value="">Application</option>
            @foreach($applicantcompleteData as $applications)
                <option value="{{ $applications->applicationid }}">{{ $applications->licence_for }} licence for {{ $applications->name_mineral }} at {{ $applications->location }}</option>
            @endforeach
        </select>
                </div>
                <div class="col-md-12">
        <button class="btn btn-primary" id="submitButton" type="submit" >Generate Challan</button>
        <button class="btn btn-success" id="printButton"  >Save & Print Challan</button>
    </form>

            </div>
            </div>
            <div id="printArea">
                 <table class="mt-1" style="border:1px solid;">
                 <colgroup>
                    <col>
                    <col>
                    <col>
                </colgroup>
                <tbody>
                 <tr>
                    <td colspan="3" style="border-bottom:1px solid;">
                        <p style="text-align: center;font-weight:bold">DEPARTMENT OF MINES &amp; MINERALS GOVERNMENT OF GILGIT-BALTISTAN</p>
                    </td>
                 </tr>
                <tr>
                    <td style="border-bottom:1px solid;text-align: center;">
                        <p style="text-decoration:underline"><strong>Applicant Copy</strong></p>
                        <div class="qrcode" style="dislay:inline-block; width:100px; height:100px; margin:auto;">{!! $barcode !!}</div>
                        <p><strong>Fee Challan</strong></p>

                    </td>
                    <td style="border-bottom:1px solid;text-align: center;">
                        <p style="text-decoration:underline"><strong>Bank Copy</strong></p>
                        <div  class="qrcode" style="dislay:inline-block; width:100px; height:100px; margin:auto;">{!! $barcode !!}</div>
                        <p><strong>Fee Challan</strong></p>
                    </td>
                    <td style="border-bottom:1px solid;text-align: center;">
                        <p style="text-decoration:underline"><strong>Department Copy</strong></p>
                        <div  class="qrcode" style="dislay:inline-block; width:100px; height:100px; margin:auto;">{!! $barcode !!}</div>
                        <p><strong>Fee Challan</strong></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><strong>Account Title:</strong><strong class="bankaccount underline" style="margin-left: 10px;"></strong></p>

                        <p><strong>Account No: </strong><strong class="accountno underline" style="margin-left: 10px;"></strong></p>

                        <p><strong>Date:</strong>……………………………..</p>
                        <p><strong>M/S: </strong><strong class="company_name  underline" style="margin-left: 10px;"></strong></p>

                        <p>…………………………………………………………………………</p>
                        <p><strong>Type of Mineral Concession: </strong><strong class="concession  underline" style="margin-left: 10px;"></strong></p>

                        <p><strong>Area: </strong><strong class="area  underline" style="margin-left:10px;"></strong></p>

                        <p><strong>Location: </strong><strong class="location  underline" style="margin-left:10px;"></strong></p>

                        <p><strong>Type of Fee:</strong> <strong class="typefee  underline" style="margin-left:10px;"> <span  class="challanTitle ms-3"></span></strong></p>

                        <p><strong>Amount Rs: </strong><strong><span class="challanFee  underline"></span></strong></p>
                        <p><strong>Amount In Words:</strong><strong><span class="challanFeeInWords underline"></span></strong></p>
                    </td>
                    <td>
                        <p><strong>Account Title</strong><strong class="bankaccount underline" style="margin-left:10px;"></strong></p>

                        <p><strong>Account No: </strong><strong class="accountno underline" style="margin-left:10px;"></strong></p>

                        <p><strong>Date:</strong>……………………………..</p>
                        <p><strong>M/S: </strong><strong class="company_name underline" style="margin-left:10px;"></strong></p>

                        <p>…………………………………………………………………………</p>
                        <p><strong>Type of Mineral Concession: </strong><strong class="concession underline" style="margin-left:10px;"></strong></p>

                        <p><strong>Area: </strong><strong class="area underline" style="margin-left:10px;"></strong></p>

                        <p><strong>Location: </strong><strong class="location underline" style="margin-left:10px;"></strong></p>

                        <p><strong>Type of Fee:</strong> <strong class="feetype underline" style="margin-left:10px;"> <span  class="challanTitle ms-3"></span></strong> </p>

                        <p><strong>Amount Rs: </strong><strong><span class="challanFee underline"></span></strong></p>
                        <p><strong>Amount In Words:</strong><strong><span class="challanFeeInWords underline"></span></strong></p>
                    </td>
                    <td>

                        <p><strong>Account Title</strong><strong class="bankaccount underline" style="margin-left:10px;"></strong></p>

                        <p><strong>Account No: </strong><strong class="accountno underline" style="margin-left:10px;"></strong></p>

                        <p><strong>Date:</strong>……………………………..</p>
                        <p><strong>M/S: </strong><strong class="company_name underline" style="margin-left:10px;"></strong></p>

                        <p>…………………………………………………………………………</p>
                        <p><strong>Type of Mineral Concession: </strong><strong class="concession underline" style="margin-left:10px;"></strong></p>

                        <p><strong>Area: </strong><strong class="area underline" style="margin-left:10px;"></strong></p>

                        <p><strong>Location: </strong><strong class="location underline" style="margin-left:10px;"></strong></p>

                        <p><strong>Type of Fee:</strong> <strong class="feetype underline" style="margin-left:10px;"> <span id="challanTitle" class="challanTitle ms-3"></span></strong> </p>

                        <p><strong>Amount Rs:</strong><strong><span class="challanFee underline"></span></strong></p>
                        <p><strong>Amount In Words:</strong><strong><span class="challanFeeInWords underline"></span></strong></p>


                    </td>


                </tr>
                <tr>
                    <td>
                        <p style="text-align: center;"><strong class="texunderline">For Bank Use Only</strong></p>

                        <p>Received Payment Rs………………</p>

                        <p>Sig &amp; Stamp Bank Officer</p>

                        <p> ________________________</p>


    <table class="table table-bordered">
        <thead>
            <tr>

                <th>#</th>
                <th>Longitude</th>
                <th>Latitude</th>
            </tr>
        </thead>
        <tbody>
        <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
                    </td>
                    <td>
                        <p style="text-align: center;"><strong class="texunderline">For Bank Use Only</strong></p>

                        <p>Received Payment Rs………………</p>

                        <p>Sig &amp; Stamp Bank Officer</p>

                        <p> _____________________</p>


    <table class="table table-bordered">
        <thead>
            <tr>

                <th>#</th>
                <th>Longitude</th>
                <th>Latitude</th>
            </tr>
        </thead>
        <tbody>
        <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
                    </td>
                    <td>
                        <p style="text-align: center;"><strong class="texunderline">For Bank Use Only</strong></p>

                        <p>Received Payment Rs………………</p>

                        <p>Sig &amp; Stamp Bank Officer</p>

                        <p> ___________________________</p>



    <table class="table table-bordered">
        <thead>
            <tr>

                <th>#</th>
                <th>Longitude</th>
                <th>Latitude</th>
            </tr>
        </thead>
        <tbody>
        <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td></td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
                    </td>
                </tr>
            </tbody>
        </table>

        <p>……………………………………………………………………………………………………………………………………………………………….....................................................................</p>

        <p><strong>Note</strong><strong>: </strong><strong>-</strong> Coordinates of the area should be mentioned in back side of the challan, and submit the fee challan online within one week after deposition in the bank. Otherwise, the challan will be considered as null and wide.</p>


</div>



                <div class="col-md-12">

                <div class="container mt-5">
                <h2 class="mb-4">Your Existing Challans</h2>
                <table class="table table-bordered">
                <thead class="thead-light" style="font-size: smaller;">
                <tr>
                    <th> ID</th>
                    <th>Challan Title</th>
                    <th>Challan Fee</th>
                    <th>Bank Name</th>
                    <th>Account No</th>
                    <th>Company Name</th>
                    <th>Location</th>
                    <th>Mineral Concession</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody id="challanTableBody">
                <!-- Rows will be dynamically inserted here -->
                </tbody>
                </table>
                </div>

                </div>
    </div>
                    </div>
                </div>
            </div>


            <!-- Verify Modal End-->
            <hr class="invis" />

        </div>
        <!-- end blog-list -->
    </div>

    </div>



</section>

@endsection



@push('scripts')
<script>



    var comp_id="";
    var challan_type="";
    var account_no="";
    var type_of_concession="";
    var application_id="";
    var account_title="";
    var email = {!! json_encode($user_email) !!};
        $('#printButton').on('click', function() {

            var qr = "{{ $ranAl }}";

            var formData = {
                application_id: application_id,
                account_no: account_no,
                challan_type: challan_type,
                bank_name: account_title,
                type_of_concession: type_of_concession,
                qr_code: qr,
                company_id: comp_id,
                _token: '{{ csrf_token() }}' // Include CSRF token for security
            };
            console.log(formData);

    // AJAX request to save data
    $.ajax({
        url: '{{ route('challan.save') }}', // Define your route
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                printDiv('printArea');
                window.location.href = '/applications/leaseapplications/' + encodeURIComponent(email);

            } else {
                alert('Failed to save data.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });

    function printDiv(divId) {
    var contentToPrint = document.getElementById(divId).innerHTML;
    var originalContent = document.body.innerHTML;

    document.body.innerHTML = contentToPrint;
    window.print();
    document.body.innerHTML = originalContent;
}
});

// Get existing challan details
$(document).ready(function() {

    $.ajax({
        url: '{{ route('getExistingchallans') }}',
        type: 'GET',
        data: {},
        success: function(response) {
            console.log(response); // For debugging
            const tableBody = document.getElementById('challanTableBody');
            tableBody.innerHTML = ''; // Clear previous data

            // Assuming the response is in the format you expect
            const responseData = response.data; // Adjust this based on your actual response structure
            console.log(responseData);
            // Check if there are records
            if (!responseData || responseData.length === 0) {
                tableBody.innerHTML = '<tr><td colspan="13">No records found.</td></tr>';
                return;
            }


            responseData.forEach((record, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${record.challan_title}</td>
                    <td>${record.challan_fee}</td>
                    <td>${record.bank_name}</td>
                    <td>${record.account_no}</td>
                    <td>${record.company_name}</td>
                    <td>${record.location}</td>
                    <td>${record.mineral_concession}</td>
                    <td>${record.created_at}</td>
                `;
                tableBody.appendChild(row);
            });
        },
        error: function(xhr) {
            console.error('Error:', xhr.responseText); // Log error details
            alert('Challan fee was not found!');
        }
    });
});


        $(document).ready(function() {


            // Capture form submission
            $('#challanFeeForm').on('submit', function(event) {
                event.preventDefault();


                // Get the selected challan fee ID
                var challanfeeId = $('#challanfee').val();
                var applicationId = $('#applicationid').val();

                if (challanfeeId && applicationId) {
                    // Make an AJAX request to fetch challan details
                    $.ajax({
                        url: '{{ route('getchallanfee') }}',
                        type: 'GET',
                        data: {
                            challanfeeId: challanfeeId,
                            applicationId: applicationId
                        },
                        success: function(response) {
                            // Update the page with the response data

                            console.log(response);
                            $('.challanId').text(response.challan_id);
                            $('.challanTitle').text(response.challan_title);
                            $('.challanFee').text(response.challan_fee);
                            $('.challanFeeInWords').text(response.amount_in_words);
                            $('.bankaccount').text(response.bank_name);
                            $('.accountno').text(response.account_no);
                            $('.area').text(response.area +' Km');
                            $('.location').text(response.location);
                            $('.concession').text(response.mineral_concession);
                            $('.feetype').text(response.challan_title);
                            $('.company_name').text(response.company_name);
                             comp_id = response.company_id;
                              challan_type= response.challan_id;
                                 account_no=response.account_no;
                                 type_of_concession=response.mineral_concession;
                                 application_id=response.application_id;
                                 account_title=response.bank_name;


                        },
                        error: function(xhr) {
                            // Handle errors (e.g., if challan not found)
                            alert('Challan fee was not  found!');
                        }
                    });
                } else {
                    alert('Please select a challan type.');
                }
            });




        });
    </script>

@endpush
