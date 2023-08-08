<div class="col-md-5 margin-left">
    <p>Insert Patient Information</p>
    {!! Form::radio('patient_info', 'yes', (is_object($referal_data) && $referal_data->patient_info == 'yes'), ['id' => 'yes']) !!}
    {!! Form::label('yes', 'Yes') !!}&nbsp;&nbsp;&nbsp;
    {!! Form::radio('patient_info', 'no', (is_object($referal_data) && $referal_data->patient_info == 'no'), ['id' => 'no']) !!}
    {!! Form::label('no', 'No') !!}
</div>

<div class="col-md-3">
    <p class="pregnancy_status">Pregnancy Status</p>
    {!! Form::radio('visit_pregnancy_status', 'yes', (is_object($patientVisit) && $patientVisit->pregnancy_status == 'yes'), ['id' => 'yes']) !!}
    {!! Form::label('yes', 'Yes') !!}&nbsp;&nbsp;&nbsp;
    {!! Form::radio('visit_pregnancy_status', 'no', (is_object($patientVisit) && $patientVisit->pregnancy_status == 'no'), ['id' => 'no']) !!}
    {!! Form::label('no', 'No') !!}
</div>

<div class="col-md-3">
    <p class="pregnancy_status">Pregnancy Status</p>
    <input type="radio" name="visit_pregnancy_status" id="yes" value="yes" {{ (isset($patientVisit) && $patientVisit->pregnancy_status == 'yes') ? 'checked' : '' }}>
    <label for="yes">Yes</label>&nbsp;&nbsp;&nbsp;
    <input type="radio" name="visit_pregnancy_status" id="no" value="no" {{ (isset($patientVisit) && $patientVisit->pregnancy_status == 'no') ? 'checked' : '' }}>
    <label for="no">No</label>
</div>