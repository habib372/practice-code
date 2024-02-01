@extends('layouts.app')

@section('content')

<!-- Header start -->

@include('includes.header')

<!-- Header end -->

@push('styles')
<link rel="stylesheet" href="{{asset('css/style.css')}}" />
@endpush
<section class="v-code-main-box col-8 m-auto px-0 ">


    <div class="varification-header varification-header-pc bg-none">
        <h1>Password Setting</h1>
    </div>

    <div class="line-box">
        <div class="line-one"></div>
        <div class="line-two"></div>
        <div class="line-three"></div>
    </div>
    <div class="col-10 m-auto ">
        <div class="col-10 m-auto ">
            <div>
                <p class="verificationn-p verificationn-p-pc text-center">If you are using iOS16.0, you may not be able to login

                    properly, Please update your iOS to the latest version.</p>
            </div>

            <!-- start form  -->


            <!-- end form  -->

            <!-- start form  -->
            <form action="{{route('savepass')}}" method="post">
                @csrf
                <div class="pt-3">
                    <p class="set-apass-choose-ass">Please set a password</p>
                </div>
                <div>
                    <label class="set-pass-label" for="password">New password</label>
                    <div class="employ-login-single-box pc-set-pass-label">
                        <input class="border-0 w-100 pt-2 employ-login-border px-3 focus-none" id="password" name="password" type="password" placeholder="New Password" required>
                        @if ($errors->has('password')) <span class="help-block text-danger mb-2 d-block"> <strong>{{ $errors->first('password') }}</strong> </span> @endif 
                    </div>

                    <div>
                        <p class="check-pass">Password strength:</p>
                        <div class=" check-line-box">
                            <div class="check-line"></div>
                            <div class="check-line"></div>
                            <div class="check-line"></div>
                            <div class="check-line"></div>
                        </div>
                    </div>
                </div>
                

                <div>
                    <label class="set-pass-label" for="re-password">New password (confirm)</label>
                    <div class="employ-login-single-box pc-set-pass-label">
                        <input class="border-0 w-100 pt-2 employ-login-border px-3 focus-none" id="re-password" name="password_confirmation" type="password" placeholder="Please enter again to confirm" required>
                    </div>
                </div>
                
                <div class=" d-flex align-content-center ">
                    <input class="login-checkbox" type="checkbox" name="checkbox" id="checkbox">
                    <label class="px-2 pt-1 login-" for="checkbox login-checkbox">Remember me?.</label>
                </div>

                <div class="py-5">
                    <button class="switch-button set-pass-btn" id="step9pre" type="submit">Set</button>
                </div>
            </form>
            

            
        </div>
    </div>


</section>

@include('includes.footer')

@endsection
@push('scripts')
<script src="{{asset('js/main.js')}}"></script>
@endpush