
<form action="{{ route('massage_send') }}" method="POST">
    @csrf
    <div class="row mt-30">
        <div class="col-md-6">
            <div class="form-group">
                <label class="input_title" for="input_name">Full Name</label>
                <span class="icon"><img src="{{ asset('frontend_assets/img/icons/user.svg') }}" alt=""></span>
                <input id="input_name" class="form-control" type="text" name="name" placeholder="Enter your name" value="{{ old('name') }}" required>
                @error('name')
                <div class="alert alert-danger"><span>{{ $message }}</span></div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="input_title" for="input_email">Your Email</label>
                <span class="icon"><img src="{{ asset('frontend_assets/img/icons/sms-tracking.svg') }}" alt=""></span>
                <input id="input_email" class="form-control" type="email" name="email" placeholder="Enter  email address" value="{{ old('email') }}" required>
                @error('email')
                <div class="alert alert-danger"><span>{{ $message }}</span></div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="input_title" for="input_phone">Your Phone</label>
                <span class="icon"><img src="{{ asset('frontend_assets/img/icons/call-icon.png') }}" alt=""></span>
                <input id="input_phone" class="form-control" type="text" name="phone" placeholder="Enter phone number" value="{{ old('phone') }}" required>
                @error('phone')
                <div class="alert alert-danger"><span>{{ $message }}</span></div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="input_title">Message Type</label>
                <div class="custom-check">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="inquiry" value="Inquiry" {{ old('type') == 'Inquiry' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inquiry">Inquiry</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="feedback" value="Feedback" {{ old('type') == 'Feedback' ? 'checked' : '' }}>
                        <label class="form-check-label" for="feedback">Feedback</label>
                    </div>
                </div>
                @error('type')
                <div class="alert alert-danger"><span>{{ $message }}</span></div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="input_title" for="input_name">Subject</label>
                <span class="icon"><img src="{{ asset('frontend_assets/img/icons/cta-icon02.png') }}" alt=""></span>
                <input id="input_name" class="form-control" type="text" name="subject" placeholder="Enter  subject" value="{{ old('subject') }}" required>
                @error('subject')
                <div class="alert alert-danger"><span>{{ $message }}</span></div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="input_title" for="input_textarea">Message</label>
                <span class="icon"><img src="{{ asset('frontend_assets/img/icons/messages-2.svg') }}" alt=""></span>
                <textarea id="input_textarea" class="form-control" name="message" placeholder="How can we help you?" required>{{ old('message') }}</textarea>
                @error('message')
                <div class="alert alert-danger"><span>{{ $message }}</span></div>
                @enderror
            </div>
        </div>
        <!-- reCAPTCHA widget -->
        <div class="col-12">
            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="{{ config('recaptcha.site_key') }}"></div>
                @if ($errors->has('g-recaptcha-response'))
                <div class="alert alert-danger"><span>{{ $errors->first('g-recaptcha-response') }}</span></div>
                @endif
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="xoomcare-btn thm-btn btn-main btn-submit"> Send Message <span></button>
        </div>
    </div>
</form>