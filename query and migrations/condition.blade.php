

if (in_array(auth()->user()->user_role_id, [1, 2, 3]) && !auth('doctor')->check()) {}

if (!auth('doctor')->check() && (in_array(auth()->user()->user_role_id, [1, 2, 3]))) {}

if(auth()->user()->user_role_id == 5){}

if (!auth('doctor')->check() && auth()->user()->user_role_id != 5){}

if (! in_array(auth()->user()->user_role_id, [6, 7])) {}

if (in_array(auth()->user()->user_role_id, [6,7])){}


if ($row->status == 'Requested' || $row->status == 'Scheduled') {}

@elseif(in_array(auth()->user()->userRole->name, ['author','publisher','ad-manager']))

{{ old('title_en', $content->title_en) }}

@if (auth()->user()->user_role_id == 1)
@if (auth()->user()->userRole()->name == 'admin')
@if(auth()->user()->userRole->name == 'super-consultant')
@if (auth('doctor')->check()){}
@if(auth('patient')->check()){}
{{auth('patient')->user()->name}}
auth('patient')->id()

@if (Custom::getAuth()->doctor_image)

{{auth('doctor')->user()->name_en  }}

$patient = Patient::findOrFail(auth('patient')->id());

@if(auth('patient')->check() && (request()->url() == URL::to('patient/dashboard') ))

{{ $errors->has('username')? ' border-danger' : '' }}

{{ (request()->is('page*')) ? 'active' : '' }}
{{(request()->is('buying-house') ? 'Buying House' : 'Factory')}}
{{ Request::is('tsr-admin/discount-partner*')? 'm-menu__item--open' : '' }}
{{ Request::is('patient/')? 'active' : '' }}
<li><a href="{{ url(request()->is('/') ? '#contact' : '/#contact') }}">Contact</a></li>

@if(auth()->user()->userRole->name == 'super-consultant')
	Dashboard | <span class="user-role-title"> Super Consultant</span>
@elseif(auth()->user()->userRole->name == 'super-co-ordinator')
	Dashboard | <span class="user-role-title"> Master Coordinator</span>
@else
	Dashboard | <span class="user-role-title"> Coordinator</span>
@endif


$uri = request()->path(); // Get the request URI path

if (preg_match('#^(en|bn)/promote-ad/.*$#', $uri)) {
    $paymentfor = 'promote';
} else if (preg_match('#^(en|bn)/renew-ad/.*$#', $uri)) {
    $paymentfor = 'renew';
} else {
    $paymentfor = 'paid';
}

{{ old('gender') == 'male' ? 'selected' : '' }}


<!-- skip first data -->
$memberships = ['' => '-- Select a membership --'] + Membership::where('status', 'active')->pluck('name_en', 'id')->slice(1)->toArray();


<!-- multiple disease by id -->
 $patientVisit = PatientVisit::with(['patient.disease', 'patient.chemotherapies' => function($query){
        $query->orderBy('date_of_admission', 'desc');
    }])->findOrFail($id);

$existingDisease = !empty($patientVisit->disease_id) ? explode(',', $patientVisit->disease_id) : explode(',', $patientVisit->patient->disease_id);
$diseases = Disease::where('status', 'active')->orderBy('id', 'DESC')->pluck('name_en', 'id')->toArray();

$chronicDisease = explode(',', $patientVisit->patient->disease_id);
$diseaseNames = Disease::whereIn('id', $chronicDisease)->pluck('name_en')->implode(', ');


$countries =  ['' => '-- Select Country --'] + Country::pluck('name', 'id')->toArray();
$districts = ['' => '-- Select District --'] + District::orderBy('name', 'ASC')->pluck('name', 'id')->toArray();

$patients = ['' => '-- Search Member By ID/Name/Mobile Number --'] + Patient::select(DB::raw('CONCAT( \'FCB\', id, \' - \', name, \' - \', mobile) as name'), 'id')->pluck('name', 'id')->toArray();

