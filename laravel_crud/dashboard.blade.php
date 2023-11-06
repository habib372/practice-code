@extends('frontend.layouts.app')

@section('page_title', 'Fighting Cancer Bangladesh - FCB | Dashboard' )

@section('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
	<link rel="stylesheet" href="{{ asset('assets/frontend/patient_profile_header.css') }}"/>
@endsection

@section('content')

	{{-- @include('frontend.include.header') --}}

	<!-- dashboard -->
	<section class="departments section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="department-tab profile">
						<!-- Nav Tab  -->
						<div class="tab-content" id="myTabContent">

							<!-- Tab 1 (MY Profile)-->
							<div class="tab-pane fade show active" id="t-my_profile" role="tabpanel">
								<h2 class="welcome">WELCOME, {{Str::upper(auth('patient')->user()->name)}}</h2>
								<!-- profile -->
								<div class="row">
									<!-- profile section-->
									<div class="col-lg-8 col-md-8 col-sm-12">
										<section class="appointment" style="padding-top: 10px;">
												<!-- View profile -->
												<div class="row" id="myProfile">
													<div class="col">
														<table class="table table-bordered m-table custom">
															<tbody>
																<tr>
																	<td rowspan="10">
																		<div class="image_area">
																			<form method="post">
																				<label for="upload_image">
																					<div class="profile_img">
																						@if(!empty($patientInfo->photo))
																						<img src="/images/patients/{{$patientInfo->photo}}" id="uploaded_image" class="img-responsive img-circle image" />
																						@else
																						<img src="/images/avatar.jpg" id="uploaded_image" class="img-responsive img-circle image" />
																						@endif
																					</div>
																				</label>
																			</form>
																		</div>
																	</td>
																	<td colspan="2">
																		<h4>{{$patientInfo->name}} <span class="my_profile"><button type="button" class="custom-button btn" onclick="myProfile('edit')"><i class="fa fa-edit"></i> Edit Profile</button></span></h4>
																	</td>
																</tr>
																<tr>
																	<td><strong>Gender : </strong> {{ $patientInfo->gender }}</td>
																	<td><strong>Patient ID : </strong> {{ $patientInfo->id }}</td>
																</tr>
																<tr>
																	<td><strong>Date of Birth : </strong> {{ $patientInfo->date_of_birth }} ({{Custom::calculateAgeToday($patientInfo->date_of_birth)}})</td>
																	<td>
																		<strong>Chronic Diseases : </strong> {{ $diseaseNames??'' }}<br />
																		@if(($patientInfo->stage))
																		<strong>Stage : </strong> {{isset($patientInfo->stage) ? $patientInfo->stage->stage_en : null}}
																		@endif
																	</td>
																</tr>
																<tr>
																	<td>
																		<strong>Mobile : </strong> {{ $patientInfo->mobile??'' }}<br />
																		<strong>Email : </strong> {{ $patientInfo->email??'' }}<br />
																		<strong>Phone : </strong> {{ $patientInfo->phone??'' }}<br />
																	</td>
																	<td>
																		<strong>Address : </strong> {{ $patientInfo->address??'' }}<br />
																		<strong>District : </strong> {{isset($patientInfo->district) ? $patientInfo->district->name : null}}<br />
																		<strong>Country : </strong> {{isset($patientInfo->country) ? $patientInfo->country->name : null}}<br />
																	</td>
																</tr>
																<tr>
																	<td><strong>Profession : </strong> {{ $patientInfo->profession }}</td>
																	<td><strong>Allergies : </strong> {{ $patientInfo->allergies }}</td>
																</tr>
																@if($patientInfo->registration_date)
																<tr>
																	<td><strong>Registration Date : </strong> {{ $patientInfo->registration_date }}</td>
																</tr>
																@endif
																@foreach($patientInfo->carers as $carer)
																<tr>

																	<td><strong>Guardian : </strong> {{ $carer->name }}</td>
																	<td><strong>Mobile : </strong> {{ $carer->mobile }}</td>
																</tr>
																@endforeach
																<tr>
																	<td><strong>Referral Source</strong>: {{$patientInfo->referral_source}}</td>
																	<td><strong>Referral Doctor</strong>: {{!empty($patientInfo->referredDoctor->name_en) ? $patientInfo->referredDoctor->name_en : ''}}</td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<!-- update profile -->
												<div class="row" id="editMyProfile" style="display: none;">
													<div class="col">
														<form class="form" id="profileUpdateForm" enctype="multipart/form-data">
															<div class="row">

																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="patient_name">Name <span class="text-danger">*</span></label>
																		<input name="patient_name" id="patient_name" type="text" value="{{auth('patient')->user()->name}}">
																		<span id="invalid-patient_name" class="invalid-response text-danger"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="patient_mobile">Mobile <span class="text-danger">*</span></label>
																		<input name="patient_mobile" id="patient_mobile" type="text" value="{{auth('patient')->user()->mobile}}">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="patient_email">Email <span class="text-danger">*</span></label>
																		<input name="patient_email" id="patient_email" type="email" value="{{auth('patient')->user()->email}}">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="patient_phone">Phone </label>
																		<input name="patient_phone" id="patient_phone" type="text" value="{{auth('patient')->user()->phone}}">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="patient_address">Login Username  <span class="text-danger">*</span> </label>
																		<input name="patient_address" id="patient_address" type="text" value="{{auth('patient')->user()->username}}">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="patient_password">Login Password  <span class="text-danger">*</span></label>
																		<input name="patient_password" id="patient_password" type="password" autocomplete="false">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="patient_date_of_birth">Date of Birth <span class="text-danger">*</span></label>
																		<input name="patient_date_of_birth" class="datepicker" id="patient_date_of_birth" type="text" value="{{auth('patient')->user()->date_of_birth}}">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="patient_address">Address </label>
																		<input name="patient_address" id="patient_address" type="text" value="{{auth('patient')->user()->address}}">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="patient_country_id">Country </label>
																		{!! Form::select('patient_country_id', $countries, 19, ['class' => 'form-control m-input select2', 'id' => 'patient_country_id']) !!}
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="name">Disctrict</label>
																		{!! Form::select('patient_district_id', $districts, auth('patient')->user()->district_id, ['class' => 'form-control  m-input select2', 'id' => 'patient_district_id']) !!}
																	</div>
																</div>

																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="patient_marital_status">Marital Status</label>
																		{!! Form::select('patient_marital_status', $maritalStatuses, auth('patient')->user()->marital_status, ['class' => 'form-control m-input', 'id' => 'patient_marital_status']) !!}
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="patient_marriage_anniversary">Marriage Anniversary </label>
																		<input type="text" name="patient_marriage_anniversary" id="patient_marriage_anniversary" class="datepicker" value="{{auth('patient')->user()->marriage_anniversary}}">
																	</div>
																</div>

																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="patient_referral_source">Referral Source </label>
																		<input type="text" name="patient_referral_source" id="patient_referral_source" value="{{auth('patient')->user()->referral_source}}">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="patient_referral_doctor_id">Referral Doctor </label>
																		{!! Form::select('patient_referral_doctor_id', $doctors, auth('patient')->user()->referral_doctor_id, ['class' => 'form-control  m-input select2', 'id' => 'patient_referral_doctor_id']) !!}
																	</div>
																</div>

																<div class="col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label for="patient_profession">Profession </label>
																		<input type="text" name="patient_profession" id="patient_profession" value="{{auth('patient')->user()->profession}}">
																	</div>
																</div>
																<div class="col-lg-4 col-md-4 col-6">
																	<div class="form-group">
																		<label for="photo" style="display:block">Profile Photo</label>
																		<input type="file" class="form-control m-input file_upload" id="photo" name="photo" value="" accept="image/*">
																	</div>
																</div>
																<div class="col-lg-2 col-md-2 col-6">
																	<div class="form-group">
																		@if (auth('patient')->user()->photo)
																		<img class="preview_logo" style="width: 100px" id="output_image" src="/images/patients/{{auth('patient')->user()->photo}}" alt="">
																		@else
																		<img src="/images/default_patient.jpg" class="preview_logo" id="output_image" width="100px" />
																		@endif
																	</div>
																</div>

															</div>
															<br />
															<div class="row">
																<div class="col text-center">
																	<div class="form-group">
																		<div class="button">
																			<button type="button" class="btn custom-padding" onclick="myProfile('view')">Cancel</button>
																			<button type="submit" class="btn custom-padding" id="profileUpdate">Update Profile Info</button>
																		</div>
																	</div>
																</div>
															</div>
														</form>
													</div>
												</div>
										</section>
									</div>
									<!-- how I am feeling section -->
									<div class="col-lg-4 col-md-4 col-sm-12 mt-2">
										<!-- feeling section -->
										<section class="feeling_form">
											<h5>{{ trans('text.how_am_I_feeling_now?') }}</h5>
											<form action="" method="">
												<div class="form-row">
													<div class="col-md-9 col-sm-12">
														{!! Form::select('patient_feeling', ['1'=>'Select how you feel now', '2'=>'Feeling good', '3'=>'Feeling very hungry', '4'=>'Slide pain on lower abdomen', ], null, ['class' => 'form-control m-input select2', 'id' => 'patient_feeling']) !!}
													</div>
													<div class="col-md-3 col-sm-12">
														<button type="submit" class="btn custom-button">Submit</button>
													</div>
												</div>
											</form>
											<span> You can submit next update in 01.38 minutes</span>
										</section>
										<!-- Article section -->
										<div class="article-section">
											@foreach ($articles as $article)
											<div class="article">
												<a href="/content/{{$article->slug}}">
													<h6>{{ $article->title }}</h6>
													<img class="article-img rounded" src="{{ asset('images/contents/'.$article->images) }}" alt="{{ $article->title }}">
													{!! Illuminate\Support\Str::limit($article->description, 100) !!}
												</a>
											</div>
											@endforeach
										</div>
										<div class="read_more"><a href="{{ url('category/articles') }}">Read More Articles..</a></div>
									</div>
								</div>

								<!-- Cancer treatment journey-->
								<section class="cancer-journey">
									<div class="row">
										<div class="col-lg-8 col-md-8 col-sm-12">
											<h4>{{ trans('text.my_treatment_journey') }}</h4>
											<!-- Doctor consultation :start-->
											<div class="cancer-treatment">
												<h6 class="mb-2">Doctor's Consultations</h6>
												@forelse ($visits as $key => $visit)
													@if ($key < 2) <!-- Limit to the first two items -->
														<div class="cancer-treatment_item">
															<div class="treatment_item-head" role="button" data-toggle="modal" data-target="#visitDetailsModal_{{ $visit->id }}" aria-expanded="false">
																<span class="treatment_item-icon">
																	<i class="fa fa-stethoscope"></i>
																</span>
																<h6 class="treatment_item-title">
																	<span>Doctor's Consultation</span> on <span>{{ date('d-M-Y', strtotime($visit->visit_date)) }}</span>
																</h6>
															</div>
														</div>
													@endif
												@empty
												<div class="no-item-found ">
													No Medical History Found
												</div>
												@endforelse

												<div class="view-button">
													<!-- view more button -->
													@foreach ($visits as $key => $visit)
														@if ($key > 2 && $key < 4)
															<div class="view_more">
																<a type="button" href="#" data-toggle="modal" data-target="#alldoctorConsultation">View More</a>
															</div>
														@endif
													@endforeach

													<!-- add another item -->
													<div class="new_item_add">
														<a href="#">Add another doctor consultation info</a>
													</div>
												</div>
											</div>
											<!--/End Doctor consultation-->

											<!-- Chemotherapy session :start-->
											<div class="cancer-treatment">
												<h6 class="mb-2"> Chemotherapy Sessions</h6>
												@forelse($patient->chemotherapies as $key => $chemotherapy)
													@if($chemotherapy->status == 'Discharged' && $key < 2)
													<div class="cancer-treatment_item">
														<div class="treatment_item-head" role="button" data-toggle="modal"
															data-target="#chemotherapyModal_{{ $chemotherapy->id }}" aria-expanded="false">
															<span class="treatment_item-icon">
																<i class="fa fa-medkit"></i>
															</span>
															<h6 class="treatment_item-title">
																<span>Chemotherapy Session</span> From
																<span>{{ date('d-M-Y', strtotime($chemotherapy->date_of_admission)) }}</span>
																to
																<span>{{ date('d-M-Y', strtotime($chemotherapy->date_of_discharge)) }}</span>
															</h6>
														</div>
													</div>
													@endif
												@empty
												<div class="no-item-found">
													No Chemotherapy History Found
												</div>
												@endforelse

												<div class="view-button">
													<!-- View more button -->
													@foreach($patient->chemotherapies as $key => $chemotherapy)
														@if ($key > 2 && $key < 4)
															<div class="view_more">
																<a type="button" href="#" data-toggle="modal" data-target="#allChemoSessions">View More</a>
															</div>
														@endif
													@endforeach

													<!--add another item -->
													<div class="new_item_add">
														<a href="#">Add another Chemotherapy Session</a>
													</div>
												</div>
											</div>
											<!--/End Chemotherapy session-->

											<!-- Radiotherapy session :start-->
											<div class="cancer-treatment">
												<h6 class="mb-2">Radiotherapy Sessions</h6>
												{{-- @forelse($patient->chemotherapies as $key => $chemotherapy)
													@if($chemotherapy->status == 'Discharged' && $key <2)
													<div class="cancer-treatment_item">
														<div class="treatment_item-head" role="button" data-toggle="modal"
															data-target="#chemotherapyModal_{{ $chemotherapy->id }}" aria-expanded="false">
															<span class="treatment_item-icon">
																<i class="fa fa-medkit"></i>
															</span>
															<h6 class="treatment_item-title">
																<span>Radiotherapy Session</span> From
																<span>{{ date('d-M-Y', strtotime($chemotherapy->date_of_admission)) }}</span>
																to
																<span>{{ date('d-M-Y', strtotime($chemotherapy->date_of_discharge)) }}</span>
															</h6>
														</div>
													</div>
													@endif
												@empty
												<div class="no-item-found">
													No Radiotherapy History Found
												</div>
												@endforelse --}}
												<div class="no-item-found">
													No Radiotherapy History Found
												</div>

												<div class="view-button">
													<!-- View more button -->
													{{-- @foreach($patient->chemotherapies as $key => $chemotherapy)
														@if ($key > 2 && $key < 4)
															<div class="view_more">
																<a href="#">View More</a>
															</div>
														@endif
													@endforeach --}}

													<!--add another item -->
													<div class="new_item_add">
														<a href="#">Add another Radiotherapy Session</a>
													</div>
												</div>
											</div>
											<!--/End Chemotherapy session-->
										</div>

										<!-- funding -->
										<div class="col-lg-4 col-md-4 col-sm-12 mt-3">
											<!-- Funding section -->
											<div class="fund-rise">
												<h5>Struggling to fund your next treatment?</h5>
												<p>Are you facing financial hardship and worried about how to fund your next course of treatment prescribed by your oncologist? Well, you may be eligilable for Sponsorship organized by Fighting Cancer Bangladesh. </p>
												<a href="{{ route('patient.sponsorship_note') }}" class="click-here"><i class="fas fa-location-arrow"></i> Click here to know more..</a>
											</div>
											<!-- advertise -->
											<div class="advertise">
												<a href="#">
													<img src="/images/advertise/hospital-ads.gif" class="img-fluid rounded" alt="">
												</a>
											</div>
										</div>
									</div>
								</section>
								<!--/End treatment journey-->

								<!-- discount Section-->
								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12">
										<section class="discount-partner">
											<div class="discount_title">
												<h4>{{ trans('text.discount_partner') }}</h4>
												<span>({{ trans('text.click_icon') }})</span>
											</div>
											<div class="discount-slider">
												<!--  hospital/pharmacy -->
												<div class="owl-carousel-partner">
													@foreach ($discountPartners as $item)
														<div class="single-img" data-toggle="modal" data-target="#discountPartnerDetails_{{ $item->id }}" >
															<img src="/images/discount_partner/{{ $item->logo }}" alt="$item->logo">
															<p>{{ $item->free }}</p>
														</div>
													@endforeach
												</div>
												<br/>
												<!--  others -->
												<div class="owl-carousel-partner">
													@foreach ($othersdiscountPartners as $item)
														<div class="single-img" data-toggle="modal" data-target="#othersdiscountPartnerDetails_{{ $item->id }}">
															<img src="/images/discount_partner/{{ $item->logo }}" alt="$item->logo">
															<p>{{ $item->free }}</p>
														</div>
													@endforeach
												</div>
											</div>
										</section>
									</div>
								</div> <!--/End discount Section-->
							</div>
							<!--/ End Tab 1 -->

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/End dashboard -->

	<!-- Modal For For all  medical history-->
	<div class="modal fade bd-example-modal-lg collapse" id="alldoctorConsultation" tabindex="-1" role="dialog" aria-labelledby="carerDetailsModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<form id="carerDetailsForm" accept-charset="utf-8">
					<div class="modal-header">
						<h5 class="modal-title" id="carerDetailsModalLabel">Doctor Consultations</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="cancer-treatment">
							@forelse ($visits as $visit)
								<div class="cancer-treatment_item">
									<div class="treatment_item-head" role="button" data-toggle="modal" data-target="#visitDetailsModal_{{ $visit->id }}" aria-expanded="false">
										<span class="treatment_item-icon">
											<i class="fa fa-stethoscope"></i>
										</span>
										<h6 class="treatment_item-title">
											<span>Doctor's Consultation</span> on <span>{{ date('d-M-Y', strtotime($visit->visit_date)) }}</span>
										</h6>
									</div>
								</div>
							@endforeach
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--/End Modal For all  medical history-->

	<!-- Modal For medical history Details -->
	@foreach ($visits as $visit)
		@php
		$existingDisease = explode(',', $visit->disease_id);
    	$diseases = App\Models\Disease::whereIn('id', $existingDisease)->pluck('name_'.config('app.locale'))->implode(', ');
		@endphp
	<div class="modal fade bd-example-modal-lg collapse" id="visitDetailsModal_{{ $visit->id }}" tabindex="-1" role="dialog" aria-labelledby="carerDetailsModalLabel" aria-hidden="true">
		@include('frontend.patient.modals.medical_history')
	</div>
	@endforeach
	<!--/End Modal For medical history Details -->

	<!-- Modal For For all Chemotherapy Session -->
	<div class="modal fade bd-example-modal-lg collapes" id="allChemoSessions" tabindex="-1" role="dialog" aria-labelledby="carerDetailsModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<form id="carerDetailsForm" accept-charset="utf-8">
					<div class="modal-header">
						<h5 class="modal-title" id="carerDetailsModalLabel">Doctor Consultations</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="cancer-treatment">
							<h6 class="mb-2"> Chemotherapy Sessions</h6>
							@foreach($patient->chemotherapies as $chemotherapy)
							@if($chemotherapy->status == 'Discharged')
								<div class="cancer-treatment_item">
									<div class="treatment_item-head" role="button" data-toggle="modal" data-target="#chemotherapyModal_{{ $chemotherapy->id }}" aria-expanded="false">
										<span class="treatment_item-icon">
											<i class="fa fa-medkit"></i>
										</span>
										<h6 class="treatment_item-title">
											<span>Chemotherapy Session</span> From
											<span>{{ date('d-M-Y', strtotime($chemotherapy->date_of_admission)) }}</span>
											to
											<span>{{ date('d-M-Y', strtotime($chemotherapy->date_of_discharge)) }}</span>
										</h6>
									</div>
								</div>
							@endif
							@endforeach
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--/End Modal For all chemotherapy session -->

	<!-- Modal For Chemotherapy Session Details -->
	@foreach ($patient->chemotherapies as $chemotherapy)
	<div class="modal fade bd-example-modal-lg collapes" id="chemotherapyModal_{{ $chemotherapy->id }}" tabindex="-1" role="dialog" aria-labelledby="carerDetailsModalLabel" aria-hidden="true">
		@include('frontend.patient.modals.chemotherapy_history')
	</div>
	@endforeach
	<!--/End Modal For Chemotherapy Session Details -->

	<!-- Modal For For all  discount Partner Details show -->
	@foreach ($discountPartners as $item)
	<div class="modal fade bd-example-modal-lg collapse" id="discountPartnerDetails_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="carerDetailsModalLabel" aria-hidden="true">
		@include('frontend.patient.modals.discount_partners')
	</div>
	@endforeach
	<!--/End Modal For all discoutn Partner Details show -->

	<!-- Modal For For all  discount Partner other Details show -->
	@foreach ($othersdiscountPartners as $item)
	<div class="modal fade bd-example-modal-lg collapse" id="othersdiscountPartnerDetails_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="carerDetailsModalLabel" aria-hidden="true">
		@include('frontend.patient.modals.other_discount_partners')
	</div>
	@endforeach
	<!--/End Modal For all discoutn Partner Details show -->


	@section('scripts')

	<!-- discount partner -->
	<script>
		$(document).ready(function() {
			$(".discount").each(function() {
				var content = $(this).text();

				var modifiedContent = content.replace(/(\d+%)/g, '<b>$1</b>');
				$(this).html(modifiedContent);
			});
		});
	</script>

	<!-- profile image crop -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
	<script>
		var $modal = $('#modal');
		var image = document.getElementById('image');
		var cropper;
		$("body").on("change", ".image", function(e){
			var files = e.target.files;
			var done = function (url) {
				image.src = url;
				$modal.modal('show');
			};
			var reader;
			var file;
			var url;
			if (files && files.length > 0) {
				file = files[0];
				if (URL) {
					done(URL.createObjectURL(file));
				} else if (FileReader) {
					reader = new FileReader();
					reader.onload = function (e) {
						done(reader.result);
					};
					reader.readAsDataURL(file);
				}
			}
		});
		$modal.on('shown.bs.modal', function () {
			cropper = new Cropper(image, {
				aspectRatio: 1,
				viewMode: 3,
				preview: '.preview'
			});
		}).on('hidden.bs.modal', function () {
			cropper.destroy();
			cropper = null;
		});
		$("#crop").click(function(){
			canvas = cropper.getCroppedCanvas({
				width: 160,
				height: 160,
			});
			canvas.toBlob(function(blob) {
				url = URL.createObjectURL(blob);
				var reader = new FileReader();
				reader.readAsDataURL(blob);
				reader.onloadend = function() {
					var base64data = reader.result;
					$.ajax({
						type: "POST",
						dataType: "json",
						url: "/patient/updateProfilePhoto",
						data: {'_token': $('meta[name="csrf-token"]').attr('content'), 'image': base64data},
						success: function(data){
							$modal.modal('hide');
							// swal('Image Upload Successful');
							location.reload();
						}
					});
				}
			});
		})
	</script>

	<script>
		$(document).ready(function(){

			//My Profile update
			$("#profileUpdateForm").submit(function(e) {

			    e.preventDefault(); // avoid to execute the actual submit of the form.
			    var form = $(this);
			    var data = new FormData(this);

			    $("#profileUpdate").attr("disabled","disabled");

			    $.ajax({
			    	headers: {
			    		'X-CSRF-Token': '{{ csrf_token() }}',
			    	},
			    	type: "POST",
			    	url: '/patient/updateProfile',
			    	dataType: 'json',
			    	enctype: 'multipart/form-data',
			    	processData: false,
					contentType: false,
					// data: form.serialize(), // serializes the form's elements.
					data: data, // serializes the form's elements.
					success: function( response ){
						window.location = "{{url('/patient/dashboard')}}";
					},
					error: function ( data ){

						$("#profileUpdate").removeAttr('disabled');

						$('.invalid-response').text('');
						var errors = data.responseJSON.errors;
						$.each(errors, function(index, value) {
							$('#invalid-' + index).text(value[0]);
						});
					}
				});

			});

			$('[data-toggle="popover-hover"]').popover({
				html: true,
				trigger: 'hover',
				placement: 'right',
				content: function () { return '<img src="' + $(this).data('img') + '" />'; }
			});

		})
	</script>

	<script>

		// my profile show/edit
		function myProfile(action) {
			if (action == 'edit') {
				$("#editMyProfile").show('slow');
				$("#myProfile").hide('slow');
			} else if (action == 'view') {
				$("#editMyProfile").hide('slow');
				$("#myProfile").show('slow');
			}
		}

		// image preview
 		function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#output_image').attr('src', e.target.result);  // id = "output_image"
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#photo").change(function(){    // name = "photo"
            readURL(this);
        });

		//select2
			$('.select2').select2({
				width: '100%'
			});

	</script>

	@stop

	@endsection
