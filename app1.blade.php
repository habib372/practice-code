<div class="traveller_info">
    <h5>Traveller Info: <span class="text-danger">*</span></h5>
    <div class="row g-2">
        <div class="col-md-6 col-12">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="" aria-label="name"
                value="{{ old('name') }}" required>
            @error('name')
            <span class="small text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6 col-12">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" id="email" placeholder="" value="{{ old('email') }}"
                required>
            @error('email')
            <span class="small text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6 col-12">
            <label for="mobile" class="form-label">Contact Number <span class="text-danger">*</span></label>
            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="" aria-label="mobile"
                value="{{ old('mobile') }}" required>
            @error('mobile')
            <span class="small text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6 col-12">
            <label for="alt_mobile" class="form-label">Alternate Contact Number </label>
            <input type="text" name="alt_mobile" class="form-control" placeholder="" aria-label="alt_mobile"
                value="{{ old('alt_mobile') }}">
            @error('alt_mobile')
            <span class="small text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6 col-12">
            <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
            <input name="date_of_birth" class="datepicker form-control" id="date_of_birth" type="text"
                autocomplete="off" value="{{ old('date_of_birth') }}" required>
            @error('date_of_birth')
            <span class="small text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6 col-12">
            <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
            <select name="gender" id="gender" class="form-select" aria-label=".form-select-sm example"
                value="{{ old('gender') }}" required>
                <option value="">Select gender</option>
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
            <input type="text" name="address" class="form-control" id="address" placeholder="street, city, country"
                value="{{ old('address') }}">
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
        <div class="col-md-4 col-12 add-more-btn">
            <button type="button" id="addMoreTraveller" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add More
                Traveller</button>
        </div>
    </div>
</div>


