
<!--folder:  email/contact_email.blade.php -->
<h2>Hello Admin,</h2><br>
You received an email from : {{ $name }}<br>
Here are the details:<br>
<b>Name:</b> {{ $name }}<br>
<b>Email:</b> {{ $email }}<br>
<b>Phone Number:</b> {{ $phone }}<br>
<b>Message:</b> {{ $user_message }}<br>
Thank You


<html>
    <head>

    </head>
    <body>
        <div class="containter">
            <strong>Dear Dr. {{ $referral_doctor_name }},</strong><br><br>

            {{-- {{ $doctor_name }}  has referred a patient to you in relation to the following appointment:<br> --}}
           Dr. {{ $consultant_doctor_name }} has referred a patient to you in relation to the following appointment:<br>

            Patient Name: {{ $patient_name  }}<br>
            Consultation Date: {{ $consultation_date }}<br><br>

            {!! $patient_history !!}<br><br/>

            <p>Sincerely,</p>
           <p>Dr. {{ $consultant_doctor_name }}</p>

            <i><b>(This is an auto-generated email from TSR EMR and PAS. Do not reply to this email as the mailbox is not monitored.)</b></i>
        </div>
    </body>
</html>
<!-- controller@store -->
public function send_message(Request $request)
    {
         $request->validate([
                'name' => 'required',
                'father name' => 'required',
                'date-of-birth' => 'required',
                'education' => 'required',
                'permanent address' => 'required',
                'upazila' => 'required',
                'district' => 'required',
                'present address' => 'required',
                'mobile' => 'required',
                'email' => 'required|email|max:255',
                'pasport image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'nid front part' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'nid back part' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'message' => 'required',
            ]);

        \Mail::send('email.contact_email',
             array(
                 'name' => $request->get('name'),
                 'email' => $request->get('email'),
                 'phone' => $request->get('phone'),
                 'user_message' => $request->get('message'),
             ), function($message) use ($request)
               {
                  $message->from($request->email);
                  $message->to([$request->email,' '])->subject('Customer Message');;
               });

        return back()->with('success','Message Sent Successfully');

    }


 public function send_referral(Request $request)
    {

        \Mail::send(
            'emails.referral_send',
            array(
                'referral_doctor_name' => $request->referral_doctor_name,
                'referral_doctor_email' => $request->referral_doctor_email,
                'patient_name' => $request->patient_name,
                'consultation_date' => $request->consultation_date,
                'patient_history' => $request->patient_history,
                'consultant_doctor_name' => $request->consultant_doctor_name,
            ),
            function ($message) use ($request) {
                $message->from('your_webmail');
                $message->to($request->referral_doctor_email)->subject('You have a referral patient from Primary Care Centre - PCC');
            }
        );

        return back()->with('success', 'Mail Sent Successfully');
    }

