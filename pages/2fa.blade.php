@extends('layouts.app')

@section('content')

<!-- Header start -->

@include('includes.header')
@push('styles')

<link rel="stylesheet" href="{{asset('verification/verification-code.css')}}" />
<link rel="stylesheet" href="{{asset('css/style.css')}}" />
@endpush
<!-- Header end -->

<style>
    .profile-edite.user-profile-edit .progress-bar .step .bullet.active span {
        display: block;
        background: #D71921;
        color: #fff;
        border-color: #D71921;
    }
    .profile-edite.user-profile-edit .progress-bar .step .bullet:before, .profile-edite.user-profile-edit .progress-bar .step .bullet:after{
        display:none;
    }
</style>
 <section class="v-code-main-box col-8 m-auto px-0 ">


    <div class="varification-header varification-header-pc bg-none">
        <h1>Enter verification code</h1>
    </div>
    
    <div class="line-box">
        <div class="line-one"></div>
        <div class="line-two"></div>
        <div class="line-three"></div>
    </div>
    <div class="col-10 m-auto ">
        <div class="col-10 m-auto ">
            <div>
                <p class="verificationn-p verificationn-p-pc text-center">The verification code has been sent to your email.</p>
                <h2 class="text-center h4 verificationn-pc-mail fw-bolder ">
                    @if(session('user_id'))
                        {{ session()->get('email') }}
                    @endif
                </h2>
            </div>
    
            <!-- start form  -->
             @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
           <form action="{{route('authorize.post')}}" method="POST">
             @csrf
                <div>
                    <label class="set-pass-label" for="v-code">@lang('Authentication Code')</label>
                    <div class="verification-code-wrapper">
                         <div class="verification-area"> 
                              
                                <div class="mb-3">
                                    
                                    <div class="verification-code">
                                        <input type="text" name="code" id="verification-code" class="form-control overflow-hidden" required autocomplete="off">
                                        <div class="boxes">
                                            <span>-</span>
                                            <span>-</span>
                                            <span>-</span>
                                            <span>-</span>
                                            <span>-</span>
                                            <span>-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                       </div>
                    <div class="d-none  justify-content-around ">
                       
              
               
                        
    
                        <div class="employ-login-single-box-pc m-2 p-0 v-code-norder">
                            <input class=" w-100 focus-none v-code-field" id="v-code1" name="v-code1" type="text" placeholder="" value="6">
                        </div>
    
                        <div class="employ-login-single-box-pc m-2 p-0 v-code-norder">
                            <input class=" w-100 focus-none v-code-field" id="v-code2" name="v-code2" type="text" placeholder="" value="3">
                        </div>
    
                        <div class="employ-login-single-box-pc m-2 p-0 v-code-norder">
                            <input class=" w-100 focus-none v-code-field" id="v-code3" name="v-code3" type="text" placeholder="" value="5">
                        </div>
    
                        <div class="employ-login-single-box-pc m-2 p-0 v-code-norder">
                            <input class=" w-100 focus-none v-code-field" id="v-cod4" name="v-cod44" type="text" placeholder="" value="7">
                        </div>
    
                        <div class="employ-login-single-box-pc m-2 p-0 v-code-norder">
                            <input class=" w-100 focus-none v-code-field" id="v-cod51" name="v-code5" type="text" placeholder="" value="7">
                        </div>
    
                        <div class="employ-login-single-box-pc m-2 p-0 v-code-norder">
                            <input class=" w-100 focus-none v-code-field" id="v-cod51" name="v-code6" type="text" placeholder="" value="7">
                        </div>
    
                    </div>
                </div>
                <div class="form--group">
                    <button type="submit" class="btn btn--base">@lang('Submit')</button>
                </div>
    
            </form>
            <!-- end form  -->
    
            <div class="text-center py-5">
                <a class="sent-new-code" href="{{route('send.verify.code')}}">Send new verification code</a>
            </div>
    
            <div class="verification-bottom text-center py-5">
                <p>If you don’t receive your verification code</p>
                <span>Please try again with a different email address.</span>
            </div>
        </div>
    </div>
    
    
    </section>



@include('includes.footer')
 
@endsection
@push('scripts')
<script>
        $('#verification-code').on('input', function () {
            $(this).val(function(i, val){
                if (val.length >= 6) {
                    $('.submit-form').find('button[type=submit]').html('<i class="las la-spinner fa-spin"></i>');
                    $('.submit-form').submit()
                }
                if(val.length > 6){
                    return val.substring(0, val.length - 1);
                }
                return val;
            });
            for (let index = $(this).val().length; index >= 0 ; index--) {
                $($('.boxes span')[index]).html('');
            }
        });
    </script>
@endpush