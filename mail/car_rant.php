public function reservationsend(Request $request){
function UnlinkImage($old_image)
{
if (file_exists($old_image)) {
@unlink($old_image);
}
}

if ($request->hasFile('image')) {
$validatedData = $request->validate([
'name' => 'required|max:255',
'email' => 'required|email|max:255',
'mobile' => 'required|max:255',
'subject' => 'required',
'message' => 'required',
'nid' => 'required',
'picklocation' => 'required',
'pickdate' => 'required',
'picktime' => 'required',
'dropdate' => 'required',
'image' => 'file|mimes:jpeg,png,jpg,gif,svg,ai,psd,pdf,zip|max:25600',
]);

$file = request()->image->getClientOriginalName();

$filename = pathinfo($file, PATHINFO_FILENAME);
$extension = pathinfo($file, PATHINFO_EXTENSION);


$fileName = str_slug($filename, '_').'_'. time().'.'.request()->image->getClientOriginalExtension();


request()->image->move(public_path('images'), $fileName);

$sourceofFile=public_path('images').'/'. $fileName;

$data = [
'name' => $validatedData['name'],
'email' => $validatedData['email'],
'mobile' => $validatedData['mobile'],
'subject' => $validatedData['subject'],
'message' => $validatedData['message'],
'nid' => $validatedData['nid'],
'picklocation' => $validatedData['picklocation'],
'pickdate' => $validatedData['pickdate'],
'picktime' => $validatedData['picktime'],
'dropdate' => $validatedData['dropdate'],
'image' => $sourceofFile,
];



// \Mail::to(config('app.admin_email'))->send(new \App\Mail\Reserve($data));
\Mail::send('email.contact_email',
array(
'name' => $request->get('name'),
'email' => $request->get('email'),
'mobile' => $request->get('mobile'),
'subject' => $request->get('subject'),
'nid' => $request->get('nid'),
'picklocation' => $request->get('picklocation'),
'picktime' => $request->get('picktime'),
'picklocation' => $request->get('picklocation'),
'dropdate' => $request->get('dropdate'),
'user_message' => $request->get('message'),
), function($message) use ($request,$sourceofFile)
{
$message->from($request->email);
$message->to([$request->email,'habibsoft792@gmail.com'])->subject('Customer Message');
$message->attach($sourceofFile);
});

UnlinkImage( $sourceofFile);

return back()->with('success', 'Thanks for contacting us!');
}

if (!$request->hasFile('image')) {
$validatedData = $request->validate([
'name' => 'required|max:255',
'email' => 'required|email|max:255',
'mobile' => 'required|max:255',
'subject' => 'required',
'message' => 'required',
'nid' => 'required',
'picklocation' => 'required',
'pickdate' => 'required',
'picktime' => 'required',
'dropdate' => 'required'
]);


$data = [
'name' => $validatedData['name'],
'email' => $validatedData['email'],
'mobile' => $validatedData['mobile'],
'subject' => $validatedData['subject'],
'message' => $validatedData['message'],
'nid' => $validatedData['nid'],
'picklocation' => $validatedData['picklocation'],
'pickdate' => $validatedData['pickdate'],
'picktime' => $validatedData['picktime'],
'dropdate' => $validatedData['dropdate'],
'image' => false,
];



// \Mail::to(config('app.admin_email'))->send(new \App\Mail\Reserve($data));
\Mail::send('email.contact_email',
array(
'name' => $request->get('name'),
'email' => $request->get('email'),
'mobile' => $request->get('mobile'),
'subject' => $request->get('subject'),
'nid' => $request->get('nid'),
'picklocation' => $request->get('picklocation'),
'picktime' => $request->get('picktime'),
'picklocation' => $request->get('picklocation'),
'dropdate' => $request->get('dropdate'),
'user_message' => $request->get('message'),
), function($message) use ($request)
{
// $message->from('test@bdrentacar.com');
// $message->to([$request->email,'bdrentacar.com@gmail.com'])->subject('Customer Message');

$message->from($request->email);
$message->to([$request->email,'habibsoft792@gmail.com'])->subject('Customer Message');
});


return back()->with('success', 'Thanks for contacting us!');
}

}


'name' => $request->get('name'),
'email' => $request->get('email'),
'mobile' => $request->get('mobile'),
'subject' => $request->get('subject'),
'nid' => $request->get('nid'),
'picklocation' => $request->get('picklocation'),
'pickdate'=>$request->get('pickdate'),
'picktime' => $request->get('picktime'),
'drop_of_location' => $request->get('drop_of_location'),
'message' => $request->get('message'),



'name' => $request->name,
'email' => $request->email,
'mobile' => $request->mobile,
'subject' => $request->subject,
'nid' => $request->nid,
'picklocation' => $request->picklocation,
'pickdate'=>$request->pickdate,
'picktime' => $request->picktime,
'drop_of_location' => $request->drop_of_location,
'message' => $request->message,



You received a message from : {{ $email }}<br>

<p>
    Name: {{ $name}}
</p>

<p>
    Email: {{ $email }}
</p>

<p>
    Phone: {{ $mobile  }}
</p>

<p>
    Subject: {{ $subject }}
</p>

<p>
    Message: {{ $message }}
</p>