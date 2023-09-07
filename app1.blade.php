
<div class="form-group m-form__group row">
    <div class="col-lg-12">
        <label for="dashboard_cards">Dashboard Cards</label>
        {!! Form::select('dashboard_cards[]', $dashboardCards, null, ['class' => 'form-control m-select2 m_select2_3', 'id' => 'dashboard_cards', 'style'=>'width:100%', 'multiple' => 'multiple']) !!}
        @error('dashboard_cards')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>

<div class="col-lg-8 col-md-12">
    <label for="consultation_days">Select consultation days <span class="text-danger">*</span></label>
    {!! Form::select('consultation_days[]', $weekDays, null, ['class' => 'form-control m-select2 m_select2_3', 'id' => 'consultation_days', 'multiple' => 'multiple']) !!}
    @error('consultation_days')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>


<div class="col-md-12">
    <label for="patient_disease_id">
        Select Disease <span class="text-danger">*</span>
    </label>
    {!! Form::select('patient_disease_id[]', $diseases, $existingDisease, ['class' => 'form-control m-input select2 m_select2_3', 'id' => 'patient_disease_id', 'multiple' => 'multiple']) !!}
    @error('patient_disease_id')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>
