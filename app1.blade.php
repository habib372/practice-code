
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


<form action="" method="">
    <div class="form-group">
        {!! Form::select('patient_country_id', $countries, auth('patient')->user()->country_id, ['class' => 'form-control m-input select2', 'id' => 'patient_country_id']) !!}
        <button type="button" class="btn custom-padding btn-primary float-left">Submit</button>
    </div>
</form>

<div class="article">
    <a href="#">
        <h6>When You Are The Primary Caregiver Of A Cancer Patient</h6>
        <img class="article-img rounded" src="{{ asset('images/contents/1639886726473.png') }}" alt="Food Habit In Preventing Cancer">
        <p> In today's life, 'Cancer' is not only a life-threatening disease but also it's a curse to all... </p>
    </a>
</div>