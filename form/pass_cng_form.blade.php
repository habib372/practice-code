<div class="col-md-6 col-12">
    <label for="username" class="form-label">Username (Use for login) <span class="text-danger">*</span></label>
    <input type="text" name="username" class="form-control" placeholder="" id="username" value="{{ $data->username }}" readonly="" disabled>
    @error('username')
    <span class="small text-danger">{{$message}}</span>
    @enderror
</div>
<div class="col-md-6 col-12">
    <label for="oldpassword" class="form-label">Password <span class="text-danger">*</span></label>
    <input type="password" autocomplete="off" class="form-control" id="oldpassword" value="********" readonly="" disabled>
    @error('password')
    <span class="small text-danger">{{$message}}</span>
    @enderror
</div>
<div class="col-md-6 col-12">
    <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
    <input type="password" name="password" autocomplete="off" class="form-control" id="password" value="{{ old('password') }}">
    @error('password')
    <span class="small text-danger">{{$message}}</span>
    @enderror
</div>
<div class="col-md-6 col-12">
    <label for="confirm_password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
    <input type="password" name="confirm_password" autocomplete="off" class="form-control" id="confirm_password" value="{{ old('confirm_password') }}">
    <span class="small text-danger" style="display: none" id="passwordMismatch">Passwords do not match</span>
    @error('confirm_password')
    <span class="small text-danger">{{$message}}</span>
    @enderror
</div>

