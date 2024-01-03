if (in_array(auth()->user()->user_role_id, [1, 2, 3]) && !auth('doctor')->check()) {}

if (!auth('doctor')->check() && (in_array(auth()->user()->user_role_id, [1, 2, 3]))) {}

if(auth()->user()->user_role_id == 5){}

if (!auth('doctor')->check() && auth()->user()->user_role_id != 5){}

if (! in_array(auth()->user()->user_role_id, [6, 7])) {}

if (in_array(auth()->user()->user_role_id, [6,7])){}

if ($row->status == 'Requested' || $row->status == 'Scheduled') {}


@if (auth()->user()->user_role_id == 1)
@if (auth()->user()->userRole()->name == 'admin')
@if(auth()->user()->userRole->name == 'super-consultant')
@if (auth('doctor')->check()){}
@if(auth('patient')->check()){}

@if (Custom::getAuth()->doctor_image)

{{auth('doctor')->user()->name_en  }}

$patient = Patient::findOrFail(auth('patient')->id());

@if(auth('patient')->check() && (request()->url() == URL::to('patient/dashboard') ))


{{ (request()->is('page*')) ? 'active' : '' }}
{{(request()->is('buying-house') ? 'Buying House' : 'Factory')}}
{{ Request::is('tsr-admin/discount-partner*')? 'm-menu__item--open' : '' }}
{{ Request::is('patient/')? 'active' : '' }}

@if(auth()->user()->userRole->name == 'super-consultant')
	Dashboard | <span class="user-role-title"> Super Consultant</span>
@elseif(auth()->user()->userRole->name == 'super-co-ordinator')
	Dashboard | <span class="user-role-title"> Master Coordinator</span>
@else
	Dashboard | <span class="user-role-title"> Coordinator</span>
@endif


$diseases = Disease::where('status', 'active')->orderBy('id', 'ASC')->pluck('name_en', 'id')->toArray();
$existingDisease = !(empty($patient->disease_id)) ? explode(',', $patient->disease_id) : null;

$diseases = Disease::where('status', 'active')->orderBy('id', 'ASC')->pluck('name_en', 'id')->toArray();
$diseaseNames = Disease::whereIn('id', $diseaseIds)->pluck('name_' . config('app.locale'))->implode(', ');

<!-- date time format -->
<!-- Updated by: Habibur Rahman  -->
<strong>Last Updated By</strong> : {{ $user->updatedBy->name??'' }}<br />

<strong>Last updated on</strong> : {{ date("h:i A \o\\n d F Y", strtotime($user->updated_at)) }}
<!-- Last Updated On: 06:20 PM on 11 September 2023  -->


$service_provider_id = (auth()->user()->user_role_id == 3) ? auth()->user()->service_provider_id :
$request->service_provider_id;

return (table . service_provider != null) ? table . service_provider . name_en : "--";
return (table . service_provider_type == null) ? '--' : table . service_provider_type . name_en;

<?php (in_array(old('user_role_id'), [2,3]) ? 'style="display:block;"' : 'style="display:none;"'); ?>

return datatables()->of($data)->editColumn('doctor.name_en', function ($row) {
return $row->doctor->title_en . ' ' . $row->doctor->name_en;
})


public function index()
{
if (request()->ajax()) {
$data = Specialist::select('specialists.*');
return datatables()->eloquent($data)->make(true);
}
return view('admin.specialist.index');
}

{{-- latest, take --}}
//$upcomingCourseEvents = CourseEvent::whereDate('start_date','>',now())->take(5)->get();
$upcomingCourseEvents = News::latest()->where('type','training')->take(4)->get();
$currentCourses = Course::all();
$news = News::latest()->where('type','training')->get();

{{ trans('text.learn_more') }}

