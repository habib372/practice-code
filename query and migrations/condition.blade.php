

if (in_array(auth()->user()->user_role_id, [1, 2, 3]) && !auth('doctor')->check()) {}

if (!auth('doctor')->check() && (in_array(auth()->user()->user_role_id, [1, 2, 3]))) {}

if(auth()->user()->user_role_id == 5){}

 if (! in_array(auth()->user()->user_role_id, [6, 7])) {}

if (in_array(auth()->user()->user_role_id, [6,7])){}

if ($row->status == 'Requested' || $row->status == 'Scheduled') {}


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


@section('page_title')
    Primary Care Centre - PCC | All Appointment List
@stop


{{ url()->previous() }}

?>

<div class="form-group m-form__group row" id="show_service_provider" <?= (in_array(old('user_role_id'), [2,3,6,7]) ? 'style="display:block;"' : 'style="display:none;"'); ?>>

<div class="form-group m-form__group row" id="show_service_provider" @if(old('user_role_id')) style="display:block;" @else style="display:none;"; @endif>


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