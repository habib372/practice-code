<h2>Hello Admin,</h2><br>

You received an email from : {{ $data['name'] }}<br>

Here are the details:<br>

<b>Name:</b> {{ $data['name'] }}<br>

<b>Email:</b> {{ $data['email'] }}<br>

<b>Phone Number:</b> {{ $data['mobile'] }}<br>

<b>Subject:</b> {{ $data['subject'] }}<br>

<b>Message:</b> {{ $data['message'] }}<br>

Thank You


public function sendmail(Request $request){

    $validatedData = $request->validate([
    'name' => 'required',
    'phone' => 'required',
    'email' => 'required',
    'subject' => 'required',
    'message' => 'required'
]);

$data = [
    'first_name' => $validatedData['name'],
    'phone' => $validatedData['phone'],
    'email' => $validatedData['email'],
    'subject' => $validatedData['subject'],
    'message' => $validatedData['message'],
];
\Mail::send('email.contact_email', array( 'data' => $data), function ($message) use ($request) {
    $message->from($request->email);
    $message->to('')->subject('Customer message');
});

// \Mail::to(config('app.admin_email'))->send(new \App\Mail\PayMail($data));

return back()->with('success', 'Thanks for contacting us!');

}