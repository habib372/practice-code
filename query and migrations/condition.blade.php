

if (in_array(auth()->user()->user_role_id, [1, 2, 3]) && !auth('doctor')->check()) {}

if (!auth('doctor')->check() && (in_array(auth()->user()->user_role_id, [1, 2, 3]))) {}

if(auth()->user()->user_role_id == 5){}

if (!auth('doctor')->check() && auth()->user()->user_role_id != 5){}

 if (! in_array(auth()->user()->user_role_id, [6, 7])) {}

if (in_array(auth()->user()->user_role_id, [6,7])){}

if ($row->status == 'Requested' || $row->status == 'Scheduled') {}


{{ (request()->is('page*')) ? 'active' : '' }}
{{(request()->is('buying-house') ? 'Buying House' : 'Factory')}}
{{ Request::is('tsr-admin/discount-partner*')? 'm-menu__item--open' : '' }}
{{ Request::is('patient/')? 'active' : '' }}



<!-- date time format -->
<!-- Updated by: Habibur Rahman  -->
 <strong>Last Updated By</strong> : {{ $user->updatedBy->name??'' }}<br/>

 <strong>Last updated on</strong> : {{ date("h:i A \o\\n d F Y", strtotime($user->updated_at)) }}
<!-- Last Updated On: 06:20 PM on 11 September 2023  -->


$service_provider_id = (auth()->user()->user_role_id == 3) ? auth()->user()->service_provider_id : $request->service_provider_id;

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


 {{-- random order --}}
$articles = Content::select(['id','title_'.config('app.locale').' as title', 'description_'.config('app.locale').' as description', 'slug', 'images', 'content_category_id', 'created_at'])
            ->where('content_category_id', 17)->where('featured','yes')->where('status','active')
            ->inRandomOrder()
            ->take(2)
            ->get();


@section('page_title')
    Primary Care Centre - PCC | All Appointment List
@stop


{{ url()->previous() }}

?>

<div class="form-group m-form__group row" id="show_service_provider" <?= (in_array(old('user_role_id'), [2,3,6,7]) ? 'style="display:block;"' : 'style="display:none;"'); ?>>

<div class="form-group m-form__group row" id="show_service_provider" @if(old('user_role_id')) style="display:block;" @else style="display:none;"; @endif>


    @if(auth('patient')->check() && in_array(request()->url(), [
        URL::to('patient/dashboard'), URL::to('patient/apply-for-sponsorship'), URL::to('patient/medical-history'), URL::to('patient/appointments'), URL::to('patient/chemotherapy-history'), URL::to('patient/attachments'), URL::to('patient/carers') ]))

        @include('frontend.partials.carer-dashboard-menu')
     @else
        @include('frontend.partials.mainmenu')
    @endif

{{-- or --}}
    @if(auth('patient')->check() && (request()->url() == URL::to('patient/dashboard') || (request()->url() == URL::to('patient/apply-for-sponsorship')) || (request()->url() == URL::to('patient/medical-history')) || (request()->url() == URL::to('patient/appointments')) || (request()->url() == URL::to('patient/chemotherapy-history')) || (request()->url() == URL::to('patient/atachments')) || (request()->url() == URL::to('patient/carers')) ))


    {!! Str::limit($item->description, 600, '.. <br/><a class="learn_more" href="/service-provider/'.$item->featuredServiceProviderType->slug.'/'.$item->slug.'">'.trans("text.learn_more").' <i class="fa fa-angle-double-right"></i></a>') !!}

    {!! Str::limit($item->description, 600) !!}
    <a class="learn_more" href="/service-provider/{{ $item->featuredServiceProviderType->slug }}/{{ $item->slug }}">{{ trans("text.learn_more") }} <i class="fa fa-angle-double-right"></i></a>


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
        $patient_bp_rbs = PatientVisit::select('visit_date', 'bp', 'rbs')->where('patient_id', $id)->groupBy('patient_id')->get();

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
            <div class="treatment_item-head" role="button" data-toggle="modal" data-target="#visitDetailsModal_{{ $visit->id }}" aria-expanded="false">
                <span class="treatment_item-icon">
                    <i class="fa fa-stethoscope"></i>
                </span>
                <h6 class="treatment_item-title">
                    <span>Doctor's Consultation</span> on <span>{{ date('d-M-Y', strtotime($visit->visit_date)) }}</span>
                </h6>
            </div>
        </div>
        @endif
        @empty
        No Medical History Found
        @endforelse
</div>