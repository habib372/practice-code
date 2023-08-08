<!-- select 1 -->
<div class="col-md-3">
    <label for="pregnency_status">Pregnancy Status</label>
    {!! Form::select('visit_pregnency_status', ['yes'=>'Yes', 'no'=>'No'], $patientVisit->pregnency_status, ['class' => 'form-control', 'id' => 'pregnency_status','placeholder' => 'Please select an option' ]) !!}
</div>



<!-- radio item-1 -->
<div class="col-md-3">
    <p class="pregnancy_status">Pregnancy Status</p>
    {!! Form::radio('visit_pregnency_status', 'yes', ($patientVisit->pregnency_status == 'yes'), ['id' => 'yes']) !!}
    {!! Form::label('yes', 'Yes') !!}&nbsp;&nbsp;&nbsp;
    {!! Form::radio('visit_pregnency_status', 'no', ($patientVisit->pregnency_status == 'no'), ['id' => 'no']) !!}
    {!! Form::label('no', 'No') !!}
</div>
<!--radio item-2 -->
<div class="col-md-3">
    <p class="pregnancy_status">Pregnancy Status {{ $patientVisit->pregnency_status }}</p>
    <input type="radio" name="visit_pregnency_status" id="yes" value="yes" {{ $patientVisit->pregnency_status === 'yes' ? 'checked' : '' }}>
    <label for="yes">Yes</label>&nbsp;&nbsp;&nbsp;
    <input type="radio" name="visit_pregnency_status" id="no" value="no" {{ $patientVisit->pregnency_status === 'no' ? 'checked' : '' }}>
    <label for="no">No</label>
</div>

<!-- radio item-3 -->
<input type="radio" name="gender" value="2" id="gender" {{ ((@$data->gender == 2) ? "checked": '') }}> &nbsp Female
<input type="radio" name="gender" value="1" id="gender" {{ (@$data->gender == 1 ? "checked": '') }}> &nbsp Male



<!-- checkbox -1 -->
<div class="col-md-3">
    <p class="vaccination_status">Vaccination Status</p>
    <label for="covid-19">
        {!! Form::checkbox('visit_vaccination_status[]', 'covid-19', ($patientVisit->vaccination_status === 'covid-19'), ['id' => 'covid-19']) !!}
        Covid-19
    </label>&nbsp;&nbsp;&nbsp;
    <label for="booster">
        {!! Form::checkbox('visit_vaccination_status[]', 'booster', ($patientVisit->vaccination_status === 'booster'), ['id' => 'booster']) !!}
        Booster
    </label>&nbsp;&nbsp;&nbsp;
    <label for="flue-shot">
        {!! Form::checkbox('visit_vaccination_status[]', 'flue-shot', ($patientVisit->vaccination_status === 'flue-shot'), ['id' => 'flue-shot']) !!}
        Flue Shot
    </label>
</div>


$data = Patient::create([
'vaccination_status' => implode(',', $request->visit_vaccination_status),
]);


<!-- checkbox-2 -->
<div class="col-md-3">
    <p class="vaccination_status">Vaccination Status</p>
    <label for="covid-19">
        <input type="checkbox" name="visit_vaccination_status[]" id="covid-19" value="covid-19" {{ ($patientVisit->vaccination_status === 'covid-19') ? 'checked' : '' }}>
        Covid-19
    </label>&nbsp;&nbsp;&nbsp;
    <label for="booster">
        <input type="checkbox" name="visit_vaccination_status[]" id="booster" value="booster" {{ ($patientVisit->vaccination_status === 'booster') ? 'checked' : '' }}>
        Booster
    </label>&nbsp;&nbsp;&nbsp;
    <label for="flue-shot">
        <input type="checkbox" name="visit_vaccination_status[]" id="flue-shot" value="flue-shot" {{ ($patientVisit->vaccination_status === 'flue-shot') ? 'checked' : '' }}>
        Flue Shot
    </label>
</div>


<div class="col-md-3">
    @php
    $data = explode(',', $patientVisit->vaccination_status);
    @endphp
    <p class="vaccination_status">Vaccination Status</p>
    <label for="covid-19">
        {!! Form::checkbox('visit_vaccination_status[]', 'covid-19', in_array('covid-19', $data), ['id' => 'covid-19']) !!}
        Covid-19
    </label>&nbsp;
    <label for="booster">
        {!! Form::checkbox('visit_vaccination_status[]', 'booster', in_array('booster', $data), ['id' => 'booster']) !!}
        Booster
    </label>&nbsp;
    <label for="flue-shot">
        {!! Form::checkbox('visit_vaccination_status[]', 'flue-shot', in_array('flue-shot', $data), ['id' => 'flue-shot']) !!}
        Flue Shot
    </label>
</div>