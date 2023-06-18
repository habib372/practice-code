<h2>Hello Admin,</h2><br>

You received an Reservation email from : {{ $data['name'] }}<br>

Here are the details:<br>

<b>Name:</b> {{ $data['name'] }}<br>

<b>Email:</b> {{ $data['email'] }}<br>

<b>Phone Number:</b> {{ $data['mobile'] }}<br>

<b>Subject:</b> {{ $data['subject'] }}<br>

<b>Message:</b> {{ $data['nid'] }}<br>

<b>Message:</b> {{ $data['picklocation'] }}<br>

<b>Message:</b> {{ $data['pickdate'] }}<br>

<b>Message:</b> {{ $data['picktime'] }}<br>

<b>Message:</b> {{ $data['drop_of_location'] }}<br>

<b>Message:</b> {{ $data['message'] }}<br>

Thank You


public function reservationsend(Request $request){

            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'mobile' => 'required',
                'subject' => 'required',
                'nid' => 'required',
                'picklocation' => 'required',
                'pickdate' => 'required',
                'picktime' => 'required',
                'drop_of_location' => 'required',
                'message' =>'required',
            ]);

                $data = [
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'mobile' => $validatedData['mobile'],
                    'subject' => $validatedData['subject'],
                    'nid' => $validatedData['nid'],
                    'picklocation' => $validatedData['picklocation'],
                    'pickdate' => $validatedData['pickdate'],
                    'picktime' => $validatedData['picktime'],
                    'drop_of_location' => $validatedData['drop_of_location'],
                    'message' => $validatedData['message'],
                    ];

            \Mail::send('email.reserve', array( 'data' => $data), function ($message) use ($request) {
            $message->from($request->email);
            $message->to('')->subject('Customer Reservation message');

         });


            return back()->with('success', 'Thanks for contacting us!');
        }