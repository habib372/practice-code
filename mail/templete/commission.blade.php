

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Company Name]</title>
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
         h4{
            color:#176db8;
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
            <img height="50" src="https://example.com/uploads/logo.png" alt=" Logo">
        </div>

        <h2>Dear {{$agent_name}},</h2><br/>

        <p>I hope this message finds you well.</p><br/>

        <p>We are thrilled to inform you that one of your customers has successfully used your promo code! As a result, you have earned a {{ $commission }}% commission on their purchase. Here are the details:</p><br/>

        <div class="purcahse_mail_info">
            <span>Invoice ID : <b> {{$invoice_id}}</b></span><br/>
            <span>Package Type : <b> {{$package_type}} Package</b></span><br/>
            <span>Package Price :  <b>{{$package_price}} {{ $currency }}</b></span><br/>
            <span>Your Commission ({{ $commission }}%) :  <b>{{$commission_amount}} {{ $currency }}</b></span>
        </div>

        <br/><br/>

        <p>Your dedication and hard work are truly paying off, and we appreciate your continued efforts in promoting our service. Keep up the great work!</p>

        <p>If you have any questions or feedback, please contact our support team at</p>
        <span>Email: info@example.com</span><br/>
        <span>Phone: +880 17xxxxxxxx</span>

        <br/><br/>

        <p>Congratulations once again, and thank you for being an invaluable part of our team.</p>

        <br/>

        <p> Best Regards, </p>
        <h3>[Company Name]</h3>

        <br/><br/>

        <div class="no_reply">
           <i>(This is an auto-generated email from [Company Name]. Do not reply to this email as the mailbox is not monitored.)</i>
        </div>

         <br/> <br/>

        <div class="powered_by">
            <i>Powered by [Company name]</i>
        </div>

    </div>
</body>
</html>
