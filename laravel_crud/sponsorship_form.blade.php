<?php

    public function sponsorshipApply()
    {
        $sponsorshipData = Sponsorship::with(['district', 'country', 'patient', 'disease', 'stage'])->where('patient_id', auth('patient')->id())->latest()->first();
        $daysDifference = $this->calculateDaysDifference($sponsorshipData->created_at);
        $verification = SponsorshipVerify::where('sponsorship_id', $sponsorshipData->id)->first();

        return view('frontend.patient.sponsorship_form', compact('sponsorshipData', 'verification', 'daysDifference'));
    }

    // 2023-10-25 - 2023-10-27 = 2
    function calculateDaysDifference($specifiedDate)
    {
        // Convert the specified date to a Carbon instance
        $specifiedDate = Carbon::parse($specifiedDate);

        // Get today's date as a Carbon instance
        $todayDate = now();

        // Calculate the number of days
        $daysDifference = $specifiedDate->diffInDays($todayDate);

        return $daysDifference;
    }
?>

@section('content')
    <!-- error handling -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 error-message">
                @if (session('success'))
                <div id="success-alert" class="alert alert-success alert-dismissible fade show m-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></button>
                    {{session('success')}}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-error alert-danger alert-dismissible fade show m-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></button>
                    <strong>Whoops!</strong> There were some problems with your input. Please Check all fields.
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- conditions --->

    @php
        if (($sponsorshipData !== null) && ($daysDifference < 7)){
        //final status
           if(($verification->investigation_status === 'approve') && ($verification->final_status === null)) {
                $apply_activeOrDone = 'approve';
                $doctor_activeOrDone = 'approve';
                $staff_activeOrDone = 'approve';
                $final_activeOrDone = 'is-active';
           }else if(($verification->investigation_status === 'approve') || ($verification->investigation_status === 'recommend') && ($verification->final_status !== null)){
                if ($verification->final_status === 'approve') {
                    $apply_activeOrDone = 'approve';
                    $doctor_activeOrDone = 'approve';
                    $staff_activeOrDone = 'approve';
                    $final_activeOrDone = 'approve';
                } else {
                    $apply_activeOrDone = 'approve';
                    $doctor_activeOrDone = 'approve';
                    $staff_activeOrDone = 'approve';
                    $final_activeOrDone = 'reject';
                }
        //investigation status
           } else if(($verification->doctor_verify_status === 'approve') && ($verification->investigation_status === null)) {
                $apply_activeOrDone = 'approve';
                $doctor_activeOrDone = 'approve';
                $staff_activeOrDone = 'is-active';
                $final_activeOrDone = '';
           }else if(($verification->doctor_verify_status === 'approve') || ($verification->doctor_verify_status === 'recommend') && ($verification->investigation_status !== null)){
                if ($verification->investigation_status === 'approve') {
                    $apply_activeOrDone = 'approve';
                    $doctor_activeOrDone = 'approve';
                    $staff_activeOrDone = 'approve';
                    $final_activeOrDone = 'is-active';
                } else if ($verification->investigation_status === 'recommend'){
                    $apply_activeOrDone = 'approve';
                    $doctor_activeOrDone = 'approve';
                    $staff_activeOrDone = 'is-active';
                    $final_activeOrDone = '';
                }else{
                    $apply_activeOrDone = 'approve';
                    $doctor_activeOrDone = 'approve';
                    $staff_activeOrDone = 'reject';
                    $final_activeOrDone = '';
                }
        //doctor status
           }else if($verification->doctor_verify_status === null) {
                $apply_activeOrDone = 'approve';
                $doctor_activeOrDone = 'is-active';
                $staff_activeOrDone = '';
                $final_activeOrDone = '';

           }else if($verification->doctor_verify_status !== null){
                if ($verification->doctor_verify_status === 'approve') {
                    $apply_activeOrDone = 'approve';
                    $doctor_activeOrDone = 'approve';
                    $staff_activeOrDone = 'is-active';
                    $final_activeOrDone = '';
                } else if ($verification->doctor_verify_status === 'recommend'){
                    $apply_activeOrDone = 'approve';
                    $doctor_activeOrDone = 'is-active';
                    $staff_activeOrDone = '';
                    $final_activeOrDone = '';
                }else{
                    $apply_activeOrDone = 'approve';
                    $doctor_activeOrDone = 'reject';
                    $staff_activeOrDone = '';
                    $final_activeOrDone = '';
                }
           }
        // apply status
        } else{
            $apply_activeOrDone = 'is-active';
            $doctor_activeOrDone = '';
            $staff_activeOrDone = '';
            $final_activeOrDone = '';
        }
    @endphp

    <!-- form  -->
    <section class="sponsorship-apply-form">
        <div class="container">
            <!-- webflow -->
            <div class="row custom-margin">
                <div class="col-md-12 webflow">
                    <div class="mb-4 signup-steps-panel" id="myTab" role="tablist">
                        <!-- apply -->
                        <div class="signup-step-logo {{ $apply_activeOrDone }}" id="step_1">
                            <div class="mb-2">Application</div>
                            <a data-toggle="tab" href="#step-1" role="tab">
                                <div class="step-circle">
                                    <div class="index-text">
                                        {!!  ($apply_activeOrDone == 'is-active')? '1' : '<i class="fa fa-check"></i>' !!}
                                    </div>
                                </div>
                                <div class="index-box">
                                     {!! ($apply_activeOrDone === 'is-active')? '<i class="fa fa-caret-down"></i>':'' !!}
                                </div>
                            </a>
                        </div>
                         <!--Doctor review -->
                        <div class="signup-step-logo {{ $doctor_activeOrDone }}" id="step_2">
                            <div class="mb-2">Doctor Review</div>
                            <a data-toggle="tab" href="#step-2" role="tab">
                                <div class="step-circle">
                                     <div class="index-text">
                                        @if ($doctor_activeOrDone === 'approve')
                                            <i class="fa fa-check"></i>
                                        @elseif($doctor_activeOrDone === 'reject')
                                            <i class="fa fa-close"></i>
                                        @else
                                            2
                                        @endif
                                    </div>
                                </div>
                                <div class="index-box">
                                    {{-- {!! ($doctor_activeOrDone === 'is-active' || $doctor_activeOrDone === 'recommend')? '<i class="fa fa-caret-down"></i>':'' !!} --}}
                                        @if ($doctor_activeOrDone === 'is-active' || $doctor_activeOrDone === 'recommend')
                                            <i class="fa fa-caret-down"></i>
                                        @elseif($doctor_activeOrDone === 'reject')
                                            <i class="fa fa-caret-down"></i>
                                        @else

                                        @endif
                                </div>
                            </a>
                        </div>
                         <!-- staff review -->
                        <div class="signup-step-logo {{ $staff_activeOrDone }}" id="step_3">
                            <div class="mb-2"> Investigation</div>
                            <a data-toggle="tab" href="#step-3" role="tab">
                                <div class="step-circle">
                                    <div class="index-text">
                                        @if ($staff_activeOrDone === 'approve')
                                            <i class="fa fa-check"></i>
                                        @elseif($staff_activeOrDone === 'reject')
                                            <i class="fa fa-close"></i>
                                        @else
                                            3
                                        @endif
                                    </div>
                                </div>
                                <div class="index-box">
                                        @if (($staff_activeOrDone === 'is-active' || $staff_activeOrDone === 'recommend'))
                                            <i class="fa fa-caret-down"></i>
                                        @elseif($staff_activeOrDone === 'reject')
                                            <i class="fa fa-caret-down"></i>
                                        @else

                                        @endif
                                </div>
                            </a>
                        </div>
                         <!-- final status  -->
                        <div class="signup-step-logo {{ $final_activeOrDone }}" id="step_1">
                            <div class="mb-2">Final Review</div>
                            <a data-toggle="tab" href="#step-1" role="tab">
                                <div class="step-circle">
                                    <div class="index-text">
                                        @if ($final_activeOrDone === 'approve')
                                            <i class="fa fa-check"></i>
                                        @elseif($final_activeOrDone === 'reject')
                                            <i class="fa fa-close"></i>
                                        @else
                                         4
                                        @endif
                                    </div>
                                </div>
                                <div class="index-box">
                                    @if(($staff_activeOrDone === 'approve') && ($final_activeOrDone === 'is-active'))
                                        <i class="fa fa-caret-down"></i>
                                    @elseif ($final_activeOrDone === 'approve')
                                        <i class="fa fa-caret-down"></i>
                                    @elseif($final_activeOrDone === 'reject')
                                        <i class="fa fa-caret-down"></i>
                                    @else

                                    @endif
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--/End webflow -->

             <!-- step-1: sponsorship form -->
             @if ($apply_activeOrDone == 'is-active')
            <div class="row tab-pane custom-margin" id="step-1">
                <div class="col-md-12 sponsorship_form">
                    <h5 class="sponsorship_title">Please fill it carefully. You can't' edit after submission.</h5>
                    <div class="sponsorship_form_body">
                        <!--begin::Form-->
                        <form class="m-form" action="{{ route('patient.sponsorship_save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="patient_form_body">

                                <!---Patient info--->
                                <p class="form_title">Patient Information </p>
                                <div class="patient_info">
                                    <div class="form-group m-form__group">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <label for="patient_name">
                                                    Patient Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control m-input" name="patient_name" id="patient_name" aria-describedby="patient_name" placeholder="" value="{{ old('patient_name', $patient->name) }}">
                                                @error('patient_name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label for="patient_mobile">
                                                    Mobile <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control m-input" name="patient_mobile" id="patient_mobile" aria-describedby="patient_mobile" placeholder="" value="{{ old('patient_mobile', $patient->mobile) }}">
                                                @error('patient_mobile')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 col-sm-12">
                                                <label for="patient_email">
                                                    Email  <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control m-input" name="patient_email" id="patient_email" aria-describedby="patient_email" placeholder="" value="{{ old('patient_email', $patient->email) }}">
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
                                                <input type="text" class="form-control m-input" name="patient_address" id="patient_address" aria-describedby="patient_address" placeholder="" value="{{ old('patient_address', $patient->address) }}">
                                                @error('patient_address')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
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
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="patient_phone"> Phone</label>
                                                <input type="text" class="form-control m-input" name="patient_phone" id="patient_phone" aria-describedby="patient_phone" placeholder="" value="{{ old('patient_phone, $patient->phone') }}">
                                                @error('patient_phone')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label for="patientDiseaseId">
                                                    Select Chronic Disease <span class="text-danger">*</span>
                                                </label>
                                                {!! Form::select('patient_disease_id[]', $diseases, $existingDisease, ['class' => 'form-control m-input select2 m_select2_3', 'id' => 'patientDiseaseId', 'multiple' => 'multiple']) !!}
                                                @error('patient_disease_id')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4" id="stage_id">
                                                <label for="patient_stage_id">
                                                    Stage <span class="text-danger">*</span>
                                                </label>
                                                {!! Form::select('patient_stage_id', $stages, $patient->stage_id, ['class' => 'form-control m-input select2', 'id' =>
                                                'patient_stage_id']) !!}
                                                @error('patient_stage_id')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--- treatment details --->
                                <p class="form_title">Treatment Details</p>
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
                                                <label for="treatmentDate"> Expected Treatment Start Date <span class="text-danger">*</span></label>
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
                                                <label for="treatmentDetails">Please Describe Your Treating Plan <span class="text-danger">*</span></label>
                                                <textarea name="treatment_details" class="form-control m-input" id="treatmentDetails" rows="2">{{ old('treatment_details') }}</textarea>
                                                @error('treatment_details')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="FundRequestReason">Purpose/Reason For Requesting Fund <span class="text-danger">*</span></label>
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
                                                <label for="treatingServiceProvider"> Where Treatment Will Be Provided <span class="text-danger">*</span></label>
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
                                <p class="form_title">Treating Doctor Information </p>
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
                                                <input type="file" class="form-control m-input file_upload" id="doctorRecommendLetter" name="doctor_recommend_letter" value="">
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
                                <p class="form_title"> Total Estimate Cost of Treatment (Taka) </p>
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
                                <p class="form_title"> Your Bank Information </p>
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
            @endif
            <!--/End sponsorship form -->

            <!--Step-2: Doctor review-->
            @if ($doctor_activeOrDone  === 'is-active' && $verification->doctor_verify_status  === null)
            <div class="row custom-margin" id="step-2">
                <div class="col-md-12 sponsorship_note">
                    <h5 class="sponsorship_note_title">We have received your application and reviewing our Specialist Doctor</h5>
                    <div class="sponsorship_note_body">
                        <div class="sponsorship_content">
                            <p>Our specialist review and investigate your information</p>

                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!--/End Doctor review -->
            <!--Step-2: Doctor Recommend-->
            @if ($doctor_activeOrDone  === 'is-active' && $verification->doctor_verify_status  === 'recommend')
            <div class="row custom-margin" id="step-2">
                <div class="col-md-12 sponsorship_note">
                    <h5 class="sponsorship_note_title"> An expert doctor suggested adding some information. </h5>
                    <div class="sponsorship_note_body">
                        <div class="sponsorship_content">
                            <p>An expert doctor suggested adding some information.</p><br/>
                            <p><b>Doctor Recommendation :</b></p>
                            <p>{{ $verification->doctor_recommend_message }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!--/End Doctor Recommend -->
             <!--Step-2: Doctor reject-->
             @if ($doctor_activeOrDone === 'reject')
            <div class="row custom-margin" id="step-2">
                <div class="col-md-12 sponsorship_note">
                    <h5 class="sponsorship_note_title">We Are Very Sorry For Cancel Your Sponsorship Application because Specialist Doctor reject it</h5>
                    <div class="sponsorship_note_body">
                        <div class="sponsorship_content">
                            <p>Our specialist Doctor reject your application</p><br/>
                            <p><b>Why doctor reject this :</b></p>
                            <p>{{ $verification->doctor_reject_message }} </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!--/End Doctor reject -->

            <!--Step-3: Investigation status review-->
            @if ($staff_activeOrDone  === 'is-active' && $verification->investigation_status  === null)
            <div class="row custom-margin" id="step-2">
                <div class="col-md-12 sponsorship_note">
                    <h5 class="sponsorship_note_title">Your application is being reviewing by our board members</h5>
                    <div class="sponsorship_note_body">
                        <div class="sponsorship_content">
                            <p>Our board memeber review and investigate your information.</p>

                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!--/End Doctor review -->
            <!--Step-3: Investigation Recommend-->
            @if ($staff_activeOrDone  === 'is-active' && $verification->investigation_status  === 'recommend')
            <div class="row custom-margin" id="step-2">
                <div class="col-md-12 sponsorship_note">
                    <h5 class="sponsorship_note_title"> Your application is being reviewing by our board members and recommendaton. </h5>
                    <div class="sponsorship_note_body">
                        <div class="sponsorship_content">
                            <p>Our board memeber review and investigate your information and recommendaton .</p><br/>
                            <p><b>Board Member Recommendation :</b></p>
                            <p>{{ $verification->investigation_recommend_message }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!--/End Investigation Recommend -->
             <!--Step-3: Investigation reject-->
             @if ($staff_activeOrDone  === 'reject')
            <div class="row custom-margin" id="step-2">
                <div class="col-md-12 sponsorship_note">
                    <h5 class="sponsorship_note_title">We Are Very Sorry For Cancel Your Sponsorship Application because Our Board Members reject it</h5>
                    <div class="sponsorship_note_body">
                        <div class="sponsorship_content">
                            <p>Our Board reject your application</p><br/>
                            <p><b>Why doctor reject this :</b></p>
                            <p>{{ $verification->investigation_recommend_message }} </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!--/End Investigation reject -->

             <!--Step-4: Final Approval-->
            @if ($final_activeOrDone === 'is-active')
            <div class="row custom-margin" id="step-4">
                <div class="col-md-12 sponsorship_note">
                    <h5 class="sponsorship_note_title">Your application is being waiting for final approval</h5>
                    <div class="sponsorship_note_body">
                        <div class="sponsorship_content">
                            <p> Your application is being waiting for final approval </p>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!--/End Final Approval-->
            <!--Step-4: Final Approval-->
            @if ($final_activeOrDone === 'approve')
            <div class="row custom-margin" id="step-4">
                <div class="col-md-12 sponsorship_note">
                    <h5 class="sponsorship_note_title">Congratulation! You have own a sponsorship</h5>
                    <div class="sponsorship_note_body">
                        <div class="sponsorship_content">
                            <p> We are approve your applications </p>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!--/End Final Approval-->
            <!--Step-4: Final Approval Reject-->
            @if ($final_activeOrDone === 'reject')
            <div class="row custom-margin" id="step-4">
                <div class="col-md-12 sponsorship_note">
                    <h5 class="sponsorship_note_title">We Are Very Sorry For Cancel Your Sponsorship Application</h5>
                    <div class="sponsorship_note_body">
                        <div class="sponsorship_content">
                            <p> Your Sponsorship Application have been canceled. </p><br/>
                             <p><b>Why Reject Your Application?</b></p>
                            <p>{{ $verification->final_reject_message }} </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!--/End Final Approval Reject-->
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

    <!-- auto hide error message -->
    <script>
        setTimeout(function() {
            $('#success-alert').alert('close');
        }, 6000);
    </script>

@stop

@endsection

