 <div class="col-md-4 col-sm-12">
     <label for="patient_mobile">
         Mobile <span class="text-danger">*</span>
     </label>
     <input type="text" class="form-control m-input" name="patient_mobile" id="patient_mobile"
         aria-describedby="patient_mobile" placeholder="" value="{{ old('patient_mobile', $patient->mobile) }}">
     @error('patient_mobile')
     <span class="text-danger">{{$message}}</span>
     @enderror
 </div>


 <div class="form-group m-form__group row">
     <div class="col-lg-12">
         <label for="dashboard_cards">Dashboard Cards</label>
         {!! Form::select('dashboard_cards[]', $dashboardCards, null, ['class' => 'form-control m-select2 m_select2_3',
         'id' => 'dashboard_cards', 'style'=>'width:100%', 'multiple' => 'multiple']) !!}
         @error('dashboard_cards')
         <span class="text-danger">{{$message}}</span>
         @enderror
     </div>
 </div>

 <div class="col-lg-8 col-md-12">
     <label for="consultation_days">Select consultation days <span class="text-danger">*</span></label>
     {!! Form::select('consultation_days[]', $weekDays, null, ['class' => 'form-control m-select2 m_select2_3', 'id' =>
     'consultation_days', 'multiple' => 'multiple']) !!}
     @error('consultation_days')
     <span class="text-danger">{{$message}}</span>
     @enderror
 </div>


 <div class="col-md-12">
     <label for="patient_disease_id">
         Select Disease <span class="text-danger">*</span>
     </label>
     {!! Form::select('patient_disease_id[]', $diseases, $existingDisease, ['class' => 'form-control m-input select2
     m_select2_3', 'id' => 'patient_disease_id', 'multiple' => 'multiple']) !!}
     @error('patient_disease_id')
     <span class="text-danger">{{$message}}</span>
     @enderror
 </div>


 <form action="" method="">
     <div class="form-group">
         {!! Form::select('patient_country_id', $countries, auth('patient')->user()->country_id, ['class' =>
         'form-control m-input select2', 'id' => 'patient_country_id']) !!}
         <button type="button" class="btn custom-padding btn-primary float-left">Submit</button>
     </div>
 </form>

 <div class="article">
     <a href="#">
         <h6>When You Are The Primary Caregiver Of A Cancer Patient</h6>
         <img class="article-img rounded" src="{{ asset('images/contents/1639886726473.png') }}"
             alt="Food Habit In Preventing Cancer">
         <p> In today's life, 'Cancer' is not only a life-threatening disease but also it's a curse to all... </p>
     </a>
 </div>


 {{-- module-3 --}}
 <label for="name">
     Doctor Type <span class="text-danger">*</span>
 </label>
 <div class="m-radio-inline">
     <label class="m-radio">
         <input type="radio" name="visit_type" id="visit_type_internal_doctor" class="visit-type"
             value="Internal Doctor" <?= old('visit_type') == 'Internal Doctor' ? 'checked='.'"checked"' : ''; ?> />
         Internal Doctor
         <span></span>
     </label>
     <label class="m-radio">
         <input type="radio" name="visit_type" id="visit_type_external_doctor" class="visit-type"
             value="External Doctor" <?= old('visit_type') == 'External Doctor' ? 'checked='.'"checked"' : ''; ?>>
         External Doctor
         <span></span>
     </label>
 </div>
 <div class="col-md-6">
     <div id="doctorHolder"
         <?= old('visit_type') == 'Internal Doctor' ? 'style="display:block"' : 'style="display:none"'; ?>>
         <label for="visit_doctor_id">
             Select Internal Doctor <span class="text-danger">*</span>
         </label>
         {!! Form::select('visit_doctor_id', $doctors, null, ['class' => 'form-control m-input', 'id' =>
         'visit_doctor_id']) !!}
         @error('visit_doctor_id')
         <span class="text-danger">{{$message}}</span>
         @enderror
     </div>
     <div id="outDoctorHolder"
         <?= old('visit_type') == 'External Doctor' ? 'style="display:block"' : 'style="display:none"'; ?>>
         <label for="external_doctor">
             External Doctor <span class="text-danger">*</span>
         </label>
         <textarea name="external_doctor" class="form-control m-input" id="external_doctor"
             rows="3">{{ old('external_doctor') }}</textarea>

         @error('external_doctor')
         <span class="text-danger">{{$message}}</span>
         @enderror
     </div>
 </div>


 {{-- module-4 --}}
 <div class="row margin-bottom-15">
     <div class="col-md-3">
         <p class="pregnancy_status">Pregnancy Status</p>
         {!! Form::radio('visit_pregnency_status', 'yes', ($patientVisit->pregnency_status == 'yes'), ['id' =>
         'pregnancy_yes']) !!}
         {!! Form::label('pregnancy_yes', 'Yes') !!}&nbsp;&nbsp;&nbsp;
         {!! Form::radio('visit_pregnency_status', 'no', ($patientVisit->pregnency_status == 'no'), ['id' =>
         'pregnency_no']) !!}
         {!! Form::label('pregnency_no', 'No') !!}
     </div>

     <div class="col-md-3">
         <p class="smoker">Smoker</p>
         {!! Form::radio('visit_smoker', 'yes', ($patientVisit->smoker == 'yes'), ['id' => 'smoker_yes']) !!}
         {!! Form::label('smoker_yes', 'Yes') !!}&nbsp;&nbsp;&nbsp;
         {!! Form::radio('visit_smoker', 'socially', ($patientVisit->smoker == 'socially'), ['id' =>
         'smoker_socially']) !!}
         {!! Form::label('smoker_socially', 'Socially') !!}&nbsp;&nbsp;&nbsp;
         {!! Form::radio('visit_smoker', 'no', ($patientVisit->smoker == 'no'), ['id' => 'smoker_no']) !!}
         {!! Form::label('smoker_no', 'No') !!}
     </div>

     <div class="col-md-3">
         <p class="drinker">Drinker</p>
         {!! Form::radio('visit_drinker', 'yes', ($patientVisit->drinker == 'yes'), ['id' => 'drinker_yes']) !!}
         {!! Form::label('drinker_yes', 'Yes') !!}&nbsp;&nbsp;&nbsp;
         {!! Form::radio('visit_drinker', 'socially', ($patientVisit->drinker == 'socially'), ['id' =>
         'drinker_socially']) !!}
         {!! Form::label('drinker_socially', 'Socially') !!}&nbsp;&nbsp;&nbsp;
         {!! Form::radio('visit_drinker', 'no', ($patientVisit->drinker == 'no'), ['id' => 'drinker_no']) !!}
         {!! Form::label('drinker_no', 'No') !!}
     </div>


     <h6 class="custom_padding">Select Facilities <span class="text-danger">*</span></h6>
     <div class="form-group m-form__group row facility_section">
         @foreach ($facilities as $item)
         @php $id = $item->id; @endphp
         <div class="col-md-3">
             <p class="facility_item">{{ $item->id.'. '.$item->title_en }}</p>
             {!! Form::radio('facility_'.$id, 'active', ($item->facility_1== 'active'),['id' =>
             'facility_'.$id.'_active']) !!}
             {!! Form::label('facility_'.$id.'_active', 'Yes') !!}&nbsp;&nbsp;&nbsp;
             {!! Form::radio('facility_'.$id, 'inactive', ($item->facility_1 =='inactive'), ['id' =>
             'facility_'.$id.'_inactive']) !!}
             {!! Form::label('facility_'.$id.'_inactive', 'No') !!}
         </div>
         @endforeach
     </div>


     <div class="col-md-3">
         @php
         $data = explode(',', $patientVisit->vaccination_status);
         @endphp
         <p class="vaccination_status">Vaccination Status</p>
         <label for="covid-19">
             {!! Form::checkbox('visit_vaccination_status[]', 'covid-19', in_array('covid-19', $data), ['id' =>
             'covid-19']) !!}
             Covid-19
         </label>&nbsp;
         <label for="booster">
             {!! Form::checkbox('visit_vaccination_status[]', 'booster', in_array('booster', $data), ['id' =>
             'booster']) !!}
             Booster
         </label>&nbsp;
         <label for="flue-shot">
             {!! Form::checkbox('visit_vaccination_status[]', 'flue-shot', in_array('flue-shot', $data), ['id' =>
             'flue-shot']) !!}
             Flue Shot
         </label>&nbsp;
         <label for="others">
             {!! Form::checkbox('visit_vaccination_status[]', 'others', in_array('others', $data), ['id' =>
             'others']) !!}
             Others
         </label>
     </div>


 </div>


 <select name="adult" id="adult">
     @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}" {{ old('adult') == $i ? 'selected' : '' }}>{{ $i }}</option>
         @endfor
 </select>


 <div id="customSelect" style="display: ;" class="col-md-12 col-12 custom-select">
     <label>Adult : </label>
     <select name="adult" id="adult">
         @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}" {{ old('adult') == $i ? 'selected' : '' }}>{{ $i }}
             </option>
             @endfor
     </select>

     <label>Kid : </label>
     <select name="kid" id="adult">
         @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}" {{ old('adult') == $i ? 'selected' : '' }}>{{ $i }}
             </option>
             @endfor
     </select>
 </div>