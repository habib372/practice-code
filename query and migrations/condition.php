<?php

if (in_array(auth()->user()->user_role_id, [1, 2, 3]) && !auth('doctor')->check()) {}


if (!auth('doctor')->check() && (in_array(auth()->user()->user_role_id, [1, 2, 3]))) {}


if(auth()->user()->user_role_id == 5){}

 if (!in_array(auth()->user()->user_role_id, [6,7])){}


if ($row->status == 'Requested' || $row->status == 'Scheduled') {}


$service_provider_id = (auth()->user()->user_role_id == 3) ? auth()->user()->service_provider_id : $request->service_provider_id;



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