{{-- random order --}}
$articles = Content::select(['id','title_'.config('app.locale').' as title', 'description_'.config('app.locale').' as
description', 'slug', 'images', 'content_category_id', 'created_at'])
->where('content_category_id', 17)->where('featured','yes')->where('status','active')
->inRandomOrder()
->take(2)
->get();


@section('page_title')
Primary Care Centre - PCC | All Appointment List
@stop


{{ url()->previous() }}

?>

<div class="form-group m-form__group row" id="show_service_provider"
    <?= (in_array(old('user_role_id'), [2,3,6,7]) ? 'style="display:block;"' : 'style="display:none;"'); ?>>

    <div class="form-group m-form__group row" id="show_service_provider" @if(old('user_role_id')) style="display:block;"
        @else style="display:none;" ; @endif>


        @if(auth('patient')->check() && in_array(request()->url(), [
        URL::to('patient/dashboard'), URL::to('patient/apply'), URL::to('patient/attachments'),
        URL::to('patient/carers') ]) || Str::startsWith(request()->path(), 'patient/membership-plan/checkout/'))

        @include('frontend.partials.carer-dashboard-menu')
        @else
        @include('frontend.partials.mainmenu')
        @endif

        {{-- or --}}
        @if(auth('patient')->check() && (request()->url() == URL::to('patient/dashboard') || (request()->url() ==
        URL::to('patient/apply-for-sponsorship')) || (request()->url() == URL::to('patient/medical-history')) ||
        (request()->url() == URL::to('patient/appointments')) || (request()->url() ==
        URL::to('patient/chemotherapy-history')) || (request()->url() == URL::to('patient/atachments')) ||
        (request()->url() == URL::to('patient/carers')) ))


        {!! Str::limit($item->description, 600, '.. <br /><a class="learn_more"
            href="/service-provider/'.$item->featuredServiceProviderType->slug.'/'.$item->slug.'">'.trans("text.learn_more").'
            <i class="fa fa-angle-double-right"></i></a>') !!}

        {!! Str::limit($item->description, 600) !!}
        <a class="learn_more"
            href="/service-provider/{{ $item->featuredServiceProviderType->slug }}/{{ $item->slug }}">{{ trans("text.learn_more") }}
            <i class="fa fa-angle-double-right"></i></a>


        @if ($loop->index == 0)
        <i class="fa fa-hospital-o"></i>
        @elseif ($loop->index == 1)
        <i class="fa fa-flask"></i>
        @elseif ($loop->index == 2)
        <i class="fa fa-medkit"></i>
        @elseif ($loop->index == 3)
        <i class="fas fa-prescription"></i>
        @elseif ($loop->index == 4)
        <i class="fa fa-user-md"></i>
        @endif


        // array data
        public function patient_bp_rbs1($id)
        {
        $patient_bp_rbs = PatientVisit::select('visit_date', 'bp', 'rbs')->where('patient_id',
        $id)->groupBy('patient_id')->get();

        $data = [];

        foreach ($patient_bp_rbs as $item) {
        $temp = [];
        $temp['date'] = $item->visit_date;
        $temp['bp'] = $item->bp;
        $temp['rbs'] = (int) $item->rbs;
        $data[] = $temp;
        }
        return view('admin.index', compact('data'));
        }


        <!-- Limit to the first two items -->
        <div class="cancer-treatment">
            @forelse ($visits as $key => $visit)
            @if ($key < 2) <!-- Limit to the first two items -->
                <div class="cancer-treatment_item">
                    <div class="treatment_item-head" role="button" data-toggle="modal"
                        data-target="#visitDetailsModal_{{ $visit->id }}" aria-expanded="false">
                        <span class="treatment_item-icon">
                            <i class="fa fa-stethoscope"></i>
                        </span>
                        <h6 class="treatment_item-title">
                            <span>Doctor's Consultation</span> on
                            <span>{{ date('d-M-Y', strtotime($visit->visit_date)) }}</span>
                        </h6>
                    </div>
                </div>
                @endif
                @empty
                No Medical History Found
                @endforelse
        </div>


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


        doctor_verify_status - approve
doctor_recommend_message
doctor_reject_message

investigation_status - approve
investigation_recommend_message
investigation_reject_message

final_review_status
final_status_message


when #doctor_verify_status  selected == 'recommend', then #doctor_recommend_message is removeClass 'd-none' and when #doctor_verify_status  selected == 'reject' then  #doctor_reject_message is removeClass 'd-none', when #investigation_status  selected == 'recommend', then #investigation_recommend_message is removeClass 'd-none' and when #investigation_status  selected == 'reject' then  #investigation_reject_message is removeClass 'd-none'


{
						field: "status",
						title: "Status",
						width: 75,
						template: function(table) {
							if(table.verify.final_status == 'approve'){
								return '<span class="m-badge bg-success m-badge--custom"> Approve </span>';
							} else if(table.verify.final_status == 'reject'){
								return '<span class="m-badge bg-danger m-badge--custom"> Reject </span>';
							} else if (table.verify.doctor_verify_status != null) {
								return '<span class="m-badge bg-warning m-badge--custom"> Pending </span>';
							} else {
								return '<span class="m-badge m-badge--brand m-badge--custom"> New </span>';
							}
						}
					},





$allData = SponsorshipContent::select([
    'id', 'd_de_title_' . config('app.locale') . ' as d_de_title', 'd_de_message_' . config('app.locale') . ' as d_de_message', 'd_rec_title_' . config('app.locale') . ' as d_rec_title', 'd_rec_message_' . config('app.locale') . ' as d_rec_message', 'd_rej_title_' . config('app.locale') . ' as d_rej_title', 'd_rej_message_' . config('app.locale') . ' as d_rej_message', 'i_de_title_' . config('app.locale') . ' as i_de_title',
    'i_de_message_' . config('app.locale') . ' as i_de_message',
    'i_rec_title_' . config('app.locale') . ' as i_rec_title',
    'i_rec_message_' . config('app.locale') . ' as i_rec_message',
    'i_rej_title_' . config('app.locale') . ' as i_rej_title',
    'i_rej_message_' . config('app.locale') . ' as i_rej_message',
    'f_de_title_' . config('app.locale') . ' as f_de_title',
    'f_de_message_' . config('app.locale') . ' as f_de_message',
    'f_con_title_' . config('app.locale') . ' as f_con_title',
    'f_con_message_' . config('app.locale') . ' as f_con_message',
    'f_rej_title_' . config('app.locale') . ' as f_rej_title',
    'f_rej_message_' . config('app.locale') . ' as f_rej_message',
])->first();
