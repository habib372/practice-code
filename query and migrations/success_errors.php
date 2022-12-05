
<!-- DataController@store -->
	$request->validate([
		'name' => 'required',
		'date-of-birth' => 'required',
		'permanent address' => 'required',
		'district' => 'required',
		'mobile' => 'required',
		'email' => 'required|email|max:255',
		'pasport image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
		'nid back part' => 'required|image|mimes:jpeg,png,jpg|max:2048',
		'message' => 'required',
	]);

			Agent::create([
                'name' =>  $request->name,
                'father_name' => 'abdur',
                'date_of_birth' => '2022/15/07',
                'education' => 'abdur',
                'permanent_address' => 'abdur',
                'upazila' => 'abdur',
                'district' => 'abdur',
                'present_address' => 'abdur',
                'mobile' => '651484864416',
                'email' => 'habib@gmail.com',
                'passport_image' => $fileName,
                'nid_front_part' => $fileName1,
                'nid_back_part' => $fileName2,
                'message' => 'hello, how are you'

        ]);
       	 return back()->with('success','You have successfully file uplaod.');

<!-- view.blade.php method-1-->
	@if(session()->has('success'))
	<div class="alert alert-success">
		{{ session()->get('success') }}
	</div>
	@endif

	@if ($errors->any())
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input. Please Check all fields.
	</div>
	@endif

<!--view.blade.php method-2 method-2-->
	@if ($message = Session::get('success'))
	<div class="alert alert-success alert-block">
		<button type="submit" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	</div>
	@endif


	@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif