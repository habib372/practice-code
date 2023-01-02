
<!--folder:  email/contact_email.blade.php -->
<h2>Hello Admin,</h2><br>
You received an email from : {{ $name }}<br>
Here are the details:<br>
<b>Name:</b> {{ $name }}<br>
<b>Email:</b> {{ $email }}<br>
<b>Phone Number:</b> {{ $phone }}<br>
<b>Message:</b> {{ $user_message }}<br>
Thank You

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
<!--
        Message::insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ]); -->
        \Mail::send('email.contact_email',
             array(
                 'name' => $request->get('name'),
                 'email' => $request->get('email'),
                 'phone' => $request->get('phone'),
                 'user_message' => $request->get('message'),
             ), function($message) use ($request)
               {
                  $message->from($request->email);
                  $message->to([$request->email,'uitdeveloper2021@gmail.com'])->subject('Customer Message');;
               });

        return back()->with('success','Message Sent Successfully');

    }


