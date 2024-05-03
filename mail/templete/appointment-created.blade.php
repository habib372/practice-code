

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mediroaming</title>
    <style>
        body {
            /*font-family: 'Arial', sans-serif;*/
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
            margin: 0 0 10px;
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
        h3, h4{
            color:#176db8;
        }
        h2{
            font-size:17px;
        }
        span a {
            color: black!important;
            font-weight:normal;
        }
        span{
            font-size:15px;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img height="50" src="https://mediroaming.com/uploads/header/5.png" alt=" Logo">
        </div>


        <h2>Dear {{$name}},</h2><br/>

        <p>Your appointment with MediRoaming  on {{$appointment_date}} is confirmed. Here are the details :</p><br/>


        <span>Appointment Date : <b> {{$appointment_date}} </b></span><br/>
        <span>Appointment Start Time : <b> {{$start_time}} </b></span><br/>
        <span>Appointment End Time :  <b>{{$end_time}}</b></span><br/>
        <span>Location :  House #13/A, Road-35, Gulshan Medical Center, Gulshan-02, Dhaka - 1212</span><br/><br/>


        <p>If you need to reschedule, cancel or setup online telehealth appointment, feel free to contact our support team.
        </p>
        <span>Email: info@mediroaming.com</span><br/>
        <span>Phone: +880 1766 662 479</span><br/><br/>

        <p>Thank you for choosing <b>MediRoaming</b>. We look forward to providing you with top-notch health care services!</p><br/>

        <p><b>Regards,</b></p>
        <h3>MediRoaming</h3><br/>

        <i><b>(This is an auto-generated email from mediroaming.com. Do not reply to this email as the mailbox is not monitored.)</b></i><br/><br/>

    </div>
</body>
</html>
