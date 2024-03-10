@extends('layouts.frontend')

@section('content')

<style>
    .login .login-form .lost-pass {
        margin-left: 0px !important;
    }
    input::placeholder {
        font-size:14px;
    }

</style>

<!-- Registration -->
<section class="login section">
    <div class="container">
        <div class="inner">
            <div class="row">
                <div class="col-lg-12">
                    <div class="login-form">
                        <h2>Registration Form</h2>
                        <!-- Form -->
                        <form class="form" method="POST" action="{{ route('doRegistration') }}" enctype="multipart/form-data" autocomplete="off">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6 col-12">
                                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="" aria-label="name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="small text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" autocomplete="off" name="email" class="form-control" id="email" placeholder="" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="small text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="mobile" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="" aria-label="mobile"  value="{{ old('mobile') }}">
                                    @error('mobile')
                                        <span class="small text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="alt_mobile" class="form-label">Alternate Contact Number </label>
                                    <input type="text" name="alt_mobile" class="form-control" placeholder="" aria-label="alt_mobile" value="{{ old('alt_mobile') }}">
                                    @error('alt_mobile')
                                        <span class="small text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="username" class="form-label">Username (Use for login) <span class="text-danger">*</span></label>
                                    <input type="text" name="username" class="form-control" placeholder="" id="username" value="{{ old('username') }}">
                                    @error('username')
                                        <span class="small text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" autocomplete="off" class="form-control" id="password" value="{{ old('password') }}">
                                    @error('password')
                                        <span class="small text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-12">
                                    <label for="confirm_password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" name="confirm_password" autocomplete="off" class="form-control" id="confirm_password" value="{{ old('confirm_password') }}">
                                    <span class="small text-danger" style="display: none" id="passwordMismatch">Passwords do not match</span>
                                    @error('confirm_password')
                                        <span class="small text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                    <input name="date_of_birth" class="datepicker form-control" id="date_of_birth" type="text" placeholder=""  value="{{ old('date_of_birth') }}">
                                    @error('date_of_birth')
                                        <span class="small text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                    <select name="gender" id="gender" class="form-select" aria-label=".form-select-sm example" value="{{ old('gender') }}">
                                        <option value=""></option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
                                    </select>
                                    @error('gender')
                                        <span class="small text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="street, city, country" value="{{ old('address') }}">
                                    @error('address')
                                        <span class="small text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="" value="{{ old('phone') }}">
                                    @error('phone')
                                        <span class="small text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-8">
                                    <label for="photo" class="form-label">Photo</label>
                                    <input type="file" name="photo" class="form-control" id="photo" placeholder="" value="{{ old('photo') }}">
                                    @error('photo')
                                        <span class="small text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3 col-4 text-center">
                                    <img class="preview_logo" src="/uploads/default_user.jpg" id="output_image" width="80px" />
                                </div>

                                <div class="col-12 mt-5">
                                    <button type="submit" class="btn btn-primary margin-right-10">Sign Up</button>
                                    <button type="submit" class="btn btn-secondary"><a class="text-white" href="{{ route('nrbsLogin')}}">Cancel</a></button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Login -->

@section('js')

        <script>
            $(document).ready(function(){
                $(document).on('keyup change', '#mobile', function(){
                    $("#username").val($("#mobile").val());
                });
            })

         // date picker
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
        </script>

        <script>
            $(document).ready(function() {
                // Check password match on input change
                $('#password, #confirm_password').on('input', function() {
                    var password = $('#password').val();
                    var confirm_password = $('#confirm_password').val();

                    if ((password == '' && confirm_password === '') || (password !== '' && confirm_password === '') ) {
                        $('#passwordMismatch').hide();
                    }else {
                         if (password === confirm_password) {
                            $('#confirm_password').removeClass('border-danger').addClass('border-success');
                            $('#passwordMismatch').hide();
                        } else {
                            $('#confirm_password').removeClass('border-success').addClass('border-danger');
                            $('#passwordMismatch').show();
                        }
                    }
                });
            });
        </script>

    @stop
@endsection