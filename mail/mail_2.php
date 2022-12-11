public function sendmail(Request $request){

$validatedData = $request->validate([

'first_name' => 'required',
'last_name' => 'required',
'phone' => 'required',
'email' => 'required|email|max:255',
'address' => 'required',
'message' => 'required'
]);

$data = [
'first_name' => $validatedData['first_name'],
'last_name' => $validatedData['last_name'],
'phone' => $validatedData['phone'],
'email' => $validatedData['email'],
'address' => $validatedData['address'],
'message' => $validatedData['message'],
];
\Mail::send('email.contact_email', array( 'data' => $data), function ($message) use ($request) {
$message->from($request->email);
$message->to('info@aamlbd.com')->subject('Customer message');

});

// \Mail::to(config('app.admin_email'))->send(new \App\Mail\PayMail($data));

return back()->with('success', 'Thanks for contacting us!');

}