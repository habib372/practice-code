{{-- controller --}}
 $data = [
                'patient_id' => $visit->patient->id,
                'name' => $visit->patient->name,
                'email' => $visit->patient->email,
                'mobile' => $visit->patient->mobile,
                'visit_date' => $visit->visit_date,
                'prescription_download' => $fileName,
                'prescription_file' => $filePath,
                'sp_logo'  => $visit->serviceProvider->logo,
                'sp_name'  => $visit->serviceProvider->name_en,
            ];

        $recipientEmail = $visit->patient->email;
        Mail::to($recipientEmail)->send(new PrescriptionMail($data));

    return view('admin.attachment', compact('data'));



 {{-- view --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $sp_name }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            /*line-height: 1.6;*/
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            font-size:14px;
        }

        .container {
            max-width: 650px;
            margin: 20px auto;
            padding: 40px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 100%;
            max-height: 60px;
            margin-bottom:10px;
        }
        p {
            margin: 0;
            font-size:15px;
        }
        a {
            color: #1e88e5; /* Blue color for links */
            text-decoration: none;
            font-weight: bold;
            font-size:14px;
        }
        i {
            font-style: italic;
            color: #777;
        }
        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1e88e5; /* Blue color for button */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .cta-button a{
            color:#fff;
        }
        .cta-button a:hover{
            color:#fff;
            background:#176db8;
        }
        h3{
            color:#176db8;
            margin:0;
            font-size:16px;
        }
        h2{
            font-size:17px;
            text-transform: capitalize;
        }

        span a {
            color: black!important;
            font-weight:normal;
        }
        span{
            font-size:15px;
        }
        .signup{
            text-align: center;
            margin:25px;
        }
        .login-button{
            padding: 10px 20px;
            background-color: #05bcd6;
            color: #fff!important;
            text-decoration: none;
            border-radius: 5px;
        }

        span b a {
            font-weight: 600 !important;
        }
        .no_reply{
            text-align:center;
            font-weight: bold;
        }
        .powered_by{
            text-align:center;
        }
         .powered_by i{
            color:#a6a6a6!important;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img height="50" src="{{ asset('images/branch/'.$sp_logo) }}" alt="Service Provider Logo">
        </div>

        <h2>Dear {{$name}},</h2>

        <br/>

        <p>Thank you! You have successfully completed a consultation with a highly skilled doctor from {{ $sp_name }}. Here are your details :</p>

        <br/>

        <div class="purcahse_mail_info">
            <span>Visit Date : <b> {{$visit_date}}</b></span><br/>
            <span>Your Name : <b> {{$name}} </b></span><br/>
            <span>Email : <b> {{$email}} </b></span><br/>
            <span>Mobile :  <b>{{$mobile}}</b></span><br/>
        </div>

        <br/>

        <p> Please find the prescription from the consultation as attachment.</p>

        <br/>

        {{-- <div class="signup">
           <a class="login-button" href="{{ asset('uploads/prescription/'.$prescription_download) }}" role="button">Download Prescription</a>
        </div> --}}


        <p>Thank you once again for choosing {{ $sp_name }}. We look forward to providing you with top-notch health care services!</p>

        <br/>

        <p> Best Regards, </p>
        <h3>{{ $sp_name }}</h3>

        <br/><br/>

        <div class="no_reply">
           <i>(This is an auto-generated email from {{ $sp_name }}. Do not reply to this email as the mailbox is not monitored.)</i>
        </div>

         <br/> <br/>

        <div class="powered_by">
            <i>Poweredby Patient Management System from [Company Name]</i>
        </div>

    </div>
</body>
</html>

