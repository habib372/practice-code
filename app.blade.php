<section class="sponsorship-apply-form">
    <div class="container">
        <!-- webflow -->
        <div class="row">
            <div class="col-md-11 webflow">
                <div class="mb-4 signup-steps-panel" id="myTab" role="tablist">
                    <div class="signup-step-logo is-active">
                        <div class="mb-2">Apply</div>
                        <a data-toggle="tab" href="#step-1" role="tab">
                            <div class="step-circle">
                                <div class="index-text">1</div>
                            </div>
                        </a>
                    </div>
                    <div class="signup-step-logo">
                        <div class="mb-2">Review</div>
                        <a data-toggle="tab" href="#step-2" role="tab">
                            <div class="step-circle">
                                <div class="index-text">2</div>
                            </div>
                        </a>
                    </div>
                    <div class="signup-step-logo">
                        <div class="mb-2">Recommend</div>
                        <a data-toggle="tab" href="#step-3" role="tab">
                            <div class="step-circle">
                                <div class="index-text">3</div>
                            </div>
                        </a>
                    </div>
                    <div class="signup-step-logo">
                        <div class="mb-2">Approve</div>
                         <a data-toggle="tab" href="#step-4" role="tab">
                            <div class="step-circle">
                                <div class="index-text">4</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--/End webflow -->

        <!-- sponsorship form -->
        <div class="row tab-pane" id="step-1">
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
                    </form><!--end::Form-->
                </div>
            </div>
        </div>
        <!--/End sponsorship form -->

        <!--Step-2 form -->
        <div class="row tab-pane " id="step-2">
            <div class="col-md-11 sponsorship_form">
                <h5 class="sponsorship_title">We have received your application and reviewing our Specialist Doctor </h5>
                <div class="sponsorship_form_body">
                    <p>Note:
                        1. Please allow at least 3 weeks to review and process your application.
                        2. Your application will be reviewed by very experienced oncologists and clinicians based in Bangladesh and Australia. Applications will be considered for funding only upon their positive recommendation.
                        3. We have limited funds available. Hence, although the application is genuine and urgent, we may be able to fund all applications.
                        4. We do not entertain any requests over phone, email, or </p>
                </div>
            </div>
        </div>
         <!--/End Step-2 form -->

         <!--Step-3 form -->
        <div class="row tab-pane " id="step-3">
            <div class="col-md-11 sponsorship_form">
                <h5 class="sponsorship_title">Your application is being reviewed by our board members</h5>
                <div class="sponsorship_form_body">
                    <p>Our board memeber review and investigate your information. </p>
                </div>
            </div>
        </div>
         <!--/End Step-3 form -->

          <!--Step-4 form -->
        <div class="row tab-pane " id="step-4">
            <div class="col-md-11 sponsorship_form">
                <h5 class="sponsorship_title">Congratulation! You have own a sponsorship</h5>
                <div class="sponsorship_form_body">
                    <p>Note:
                      We are approve your applications </p>
                </div>
            </div>
        </div>
         <!--/End Step-4 form -->

    </div>
</section>