@extends('frontend.layouts.app')

@section('page_title', 'Fighting Cancer Bangladesh - FCB | Apply for Sponsorship ')

@section('styles')
	<link rel="stylesheet" href="{{ asset('assets/frontend/patient_profile_header.css') }}"/>
@endsection

@section('content')
<section class="sponsorship-apply-form">
    <div class="container">
        <!-- webflow -->
        <div class="row">
            <div class="col-md-11 webflow">
                <div class="mb-4 signup-steps-panel">
                    <div class="signup-step-logo is-active">
                        <div class="mb-2">Apply</div>
                        <div class="step-circle">
                            <div class="index-text">1</div>
                            {{-- <i class="fa fa-hourglass-2"></i> --}}
                        </div>
                    </div>
                    <div class="signup-step-logo">
                        <div class="mb-2">Review</div>
                        <div class="step-circle">
                            <div class="index-text">2</div>
                        </div>
                    </div>
                    <div class="signup-step-logo">
                        <div class="mb-2">Recommend</div>
                        <div class="step-circle">
                            <div class="index-text">3</div>
                        </div>
                    </div>
                    <div class="signup-step-logo">
                        <div class="mb-2">Approve</div>
                        <div class="step-circle">
                            <div class="index-text">4</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/End webflow -->

        <!-- sponsorship form -->
        <div class="row">
            <div class="col-md-11 sponsorship_form">
                <h5 class="sponsorship_title">Please fill it carefully. You can't' edit after submission.</h5>
                <div class="sponsorship_form_body">
                    <!--begin::Form-->
                    <form class="m-form" action="{{ route('patient.sponsorship_save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="patient_form_body">
                            <!---Patient info--->
                            <p class="form_title">Patient Information <span class="text-danger">*</span></p>
                            <div class="patient_info">
                                <div class="form-group m-form__group">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <label for="patient_name">
                                                Patient Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control m-input" name="patient_name" id="patient_name" aria-describedby="patient_name" placeholder="" value="{{ old('patient_name') }}">
                                            @error('patient_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label for="patient_mobile">
                                                Mobile <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control m-input" name="patient_mobile" id="patient_mobile" aria-describedby="patient_mobile" placeholder="" value="{{ old('patient_mobile') }}">
                                            @error('patient_mobile')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <label for="patient_email">
                                                Email  <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control m-input" name="patient_email" id="patient_email" aria-describedby="patient_email" placeholder="" value="{{ old('patient_email') }}">
                                            @error('patient_email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group ">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="patient_address">
                                                Address  <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control m-input" name="patient_address" id="patient_address" aria-describedby="patient_address" placeholder="" value="{{ old('patient_address') }}">
                                            @error('patient_address')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="patient_country_id">
                                                Country <span class="text-danger">*</span>
                                            </label>
                                            {!! Form::select('patient_country_id', $countries, 19, ['class' => 'form-control m-input select2', 'id'
                                            => 'patient_country_id']) !!}
                                            @error('patient_country_id')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="patient_district_id">District <span class="text-danger">*</span></label>
                                            {!! Form::select('patient_district_id', $districts, null, ['class' => 'form-control m-input select2',
                                            'id' => 'patient_district_id']) !!}
                                            @error('patient_district_id')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group">
                                    <div class="row">
                                         <div class="col-md-4">
                                            <label for="patient_phone"> Phone</label>
                                            <input type="text" class="form-control m-input" name="patient_phone" id="patient_phone" aria-describedby="patient_phone" placeholder="" value="{{ old('patient_phone') }}">
                                            @error('patient_phone')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="patientDiseaseId">
                                                Select Chronic Disease <span class="text-danger">*</span>
                                            </label>
                                            {!! Form::select('patient_disease_id[]', $diseases, null, ['class' => 'form-control m-input select2 m_select2_3', 'id' => 'patientDiseaseId', 'multiple' => 'multiple']) !!}
                                            @error('patient_disease_id')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4" id="stage_id">
                                            <label for="patient_stage_id">
                                                Stage <span class="text-danger">*</span>
                                            </label>
                                            {!! Form::select('patient_stage_id', $stages, null, ['class' => 'form-control m-input select2', 'id' =>
                                            'patient_stage_id']) !!}
                                            @error('patient_stage_id')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--- treatment details --->
                            <p class="form_title">Treatment Details: <span class="text-danger">*</span></p>
                            <div class="patient_info">
                                <div class="form-group m-form__group">
                                    <div class="row">
                                        <div class="col-md-6" id="stage_id">
                                            <label for="patientTreatmentType">
                                                Type of Treatment <span class="text-danger">*</span>
                                            </label>
                                            {!! Form::select('patient_treatment_type', $treatmentType, null, ['class' => 'form-control m-input select2', 'id' =>
                                            'patientTreatmentType']) !!}
                                            @error('patient_treatment_type')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="treatmentDate"> Expected Treatment Date <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control m-input datepicker"  placeholder="YYYY-MM-DD" name="treatment_date" id="treatmentDate" value="{{ old('treatment_date') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-calendar-check-o"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            @error('treatment_date')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group ">
                                    <div class="row">
                                         <div class="col-md-6">
                                            <label for="treatmentDetails">Please describe your treatment details <span class="text-danger">*</span></label>
                                            <textarea name="treatment_details" class="form-control m-input" id="treatmentDetails" rows="2">{{ old('treatment_details') }}</textarea>
                                            @error('treatment_details')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="FundRequestReason">Purpose/Reason for requesting fund <span class="text-danger">*</span></label>
                                            <textarea name="fund_request_reason" class="form-control m-input" id="FundRequestReason" rows="2">{{ old('fund_request_reason') }}</textarea>
                                            @error('fund_request_reason')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="treatingServiceProvider"> Where treatment will be provided <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control m-input" name="treating_service_provider" id="treatingServiceProvider" aria-describedby="treating_service_provider" value="{{ old('treating_service_provider') }}" placeholder="Enter Hospital/Diagnostic Centre name">
                                            @error('treating_service_provider')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="ServiceProviderAddress"> Treatment Provider Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control m-input" name="service_provider_address" id="ServiceProviderAddress" aria-describedby="service_provider_address" value="{{ old('service_provider_address') }}" placeholder="Enter Hospital/Diagnostic Centre address">
                                            @error('service_provider_address')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group m-attach">
                                    <div class="row">
                                        <div class="col-md-12"  id="attachmentsHolder">
                                            <!--Ajax Content will load here-->
                                            <label for="visit_reason">Medical Attachments <small>(Max file size: 10MB; Allowed type: pdf or scan image)</small> <span class="text-danger">*</span></label>
                                            <div class="row mb-2 attach_title">
                                                <div class="col-md-5"> Attachment Title </div>
                                                <div class="col-md-4"> Attachments file</div>
                                            </div>
                                            @for($i=0;$i<2;$i++)
                                            <div class="row  mb-2"  id="attachmentsHolder" >
                                                <div class="col-md-5">
                                                    <input type="text" class="form-control m-input" name="attachs[{{$i}}][title]" id="title_{{$i}}">
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="file" class="form-control m-input file_upload" name="attachs[{{$i}}][file]" id="files_{{$i}}">
                                                </div>
                                                @if($i==1)
                                                <div class="col-md-3">
                                                    <a href="javascript:void(0)" id="addMoreAttach" class=" m_btn-custom">
                                                        <span>
                                                            <i class="fa fa-plus"></i>
                                                            <span>Add More</span>
                                                        </span>
                                                    </a>
                                                </div>
                                                @endif
                                            </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- doctor info --->
                            <p class="form_title">Treating Doctor Information: <span class="text-danger">*</span></p>
                            <div class="patient_info">
                                <div class="form-group m-form__group">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <label for="doctor_name">
                                                Doctor Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control m-input" name="doctor_name" id="doctor_name" aria-describedby="doctor_name" placeholder="" value="{{ old('doctor_name') }}">
                                            @error('doctor_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label for="doctor_mobile">
                                                Doctor Mobile <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control m-input" name="doctor_mobile" id="doctor_mobile" aria-describedby="doctor_mobile" placeholder="" value="{{ old('doctor_mobile') }}">
                                            @error('doctor_mobile')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 col-sm-12">
                                            <label for="doctor_email">
                                                Doctor Email <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control m-input" name="doctor_email" id="doctor_email" aria-describedby="doctor_email" placeholder="" value="{{ old('doctor_email') }}">
                                            @error('doctor_email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="doctorAddress"> Doctor address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control m-input" name="doctor_address" id="doctorAddress" aria-describedby="doctor_address" value="{{ old('doctor_address') }}" placeholder="Enter Hospital/Diagnostic Centre address">
                                            @error('doctor_address')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="doctorRecommendLetter" style="display:block">Recommendation from Treating Doctor <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control m-input file_upload" id="doctorRecommendLetter" name="doctor_recommend_letter" value="" accept="image/*, application/pdf">
                                            @error('doctor_recommend_letter')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <img src="/images/recommendation.png" class="preview_logo" id="output_image" width="80px" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Cost (Estimated) --->
                            <p class="form_title"> Total Estimate Cost of Treatment: <span class="text-danger">*</span></p>
                            <div class="patient_info">
                                <div class="form-group m-form__group ">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <label for="TotalTreatmentCost">
                                                Total Cost For Treatment <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control m-input" name="total_treatment_cost" id="TotalTreatmentCost" aria-describedby="total_treatment_cost" placeholder="0" value="{{ old('total_treatment_cost') }}">
                                            @error('total_treatment_cost')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label for="YourContribution">
                                                Your Contribution (You have) <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control m-input" name="your_contribution" id="YourContribution" aria-describedby="your_contribution" placeholder="0" value="{{ old('your_contribution') }}">
                                            @error('your_contribution')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                         <div class="col-md-4 col-sm-12">
                                            <label for="donationRequest">
                                                Donation Requested <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" class="form-control m-input" name="donation_request_amount" id="donationRequest" aria-describedby="donation_request_amount" readonly="" placeholder="" value="{{ old('donation_request_amount') }}">
                                            @error('donation_request_amount')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <!-- Bank info --->
                            <p class="form_title"> Your Bank Details : <span class="text-danger">*</span></p>
                            <div class="patient_info">
                                <div class="form-group m-form__group">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label for="accountHolderName">
                                                Account Holder Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control m-input" name="account_holder_name" id="accountHolderName" aria-describedby="account_holder_name" placeholder="" value="{{ old('account_holder_name') }}">
                                            @error('account_holder_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label for="accountNumber">
                                                Bank Account Number  <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control m-input" name="account_number" id="accountNumber" aria-describedby="account_number" placeholder="" value="{{ old('account_number') }}">
                                            @error('account_number')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group ">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label for="bankName">
                                                Bank Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control m-input" name="bank_name" id="bankName" aria-describedby="bank_name" placeholder="" value="{{ old('bank_name') }}">
                                            @error('bank_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                         <div class="col-md-6 col-sm-12">
                                            <label for="branchName">
                                                Branch Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control m-input" name="branch_name" id="branchName" aria-describedby="branch_name" placeholder="" value="{{ old('branch_name') }}">
                                            @error('branch_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="m-form__actions">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                            <button type="button" class="btn btn-secondary">
                                <a href="{{route('patient.dashboard')}}">Cancel </a>
                            </button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
        </div>
        <!--/End sponsorship form -->
    </div>
</section>

@section('scripts')

    <script>
        var attachIndex = 2;
        $('body').on('click', '#addMoreAttach', function () {
            $('#addMoreAttach').remove();

            var html = '<div id="attribute-' + attachIndex + '" class="row mb-2">' +
                '<div class="col-md-5">' +
                '<input type="text" class="form-control m-input" name="attachs[' + attachIndex + '][title]" id="title_' + attachIndex + '">' +
                '</div>' +
                '<div class="col-md-4">' +
                '<input type="file" class="form-control m-input file_upload" name="attachs[' + attachIndex + '][file]" id="files_' + attachIndex + '">' +
                '</div>' +

                '<div class="col-md-3">' +
                '<a id="addMoreAttach" href="javascript:void(0)" class="btn m_btn-custom">' +
                '<span>' +
                '<i class="fa fa-plus"></i>' +
                '<span>Add More</span>' +
                '</span>' +
                '</a>' +
                '</div>' +
                '</div>';
            attachIndex++;

            $('#attachmentsHolder').append(html);
        });
    </script>


    <script>
        // image preview
 		function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#output_image').attr('src', e.target.result);  // preview id = "output_image"
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#doctorRecommendLetters").change(function(){    //upload id = "profile-img"
            readURL(this);
        });
    </script>

    <!-- auto treatment estimate calculate -->
     <script>
        $(document).ready(function() {
            function updateDonationRequest() {
                var totalCost = parseFloat($("#TotalTreatmentCost").val()) || 0;
                var yourContribution = parseFloat($("#YourContribution").val()) || 0;
                var donationRequest = totalCost - yourContribution;

                $("#donationRequest").val(donationRequest);
            }
            $("#TotalTreatmentCost, #YourContribution").on("input", function() {
                updateDonationRequest();
            });
            updateDonationRequest();
        });
    </script>
@stop

@endsection

