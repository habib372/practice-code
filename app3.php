<div class="col-lg-6 col-md-6 col-12">
    <div class="form-group">
        <label for="patient_country_id">Country </label>
    </div>
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