<!-- route -->
Route::get('certifications','OtherController@certifications');
Route::post('/track-certificate', 'OtherController@TrackCertificate')->name('TrackCertificate');

<!-- controller -->
public functionTrackCertificate(Request $request)
    {
        $passportNumber = $request->input('passportNumber');
        $usrname = $request->input('usrname');

        // Fetch data based on the inputs
        $data = Student::where('status', 'active')
        ->where('passport_no', $passportNumber)
        ->where('name', 'LIKE', '%' . $usrname . '%')
        // ->where('name', $usrname)
        ->get();

        // If no data found, return a message instead of empty results
        if ($data->isEmpty()) {
            return response()->json(['html' => '<p class="text-danger">No Certificate Found</p>']);
        }

        return response()->json([
            'html' => view('gallary.track_certificate_info', compact('data'))->render()
        ]);
    }



<!-- view -->
@extends('layouts.master')
@section('content')
	<div class="certificate-section">
		<div class="container">
			<h2 class="products-title">Student Certificates</h2>
			<div class="form-wrapper">
				<div class="row">
					<div class="col-md-10 m-auto">
						<h3>Check your certificate</h3>
						<p class="mb-4">Complete the below section with your valid information</p>
						<form id="SubmitForm" method="post">
							@csrf
							<div class="form-group row">
								<label class="col-lg-4 col-form-label text-bold">
									Passport Number <span class="text-danger">*</span>
								</label>
								<div class="col-lg-8"><input type="text" value="" name="passportNumber" id="passportNumber" required="required" class="form-control" placeholder="Enter your passport number"></div>
							</div>
							<div class="form-group row">
								<label class="col-lg-4 col-form-label text-bold"> Name <span class="text-danger">*</span></label>
								<div class="col-lg-8"><input type="text" value="" name="usrname" id="usrname" required="required" class="form-control" placeholder="Enter your name"></div>
							</div>
							<div class="form-group row mt-3">
								<label class="col-lg-4 col-form-label text-bold"></label>
								<div class="col-lg-6">
									<button type="submit" class="btn btn-primary mr-3">Search</button>
									<button type="reset" class="btn btn-secondary">Reset</button>
								</div>
							</div>
						</form>

						<div class="form-group row">
							<div class="col-lg-12">
								<p class="mt-5 text-center">If you encounter any problems with this e-service, please contact us at <a href="mailto:info@domain.com">info@domain.com</a></p>
							</div>
						</div>

					</div>
            	</div>
				<div class="row mt-3 mb-3">
					<div id ="ajaxResults" class="col-md-12 col-12 text-center"></div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('js')
	<script>
		$(document).ready(function() {
			$('#SubmitForm').on('submit', function(e) {
				e.preventDefault();

				// Get the values from the input fields
				let passportNumber = $("input[name='passportNumber']").val();
				let usrname = $("input[name='usrname']").val();

				// Validate if passport number, reference number, or name is empty
				if (passportNumber === '') {
					alert('Please enter your passport number');
					return false;
				}

				if (usrname === '') {
					alert('Please enter your name');
					return false;
				}

				// AJAX request
				$.ajax({
					url: "{{ route('TrackCertificate') }}",
					type: "POST",
					data: {
						"_token": "{{ csrf_token() }}",
						passportNumber: passportNumber,
						usrname: usrname
					},
					dataType: 'json',
					success: function(response) {
						if (response.html !== '') {
							$('#ajaxResults').html(response.html);
						} else {
							alert("No Data Available");
						}
					},
					error: function(xhr, status, error) {
						console.log(xhr.responseText);
						alert('Error in AJAX request');
					}
				});
			});
		});

	</script>
	@endsection


<!-- view('gallary.track_certificate_info) -->
<div class="col-md-12 table-responsive">
    <table class="table table-striped table-bordered custom-table">
        <thead>
            <tr class="text-center">
                <th>Student ID</th>
                <th>Name</th>
                <th>Passport Number</th>
                <th>Certificate</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $reports)
            <tr class="text-center">
                <td>{{ $reports->student_id }}</td>
                <td>{{ $reports->name }}</td>
                <td>{{ $reports->passport_no }}</td>
                <td>
                   @if ($reports->certificate)
                        @if (pathinfo($reports->certificate, PATHINFO_EXTENSION) === 'pdf')
                            <a href="{{ asset('images/student_gallery/' . $reports->certificate) }}" target="_blank">
                                <img width="50" src="{{ asset('images/pdf-icon.png') }}" alt="PDF Icon">
                            </a>
                        @else
                            <img width="50" src="{{ asset('images/student_gallery/' . $reports->certificate) }}"  alt="img" class="img-thumbnail"  data-toggle="modal" data-target="#imageModal">
                        @endif
                    @else
                        N/A
                    @endif

                </td>
            </tr>
            @empty
            <tr class="text-center">
                <td colspan="4">No Data found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@foreach($data as $reports)
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Certificate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img class="img_size"  src="{{ asset('images/student_gallery/' . $reports->certificate) }}" alt="img">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"><a class="text-light" href="{{ asset('images/student_gallery/'.$reports->certificate) }}" download="{{ $reports->certificate }}">Download</a></button>
      </div>
    </div>
  </div>
</div>
@endforeach