$memberships = ['' => '-- Select a membership --'] + Membership::where('status', 'active')->pluck('name_en', 'id')->slice(1)->toArray();

$membershipName = ['' => '-- Select a membership --'] + Membership::where('status', 'active')->pluck('name_en', 'name_en')->toArray();

$paymentMode = ['' => '-- Select mode of payment --', 'cash' => 'Cash', 'bkash' => 'Bkash', 'rocket' => 'Rocket', 'nagad' => 'Nagad', 'credit-card' => 'Credit Card', 'bank-account' => 'Bank Account'];


$membership_payment_data = App\Models\MembershipPay::with('membership')
            ->where('patient_id', auth('patient')->id())
            ->whereIn('status', ['Complete', 'Paid'])
            ->orderBy('id', 'DESC')
            ->first();


 Appointment::where('id', $request->appointment_id)->update([
                'bill_amount' => $request->payable_amount,
                'discount_value' => $request->discount_value,
                'discount_method' => $request->discount_type,
                'payable_amount' => $request->fees
            ]);


 $blog = Blog::where('slug', 'LIKE','%'.$slug.'%')->first();

 {{Illuminate\Support\Str::lower(Str::of($projecCategory->name)->replace(' ', '-') ??'')}}


  public function projectDetails($slug) {
        // Decode the URL parameter
        $name = urldecode(str_replace("-", " ", $slug));

        // Use parameter binding to handle special characters
        $data = Project::with('projectimage')
            ->where('name', $name)
            ->first();

        return view('website.page.projectDetails', compact('data'));
    }


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



<select name="adult" id="adult">
   @for ($i = 1; $i <= 10; $i++)
    <option value="{{ $i }}" {{ old('adult') == $i ? 'selected' : '' }}>{{ $i }}</option>
   @endfor
</select>


<div class="col-md-6 col-12">
    <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
    <select name="gender" id="gender" class="form-select" aria-label="form-select-sm example" required>
        <option value="">Select gender</option>
        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
        <option value="others" {{ old('gender') == 'others' ? 'selected' : '' }}>Others</option>
    </select>
    @error('gender')
        <span class="small text-danger">{{ $message }}</span>
    @enderror
</div>




<?php
// <!-- nested loop: --> showing promotional ads into all products page in 7th position
public function index(){

    $products = Product::all()->paginate(13);

    $promotionalAds = PromotionalAds::all();
    $currentPage = request()->query('page', 1); // Get the current page number
    $promotionalAdIndex = ($currentPage - 1) % count($promotionalAds);

    // Get the promotional ad for the current page
    $promotionalAds = $promotionalAds[$promotionalAdIndex];

    return view('frontend.index', compact('products ', 'promotionalAds'));
}
?>

<!-- view file -->
@foreach($products as $key => $item)
    @if(($key + 1) % 7 == 0)
    <!-- promotional ads -->
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="promotional_ads">
            <a href="{{ $promotionalAds->link }}" target="_blank">
                <img src="{{ asset('frontend_assets/images/promotional_ads') }}/{{ $promotionalAds->image }}" alt="Ads">
            </a>
        </div>
    </div>
    @else
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        {{$item->name}}
    </div>




    @php
        $patientId = auth('patient')->id();
        $days = 30;
        $activePackages = BuyPackage::where('patient_id', $patientId)->whereDate('package_start_date', '>=', \Carbon\Carbon::now()->subDays($days))->where('status', 'Complete')->get();

    if ($activePackages->isNotEmpty()) {
            $invoiceIds = $activePackages->pluck('invoice_id')->toArray();
            $travellersCount =Traveller::where('patient_id', $patientId)
                ->whereIn('invoice_id', $invoiceIds)->count();
            $appointmentCount = Appointment::where('parent_id', $patientId)
                ->whereIn('invoice_id', $invoiceIds)->count();
        }
    @endphp