 $(document).ready(function(){
 $(window).on("scroll",function(){
 var wn = $(window).scrollTop();
 // console.log(wn);
 if(wn > 100){
 $('.bottomnavThree').addClass('nav-scroll');
 }
 else{
 $('.bottomnavThree').removeClass('nav-scroll');
 }
 });
 });
 AOS.init();

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <meta name="viewport" content="width=device-width,maximum-scale=1.0">

     <link rel="stylesheet" type="text/css" href="{{asset('invoice.css')}}">

     <style type="text/css" media="screen"></style>
     <style>
         form.barcode-create-form .input-group-text,
         form.barcode-edit-form .input-group-text {
             width: 220px;
         }

         .btn {
             display: inline-block;
             font-weight: 400;
             text-align: center;
             background-color: transparent;
             border: 1px solid transparent;
             padding: 0.375rem 0.75rem;
             font-size: 1rem;
             line-height: 1.5;
             border-radius: 0.25rem;
             transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
         }

         .btn-dark {
             color: #fff;
             background-color: #343a40;
             border-color: #343a40;
             margin-bottom: 15px;
             cursor: pointer;
         }

         .btn-primary {
             color: #fff;
             background-color: #007bff;
             border-color: #007bff;
         }

         .form-control {
             display: block;
             width: 100%;
             height: calc(1.5em + 0.75rem + 2px);
             padding: 0.375rem 0.75rem;
             font-size: 1rem;
             font-weight: 400;
             line-height: 1.5;
             color: #495057;
             background-color: #fff;
             background-clip: padding-box;
             border: 1px solid #ced4da;
             border-radius: 0.25rem;
             margin-bottom: 15px;
             transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
         }

         table {
             /*max-width: 900px;*/
             width: 100%;
             /*margin: auto;*/
         }

         .print-link td {
             /* width: 30%;float:left;overflow: hidden; */
             /*width: 22%;*/
             /*width: 180px;*/
             float: left;
             /*display: block;*/
             /*margin-right: 10px;*/
             /*margin-bottom: 4px;*/
             font-size: 12px;
             text-align: center;
         }

         img {
             max-width: 100%;
             height: 50px;
         }

         @media print {
             .noprint {
                 visibility: hidden;
                 display: none;
             }

             .card {
                 border: 0;
             }

             .print-link {
                 /*margin-top:  4mm;*/
                 /*margin-bottom:10mm;*/
             }

             .page-break {
                 page-break-before: always;
             }

             .avoid-break {
                 page-break-inside: avoid;
             }

         }

         p.companyname {
             text-align: center;
         }

         .form-inline {
             /*display: flex;*/
             /*justify-content: space-between;*/
             /*flex-basis: 50%;*/
             /*align-items: baseline;*/
         }

         .form-inline div.input-group {
             flex-basis: 70%;
         }

         .print-link tr {
             display: table-row;
         }

         .print-link tr td:nth-child(even) {
             padding: 0px 5px 11px 9px;
         }

         .print-link tr td:nth-child(odd) {
             padding: 0px 1px 11px 5px;
         }

         .print-data {
             width: 151px;
             float: left;
             font-size: 12px;
             text-align: center;
         }

         .print-page {
             width: 328px;
             display: block;

         }
     </style>

     <title>Bar code Print</title>
 </head>

 <body>
     <header class="noprint">
         <div class="logo noprint">
             <a class="navbar-brand" href="{{ url('/home') }}">
                 {{ config('app.name', 'Laravel') }}
             </a>
         </div>
         <nav class="navbar noprint">
             <ul>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('barcodes.create') }}">Create Barcode</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('buyers.index') }}">Buyer</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('barcodes.index') }}">View All Barcode</a>
                 </li>
                 <li class="nav-item dropdown">


                     <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>

                 </li>
             </ul>
         </nav>
         <div class="fa fa-bars"></div>
     </header>
     <div class="invoice_holder">
         <!-- Invoice Start -->

         <div class="full">



             <div class="product_info">

                 <div class="">
                     <div class="col-md-8">
                         <div class="form-group noprint">
                             <label for="usr">Receipt Size: <span class="label label-primary" id="showWidth">314pxx</span></label>
                             <select class="form-control" name="OptReceiptSize" id="OptReceiptSize" onChange="widthChange(this.value)" autofocus="autofocus" required>
                                 <option value="">Select Receipt Size</option>
                                 <option value="216">2.25 Inches(57mm)</option>
                                 <option value="264">2.75 Inches(70mm)</option>
                                 <option value="288">3 Inches(76mm)</option>
                                 <option value="328" selected>3.25 Inches(83mm)</option>
                                 <option value="384">4 Inches(102mm)</option>
                                 <option value="432">4.50 Inches(114mm)</option>
                                 <option value="768">Letter 8 Inc(216mm)</option>
                                 <option value="595">A4 size 8.267 Inc(210mm)</option>
                             </select>
                         </div>
                         <form action="?" class="noprint form-inline">
                             <label>Print Quantity</label>
                             <div class="input-group mb-3">

                                 <input type="text" name="qty" class="form-control" placeholder="Print quantity" aria-label="product_name" aria-describedby="basic-addon1" autofocus="false">
                             </div>
                             <button type="submit" class="btn btn-primary noprint">Submit</button>
                         </form>
                         <button onclick="window.print()" class="noprint btn btn-dark">Print Barcode</button>

                         <div id="ele1">
                             @php
                             $i = 1;
                             $_GET['qty'] = 12;
                             if(isset($_GET['qty']) && $_GET['qty']!=""){
                             $count = $_GET['qty'];
                             if($barcode->quantity_print > 0){
                             $count += $barcode->quantity_print;
                             $i= $barcode->quantity_print+1;
                             }

                             $buyerinfo = new \App\Models\BarcodeBuyer;
                             $buyerinfo->barcode_id = $barcode->id;
                             $buyerinfo->buyer_id = $barcode->buyer_id;
                             $buyerinfo->qty = $_GET['qty'];
                             $buyerinfo->created_at = \Carbon\Carbon::now();

                             $total_count = 0;
                             // Printer-wise barcode size configuration
                             $printerHoneywell_PC42t = [
                             'barcode_width' => 1.6,
                             'barcode_height' => 49,
                             ];

                             $currentPrinter = $printerHoneywell_PC42t; // Set the current printer
                             @endphp
                             <div class="print-page">
                                 <div class="print-data">
                                     <p class="companyname">
                                         <strong>{{ ucwords($barcode->company_name) }}</strong>
                                     </p>
                                     {!! DNS1D::getBarcodeHTML($barcode->barcode_number, 'C128', $currentPrinter['barcode_width'], $currentPrinter['barcode_height']) !!}

                                     {{ $barcode->barcode_number  }}

                                 </div>
                                 <div class="print-data">
                                     <p class="companyname">
                                         <strong>{{ ucwords($barcode->company_name) }}</strong>
                                     </p>
                                     {!! DNS1D::getBarcodeHTML($barcode->barcode_number, 'C128', $currentPrinter['barcode_width'], $currentPrinter['barcode_height']) !!}

                                     {{ $barcode->barcode_number  }}

                                 </div>
                                 <div class="print-data">
                                     <p class="companyname">
                                         <strong>{{ ucwords($barcode->company_name) }}</strong>
                                     </p>
                                     {!! DNS1D::getBarcodeHTML($barcode->barcode_number, 'C128', $currentPrinter['barcode_width'], $currentPrinter['barcode_height']) !!}

                                     {{ $barcode->barcode_number  }}

                                 </div>
                                 <div class="print-data">
                                     <p class="companyname">
                                         <strong>{{ ucwords($barcode->company_name) }}</strong>
                                     </p>
                                     {!! DNS1D::getBarcodeHTML($barcode->barcode_number, 'C128', $currentPrinter['barcode_width'], $currentPrinter['barcode_height']) !!}

                                     {{ $barcode->barcode_number  }}

                                 </div>
                                 <div class="print-data">
                                     <p class="companyname">
                                         <strong>{{ ucwords($barcode->company_name) }}</strong>
                                     </p>
                                     {!! DNS1D::getBarcodeHTML($barcode->barcode_number, 'C128', $currentPrinter['barcode_width'], $currentPrinter['barcode_height']) !!}

                                     {{ $barcode->barcode_number  }}

                                 </div>
                                 <div class="print-data">
                                     <p class="companyname">
                                         <strong>{{ ucwords($barcode->company_name) }}</strong>
                                     </p>
                                     {!! DNS1D::getBarcodeHTML($barcode->barcode_number, 'C128', $currentPrinter['barcode_width'], $currentPrinter['barcode_height']) !!}

                                     {{ $barcode->barcode_number  }}

                                 </div>
                                 <div class="print-data">
                                     <p class="companyname">
                                         <strong>{{ ucwords($barcode->company_name) }}</strong>
                                     </p>
                                     {!! DNS1D::getBarcodeHTML($barcode->barcode_number, 'C128', $currentPrinter['barcode_width'], $currentPrinter['barcode_height']) !!}

                                     {{ $barcode->barcode_number  }}

                                 </div>
                                 <div class="print-data">
                                     <p class="companyname">
                                         <strong>{{ ucwords($barcode->company_name) }}</strong>
                                     </p>
                                     {!! DNS1D::getBarcodeHTML($barcode->barcode_number, 'C128', $currentPrinter['barcode_width'], $currentPrinter['barcode_height']) !!}

                                     {{ $barcode->barcode_number  }}

                                 </div>

                             </div>

                             {{-- <table class="print-link" id="demoWidth" style="width: 328px">
                                <tbody>

                                    @for ($i; $i <= $count; $i+=2)
                                     <tr @if ($total_count == 14) class="page-break" @else class="avoid-break" @endif>
                                        <td style="width: 151px">
                                            <p class="companyname">
                                                <strong>{{ ucwords($barcode->company_name) }}</strong>
                             </p>

                             {!! DNS1D::getBarcodeHTML($barcode->barcode_number, 'C128', $currentPrinter['barcode_width'], $currentPrinter['barcode_height']) !!}

                             {{ $barcode->barcode_number . '-' . $i }}
                             </td>
                             @if ($i + 1 <= $count) <td style="width: 151px">
                                 <p class="companyname">
                                     <strong>{{ ucwords($barcode->company_name) }}</strong>
                                 </p>
                                 {!! DNS1D::getBarcodeHTML($barcode->barcode_number, 'C128', $currentPrinter['barcode_width'], $currentPrinter['barcode_height']) !!}

                                 {{ $barcode->barcode_number . '-' . ($i + 1) }}
                                 </td>
                                 @endif
                                 </tr>
                                 @php
                                 $total_count++;
                                 @endphp
                                 @endfor
                                 @php } @endphp
                                 </tbody>
                                 </table> --}}
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <script>
         let searchForm = document.querySelector('.navbar');
         let faBarsIcon = document.querySelector('.fa-bars');

         faBarsIcon.onclick = () => {
             searchForm.classList.toggle('nav-toggle');
         };

         function widthChange(ab) {
             if (ab != "") {
                 var wid = ab + "px";
                 document.getElementById('demoWidth').style.width = wid;
                 document.getElementById('showWidth').innerHTML = wid;
             }
         }
     </script>

 </body>

 </html>