<input type="text" name="patient_password" id="patient_password" value="{{rand(111111,999999)}}" placeholder="Enter password">

<div class="col-md-6">
    <div class="form-group">
        <label for="patient_disease_id">
            Chronic Disease <span class="text-danger">*</span>
        </label>
        {!! Form::select('patient_disease_id', $diseases, null, ['class' => 'form-control select2', 'id' => 'patient_disease_id']) !!}
        @error('patient_disease_id')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>


<div class="col-lg-6 col-md-6 col-12">
    <div class="form-group">
        <label for="patient_date_of_birth">Date of Birth <span class="text-danger">*</span></label>
        <input name="patient_date_of_birth" class="datepicker" id="patient_date_of_birth" type="text" value="{{auth('patient')->user()->date_of_birth}}">
    </div>
</div>
