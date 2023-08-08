<?php

if (in_array(auth()->user()->user_role_id, [1, 2, 3]) && !auth('doctor')->check()) {}


if (!auth('doctor')->check() && (in_array(auth()->user()->user_role_id, [1, 2, 3]))) {}


if(auth()->user()->user_role_id == 5){}


if ($row->status == 'Requested' || $row->status == 'Scheduled') {}


$service_provider_id = (auth()->user()->user_role_id == 3) ? auth()->user()->service_provider_id : $request->service_provider_id;



<?= (in_array(old('user_role_id'), [2,3]) ? 'style="display:block;"' : 'style="display:none;"'); ?>


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


?>