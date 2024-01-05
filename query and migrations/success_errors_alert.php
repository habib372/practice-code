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
'name' => $request->name,
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


@if (session('success'))
<div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
	{{session('success')}}
</div>
@endif

@if (session('error'))
<div class="alert alert-error alert-danger alert-dismissible fade show" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
	{{session('error')}}
</div>
@endif

<script>
	// Close the success alert after 6 seconds (6000 milliseconds)
	setTimeout(function() {
		$('#success-alert').alert('close');
	}, 5000);
</script>



<div class="col-md-4">
	<label for="patient_country_id">
		Country <span class="text-danger">*</span>
	</label>
	{!! Form::select('patient_country_id', $countries, $patient->country_id, ['class' => 'form-control m-input select2', 'id'
	=> 'patient_country_id']) !!}
	@error('patient_country_id')
	<span class="text-danger">{{$message}}</span>
	@enderror
</div>
<div class="col-md-4">
	<label for="patient_district_id">District <span class="text-danger">*</span></label>
	{!! Form::select('patient_district_id', $districts, $patient->district_id, ['class' => 'form-control m-input select2',
	'id' => 'patient_district_id']) !!}
	@error('patient_district_id')
	<span class="text-danger">{{$message}}</span>
	@enderror
</div>

<div class="col-lg-4">
	<label for="title_en">Title (English) <span class="text-danger">*</span></label>
	<input type="text" class="form-control m-input{{ $errors->has('title_en')? ' border-danger' : '' }}" name="title_en" id="title_en" aria-describedby="title_en" value="{{ old('title_en') }}" placeholder="Enter facility title in english">
	@error('title_en')
	<span class="text-danger">{{$message}}</span>
	@enderror
</div>
<div class="col-lg-4">
	<label for="title_bn">Title (Bangla) <span class="text-danger">*</span></label>
	<input type="text" class="form-control m-input{{ $errors->has('title_bn')? ' border-danger' : '' }}" name="title_bn" id="title_bn" aria-describedby="title_bn" value="{{ old('title_bn') }}" placeholder="Enter facility title in bangla">
	@error('title_bn')
	<span class="text-danger">{{$message}}</span>
	@enderror
</div>