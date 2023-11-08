<div class="step-circle">
    <div class="index-text"><i class="fa fa-check"></i></div>
</div>
<div class="index-box">
    <i class="fa fa-caret-down"></i>
</div>



public function sponsorshipApply()
{
$patient = Patient::findOrFail(auth('patient')->id());
$diseases = Disease::where('status', 'active')->orderBy('id', 'ASC')->pluck('name_en', 'id')->toArray();
$existingDisease = !(empty($patient->disease_id)) ? explode(',', $patient->disease_id) : null;
$diseases = Disease::where('status', 'active')->orderBy('id', 'ASC')->pluck('name_en', 'id')->toArray();
$stages = ['' => '-- Select Stage --'] + Stage::pluck('stage_en', 'id')->toArray();
$countries = Country::pluck('name', 'id')->toArray();
$districts = ['' => '-- Select District --'] + District::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
$treatmentType = ['' => '-- Select Treatment Type --', 'chemotherapy ' => 'Chemotherapy ', 'radiotherapy_imaging' => 'Radiotherapy/Imaging', 'immunotherapy' => 'Immunotherapy', 'surgery ' => 'Surgery ', 'others ' => 'Others',];

$sponsorshipData = Sponsorship::with(['district', 'country', 'patient', 'disease', 'stage'])->where('patient_id', auth('patient')->id())->latest()->first();
if( $sponsorshipData){
$daysDifference = $this->calculateDaysDifference($sponsorshipData->created_at);
$verification = SponsorshipVerify::where('sponsorship_id', $sponsorshipData->id)->first();
}

return view('frontend.patient.sponsorship_form', compact('patient', 'existingDisease', 'countries', 'districts', 'diseases', 'stages', 'treatmentType', 'sponsorshipData', 'verification', 'daysDifference'));
}

@php
if (($sponsorshipData === null) || ($daysDifference > 7)) {
$activeOrDone = 'is-active';
$display = '';
} else{
$activeOrDone = 'done';
$display = 'd-none';
}
@endphp


@php
if (($sponsorshipData === null) || ($daysDifference > 7))
{
$apply_activeOrDone = 'is-active';
$apply_display = '';
} else if(($sponsorshipData != null) && ($daysDifference < 7) && ($verification->doctor_verify_status === null)){
    $apply_activeOrDone = 'done';
    $apply_display = 'd-none';
    $doctor_activeOrDone = 'is-active';
    $doctor_display = '';
    }else if(($sponsorshipData != null) && ($daysDifference < 7) && ($verification->doctor_verify_status != null)){
        $doctor_activeOrDone = 'done';
        $doctor_display = 'd-none';
        $staff_activeOrDone = 'is-active';
        $staff_display = '';
        }else if(($sponsorshipData != null) && ($daysDifference < 7) && ($verification->doctor_verify_status === null)){

            }else{

            }
            @endphp


            doctor_verify_status
            investigation_status
            final_status

            $apply_activeOrDone
            $doctor_activeOrDone
            $staff_activeOrDone
            $final_activeOrDone

            $apply_form = 'hide';
            $doctor_approve_message = 'hide';
            $doctor_recommend_message = 'hide';
            $doctor_reject_message = 'hide';

            $staff_approve_message = 'hide';
            $staff_recommend_message = 'hide';
            $staff_reject_message = 'hide';