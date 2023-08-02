<div class="col-md-4">
    <label for="patient_disease_type_id">
        Disease Type<span class="text-danger">*</span>
    </label>
    {!! Form::select('patient_disease_type_id', $diseases_type, null, ['class' => 'form-control m-input select2', 'id' => 'patient_disease_type_id']) !!}
    @error('patient_disease_type_id')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="col-md-4">
    <label for="patient_disease_id">
        Disease <span class="text-danger">*</span>
    </label>
    {!! Form::select('patient_disease_id', $diseases, null, ['class' => 'form-control m-input select2', 'id' => 'patient_disease_id']) !!}
    @error('patient_disease_id')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>
<div class="col-md-4" id="stage_id">
    <label for="patient_stage_id">
        Stage
    </label>
    {!! Form::select('patient_stage_id', $stages, null, ['class' => 'form-control m-input select2', 'id' => 'patient_stage_id']) !!}
    @error('patient_stage_id')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>