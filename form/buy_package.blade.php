@extends('layouts.frontend')

@section('title')
Buy a Package
@endsection

@section('css')

@endsection

@section('content')
<div class="container">

        <div class="pricing-section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="sec-title text-center">
                        {{-- <span class="title">Get plan</span> --}}
                        <h2>Package Plan</h2>
                    </div>
                </div>
            </div>

            <div class="outer-box">
                <div class="row">
                    <!-- Pricing Block -->
                    <div class="pricing-block col-lg-4 col-md-4 col-sm-12 wow fadeInUp">
                        <div class="inner-box">
                            <div class="icon-box">
                                <div class="icon-outer"><i class="fas fa-rocket"></i></div>
                            </div>
                            <div class="price-box">
                                <h4 class="price">BASIC</h4>
                            </div>
                            <div class="package-price">
                               <p><i class='fas fa-dot-circle'></i> Adult Cover (Over 16Y) = <span>$80</span></p>
                               <P> <i class='fas fa-dot-circle'></i> Kid Cover (0-16Y) = <span>$80</span></P>
                               <p><i class='fas fa-dot-circle'></i> Family Cover (2Adult + 2kids) = <span>$200</span></p>
                            </div>
                            <ul class="features">
                                <li class="true">2 Medical Consultations</li>
                                <li class="true">1 set of pathology FBC EUC LFTS CRP</li>
                                <li class="true">1 Set of Microbiology Urine MCS, Stool PCR/MCS</li>
                                <li class="true">1X Dengue path, 1X CXR.</li>
                                <li class="true">PLUS - health concierge</li>
                                <li class="true">T&C apply</li>
                            </ul>
                            {{-- <div class="btn-box">
                                <a href="#" class="theme-btn">Select Package</a>
                            </div> --}}
                        </div>
                    </div>

                    <!-- Pricing Block -->
                    <div class="pricing-block col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
                        <div class="inner-box">
                            <div class="icon-box">
                                <div class="icon-outer"><i class="fas fa-gem"></i></div>
                            </div>
                            <div class="price-box">
                                <h4 class="price">PREMIER</h4>
                            </div>
                            <div class="package-price">
                               <p><i class='fas fa-dot-circle'></i> Adult Cover (Over 16Y) = <span>$100</span></p>
                               <P> <i class='fas fa-dot-circle'></i> Kid Cover (0-16Y) = <span>$100</span></P>
                               <p><i class='fas fa-dot-circle'></i> Family Cover (2Adult + 2kids) = <span>$250</span></p>
                            </div>
                            <ul class="features">
                                <li class="true">3 Medical Consultations</li>
                                <li class="true">1 set of pathology FBC EUC LFTS CRP</li>
                                <li class="true">1 Set of Microbiology Urine MCS, Stool PCR/MCS</li>
                                <li class="true">1X Dengue path, 1X CXR</li>
                                <li class="true">PLUS - health concierge, inpatient assistance, medicine delivery</li>
                                <li class="true">T&C apply</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Pricing Block -->
                    <div class="pricing-block col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
                        <div class="inner-box">
                            <div class="icon-box">
                                <div class="icon-outer">
                                    <i class="fas fa-check"></i>
                                </div>
                            </div>
                            <div class="price-box">
                                <h4 class="price">ON-DEMAND</h4>
                            </div>
                             <div class="package-price">
                               <p><i class='fas fa-dot-circle'></i> Single Appointment = <span>$30</span></p>
                            </div>
                            <ul class="features">
                                <li class="true">1 Medical Consultations</li>
                                <li class="false">1 set of pathology FBC EUC LFTS CRP</li>
                                <li class="false">1 Set of Microbiology Urine MCS, Stool PCR/MCS</li>
                                <li class="false">1X Dengue path, 1X CXR.</li>
                                <li class="false">PLUS - health concierge</li>
                                <li class="false">T&C apply</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!--Package select Form -->
        <h5 class="fillup_form">Please Fillup the form</h5>
        <div class="buy_package_form">
            <div class="inner">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="package-form">
                            <!-- Form -->
                            <form class="form" method="#" action="#" enctype="multipart/form-data">
                                @csrf
                                <!-- Package Selection -->
                                <div class="package_select">
                                    <div class="row">
                                        <div class="col-md-10 col-12">
                                            <p>Select a package <span class="text-danger">*</span></p>
                                            <div class="package_opt {{ $errors->has('package_type')? ' border-danger' : '' }}">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="package_type" id="basicPackage" value="basic" {{ (old('package_type') === 'basic') ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="basicPackage">Basic Package</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="package_type" id="premierRadio" value="premier" {{ (old('package_type') === 'premier') ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="premierRadio">Premier Package</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="package_type" id="ondemandRadio" value="on-demand" {{ (old('package_type') === 'on-demand') ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="ondemandRadio">On-Demand</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Package coverage -->
                                <div class="package_select" >
                                    <p>Selected package cover for the following travellers <span class="text-danger">*</span></p>
                                    <div class="row">
                                        <div class="col-md-10 col-12">
                                            <div class="package_opt {{ $errors->has('package_coverage')? ' border-danger' : '' }}">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="package_coverage" id="onlyme" value="only-me" {{ (old('package_coverage') === 'only-me') ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="onlyme">Only Me</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="package_coverage" id="family" value="family" {{ (old('package_coverage') === 'family') ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="family">My Family and Me (2Adults + 2Kids)</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="package_coverage" id="others" value="others" {{ (old('package_coverage') === 'others') ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="others">Custom Select &nbsp;<i class="fa fa-long-arrow-right"></i></label>
                                                </div>
                                                <div class="form-check-inline" id="customSelect">
                                                    <div class="">
                                                        <label> Adult : </label>
                                                        <select name="adult" id="adult">
                                                            <option value="" >0</option>
                                                            @for ($i = 1; $i <= 10; $i++)
                                                                <option value="{{ $i }}" {{ old('adult') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>&nbsp;&nbsp;

                                                        <label>Kid : </label>
                                                        <select name="kid" id="kid" >
                                                            <option value="">0</option>
                                                            @for ($i = 1; $i <= 10; $i++)
                                                                <option value="{{ $i }}" {{ old('kid') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- traveller information -->
                                <div class="traveller" id="addMoreTravellerForm">
                                    <div class="traveller_info">
                                        <h5>Traveller (1) :  <span class="text-danger">*</span></h5>
                                        <div class="row g-2">
                                            <div class="col-md-6 col-12">
                                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                                <input type="text" name="traveller[0][name]" class="form-control" id="name" placeholder="" aria-label="name" value="{{ old('traveller[0][name]') }}" >
                                                @error('traveller[0][name]')
                                                    <span class="small text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" name="traveller[0][email]" class="form-control" id="email" placeholder="" value="{{ old('traveller[0][email]') }}" >
                                                @error('traveller[0][email]')
                                                    <span class="small text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="mobile" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                                <input type="text" name="traveller[0][mobile]" id="mobile" class="form-control" placeholder="" aria-label="mobile"  value="{{ old('traveller[0][mobile]') }}" >
                                                @error('traveller[0][mobile]')
                                                    <span class="small text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="alt_mobile" class="form-label">Alternate Contact Number </label>
                                                <input type="text" name="traveller[0][alt_mobile]" class="form-control" placeholder="" aria-label="alt_mobile" value="{{ old('traveller[0][alt_mobile]') }}">
                                                @error('traveller[0][alt_mobile]')
                                                    <span class="small text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                                <input name="traveller[0][date_of_birth]" class="datepicker form-control" id="date_of_birth" type="text" autocomplete="off"  value="{{ old('traveller[0][date_of_birth]') }}" >
                                                @error('traveller[0][date_of_birth]')
                                                    <span class="small text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                                <select name="traveller[0][gender]" id="gender" class="form-select" aria-label="form-select-sm example" >
                                                    <option value=""> </option>
                                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                    <option value="others" {{ old('gender') == 'others' ? 'selected' : '' }}>Others</option>
                                                </select>
                                                @error('gender')
                                                    <span class="small text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" name="traveller[0][address]" class="form-control" id="address" placeholder="street, city, country" value="{{ old('traveller[0][address]') }}">
                                                @error('traveller[0][address]')
                                                    <span class="small text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="phone" class="form-label">Phone Number</label>
                                                <input type="text" name="traveller[0][phone]" class="form-control" id="phone" placeholder="" value="{{ old('traveller[0][phone]') }}">
                                                @error('traveller[0][phone]')
                                                    <span class="small text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 col-12 add-more-btn addMore">
                                                <button type="button" id="addMoreTraveller" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add More Traveller</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="submit_btn">
                                    <button type="submit" class="btn btn-primary margin-right-10">Submit</button>
                                    <button type="button" class="btn btn-secondary"><a class="text-white" href="{{ route('nrbsDashboard')}}">Cancel</a></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('js')
    <script>

        // date picker initialization function
        function initializeDatepicker() {
            var date = new Date();
            date.setDate(date.getDate() - 1);

            $(".datepicker").datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
                minDate: new Date(),
                orientation: "bottom left",
                templates: {
                    leftArrow: '<i class="fas fa-angle-left"></i>',
                    rightArrow: '<i class="fas fa-angle-right"></i>',
                },
            });
        }
        // Initial datepicker setup
        initializeDatepicker();

        // add more traveller
        var indexNumber = 1;
        var $i = 2;
        $('body').on('click', '#addMoreTraveller', function () {

            $('#addMoreTraveller').remove();

            var html ='<div  id="traveller-'+indexNumber+'" class="traveller_info">'+
                        '<h5>Traveller (' + $i++ + ') : <span class="text-danger">*</span></h5>'+
                        '<div class="row g-2">'+
                            '<div class="col-md-6 col-12">'+
                                '<label for="name" class="form-label">Name <span class="text-danger">*</span></label>'+
                                '<input type="text" name="traveller[' + indexNumber + '][name]" class="form-control" placeholder="" aria-label="name" value="{{ old("traveller[' + indexNumber + '][name]") }}" >'+
                                '@error('name')'+
                                '<span class="small text-danger">{{$message}}</span>'+
                                '@enderror'+
                            '</div>'+
                            '<div class="col-md-6 col-12">'+
                                '<label for="email" class="form-label">Email <span class="text-danger">*</span></label>'+
                                '<input type="email" name="traveller[' + indexNumber + '][email]" class="form-control" id="email" placeholder="" value="{{ old("traveller[' + indexNumber + '][email]") }}" >'+
                                '@error("traveller[' + indexNumber + '][email]")'+
                                '<span class="small text-danger">{{$message}}</span>'+
                                '@enderror'+
                            '</div>'+
                            '<div class="col-md-6 col-12">'+
                                '<label for="mobile" class="form-label">Contact Number <span class="text-danger">*</span></label>'+
                               ' <input type="text" name="traveller[' + indexNumber + '][mobile]" id="mobile" class="form-control" placeholder="" aria-label="mobile" value="{{ old("traveller[' + indexNumber + '][mobile]") }}" >'+
                                '@error("traveller[' + indexNumber + '][mobile]")'+
                               ' <span class="small text-danger">{{$message}}</span>'+
                                '@enderror'+
                            '</div>'+
                            '<div class="col-md-6 col-12">'+
                                '<label for="alt_mobile" class="form-label">Alternate Contact Number </label>'+
                                '<input type="text" name="traveller[' + indexNumber + '][alt_mobile]" class="form-control" placeholder="" aria-label="alt_mobile" value="{{ old("traveller[' + indexNumber + '][alt_mobile]") }}">'+
                                '@error("traveller[' + indexNumber + '][alt_mobile]")'+
                                '<span class="small text-danger">{{$message}}</span>'+
                                '@enderror'+
                            '</div>'+
                            '<div class="col-md-6 col-12">'+
                                '<label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>'+
                                '<input name="traveller[' + indexNumber + '][date_of_birth]" class="datepicker form-control" id="date_of_birth" type="text" autocomplete="off" value="{{ old("traveller[' + indexNumber + '][date_of_birth]") }}" >'+
                                '@error("traveller[' + indexNumber + '][date_of_birth]")'+
                                '<span class="small text-danger">{{$message}}</span>'+
                                '@enderror'+
                            '</div>'+
                            '<div class="col-md-6 col-12">'+
                                '<label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>'+
                                '<select name="traveller[' + indexNumber + '][gender]" id="gender" class="form-select" aria-label="form-select-sm example" >'+
                                    '<option value=""></option>'+
                                    '<option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>'+
                                    '<option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>'+
                                    '<option value="others" {{ old('gender') == 'others' ? 'selected' : '' }}>Others</option>'+
                                '</select>'+
                                '@error("traveller[' + indexNumber + '][gender]")'+
                                '<span class="small text-danger">{{ $message }}</span>'+
                                '@enderror'+
                            '</div>'+
                            '<div class="col-md-6 col-12">'+
                                '<label for="address" class="form-label">Address</label>'+
                                '<input type="text" name="traveller[' + indexNumber + '][address]" class="form-control" id="address" placeholder="street, city, country" value="{{ old("traveller[' + indexNumber + '][address]") }}">'+
                                '@error("traveller[' + indexNumber + '][address]")'+
                                '<span class="small text-danger">{{$message}}</span>'+
                                '@enderror'+
                            '</div>'+
                            '<div class="col-md-6 col-12">'+
                                '<label for="phone" class="form-label">Phone Number</label>'+
                                '<input type="text" name="traveller[' + indexNumber + '][phone]" class="form-control" id="phone" placeholder="" value="{{ old("traveller[' + indexNumber + '][phone]") }}">'+
                                '@error("traveller[' + indexNumber + '][phone]")'+
                                '<span class="small text-danger">{{$message}}</span>'+
                                '@enderror'+
                            '</div>'+
                           ' <div class="col-md-4 col-12 add-more-btn addMore">'+
                                '<button type="button" id="addMoreTraveller" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add More Traveller</button>'+
                            '</div>'+
                        '</div>'+
                    '</div>';

            indexNumber++;

            $('#addMoreTravellerForm').append(html);

            initializeDatepicker();
        });


        $(document).ready(function () {
            $('input[name=package_coverage]').change(function () {
                var type = $(this).val();

                if (type === 'only-me') {
                    $('#adult').val(0).prop('disabled', true);
                    $('#kid').val(0).prop('disabled', true);
                    $('.addMore').hide();
                } else if (type === 'family') {
                    $('#adult').val(0).prop('disabled', true);
                    $('#kid').val(0).prop('disabled', true );
                    $('.addMore').show();
                } else if (type === 'others') {
                    $('#adult').prop('disabled', false);
                    $('#kid').prop('disabled', false);
                    $('.addMore').show();
                }
            });
        });


    </script>

    @stop
@endsection