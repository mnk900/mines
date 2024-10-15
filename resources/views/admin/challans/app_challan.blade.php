<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    
<link href="https://fonts.googleapis.com/css2?family=Carlito:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

</head>

<body>
    <style>
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

        .unerline {
            text-decoration: underline dotted 2px;
            padding-left: 5px;

        }
        .texunerline{
            text-decoration: underline 1px;
           

        }
    </style>

    <div>
        <table style="border:1px solid;">
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

                        <p><strong>Fee Challan</strong></p>
                    </td>
                    <td style="border-bottom:1px solid;text-align: center;">
                        <p style="text-decoration:underline"><strong>Bank Copy</strong></p>

                        <p><strong>Fee Challan</strong></p>
                    </td>
                    <td style="border-bottom:1px solid;text-align: center;">
                        <p style="text-decoration:underline"><strong>Department Copy</strong></p>

                        <p><strong>Fee Challan</strong></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><strong>Account Title</strong><strong class="unerline">{{$applicantdata[0]->authorize_person;}}</strong></p>

                        <p><strong>Account No: </strong><strong class="unerline">{{$applicantdata[0]->ntn_no;}}</strong></p>

                        <p><strong>Date:</strong>……………………………..</p>
                        <p><strong>M/S: </strong><strong class="unerline">{{$applicantdata[0]->company_name;}}</strong></p>

                        <p>…………………………………………………………………………</p>
                        <p><strong>Type of Mineral Concession: </strong><strong class="unerline">{{$applicantdata[0]->nature_business ;}}</strong></p>

                        <p><strong>Area: </strong><strong class="unerline">{{$applicantdata[0]->covered_area;}}</strong></p>

                        <p><strong>Location: </strong><strong class="unerline">{{$applicantdata[0]->location;}}</strong></p>

                        <p><strong>Type of Fee</strong>. <em>(please Tick and mentioned)</em> APF/ Map fee/ Granting Fee/ Yearly Rent/Fines/Auction Fee/Royalty/ Registration fee/Renewal Fee ______________________</p>

                        <p><strong>Amount Rs</strong><strong>…………………..</strong></p>
                    </td>
                    <td>
                        <p><strong>Account Title</strong><strong class="unerline">{{$applicantdata[0]->authorize_person;}}</strong></p>

                        <p><strong>Account No: </strong><strong class="unerline">{{$applicantdata[0]->ntn_no;}}</strong></p>

                        <p><strong>Date:</strong>……………………………..</p>
                        <p><strong>M/S: </strong><strong class="unerline">{{$applicantdata[0]->company_name;}}</strong></p>

                        <p>…………………………………………………………………………</p>
                        <p><strong>Type of Mineral Concession: </strong><strong class="unerline">{{$applicantdata[0]->nature_business ;}}</strong></p>

                        <p><strong>Area: </strong><strong class="unerline">{{$applicantdata[0]->covered_area;}}</strong></p>

                        <p><strong>Location: </strong><strong class="unerline">{{$applicantdata[0]->location;}}</strong></p>

                        <p><strong>Type of Fee</strong>. <em>(please Tick and mentioned)</em> APF/ Map fee/ Granting Fee/ Yearly Rent/Fines/Auction Fee/Royalty/ Registration fee/Renewal Fee ______________________</p>

                        <p><strong>Amount Rs</strong><strong>…………………..</strong></p>
                    </td>
                    <td>
                        <p>
                        <p><strong>Account Title</strong><strong class="unerline">{{$applicantdata[0]->authorize_person;}}</strong></p>

                        <p><strong>Account No: </strong><strong class="unerline">{{$applicantdata[0]->ntn_no;}}</strong></p>

                        <p><strong>Date:</strong>……………………………..</p>
                        <p><strong>M/S: </strong><strong class="unerline">{{$applicantdata[0]->company_name;}}</strong></p>

                        <p>…………………………………………………………………………</p>
                        <p><strong>Type of Mineral Concession: </strong><strong class="unerline">{{$applicantdata[0]->nature_business ;}}</strong></p>

                        <p><strong>Area: </strong><strong class="unerline">{{$applicantdata[0]->covered_area;}}</strong></p>

                        <p><strong>Location: </strong><strong class="unerline">{{$applicantdata[0]->location;}}</strong></p>

                        <p><strong>Type of Fee</strong>. <em>(please Tick and mentioned)</em> APF/ Map fee/ Granting Fee/ Yearly Rent/Fines/Auction Fee/Royalty/ Registration fee/Renewal Fee ______________________</p>

                        <p><strong>Amount Rs</strong><strong>…………………..</strong></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="text-align: center;"><strong class="texunerline">For Bank Use Only</strong></p>

                        <p>Received Payment Rs………………</p>

                        <p>Sig &amp; Stamp Bank Officer</p>

                        <p> ________________________</p>
                    </td>
                    <td>
                        <p style="text-align: center;"><strong class="texunerline">For Bank Use Only</strong></p>

                        <p>Received Payment Rs………………</p>

                        <p>Sig &amp; Stamp Bank Officer</p>

                        <p> _____________________</p>
                    </td>
                    <td>
                        <p style="text-align: center;"><strong class="texunerline">For Bank Use Only</strong></p>

                        <p>Received Payment Rs………………</p>

                        <p>Sig &amp; Stamp Bank Officer</p>

                        <p> ___________________________</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <p>……………………………………………………………………………………………………………………………………………………………….....................................................................</p>

        <p><strong>Note</strong><strong>: </strong><strong>-</strong> Coordinates of the area should be mentioned in back side of the challan, and submit the fee challan online within one week after deposition in the bank. Otherwise, the challan will be considered as null and wide.</p>



    </div>
</body>

</html>