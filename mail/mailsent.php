


public function send_message(Request $request)
 {

 $request->validate([
 'first_name' => 'required',
 'last_name' => 'required',
 'email' => 'required',
 'phone' => '',
 'message' => 'required',
 ]);

 // Message::insert([
 // 'name' => $request->name,
 // 'phone' => $request->phone,
 // 'email' => $request->email,
 // 'message' => $request->message,
 // ]);

 \Mail::send('email.contact_email',
 array(
 'name' => $request->get('first_name'),
 'email' => $request->get('email'),
 'phone' => $request->get('phone'),
 'user_message' => $request->get('message'),
 ), function($message) use ($request)
 {
 // $message->from('uitdeveloper2021@gmail.com');
 // $message->to([$request->email,'uitdeveloper2021@gmail.com'])->subject('Customer Message');;
 $message->from($request->email);
 $message->to('query@globizco.com')->subject('Customer Message');
 });

 return back()->with('success','Message Sent Successfully');

 }