Route::group(['prefix' => 'doctor', 'as' => 'doctor.'], function () {
Route::group(['middleware' => ['doctor']], function () {
    Route::resource('/patients', 'Admin\PatientController');

});
});


public function index()
    {
            if (auth('doctor')->check()) {

                $doctorId = auth('doctor')->id();
                $coordinatorIds = DoctorServiceProvider::where('doctor_id', $doctorId)->where('is_coordinator', 'yes')->pluck('service_provider_id')->toArray();

                $patients = Patient::with(['serviceProvider', 'district', 'country','disease', 'stage'])->where(function ($query) use ($doctorId, $coordinatorIds) {
                    $query->WhereHas('appointments', function ($query) use ($doctorId) {
                        $query->where('doctor_id', $doctorId);
                    })->orWhereHas('chemotherapies', function ($query) use ($doctorId) {
                        $query->where('doctor_id', $doctorId);
                    });
                    if (!empty($coordinatorIds)) {
                        $query->orWhereIn('service_provider_id', $coordinatorIds);
                    }
                });

            } elseif (in_array(auth()->user()->userRole->name, ['service-provider', 'receptionist', 'co-ordinator'])) {
                $patients = Patient::with(['serviceProvider', 'district', 'country','disease', 'stage'])->where(function ($query) {
                    return $query->where('service_provider_id', auth()->user()->service_provider_id)
                        ->orWhereHas('appointments', function ($sql) {
                            return $sql->where('service_provider_id', auth()->user()->service_provider_id);
                        });
                })->select('patients.*')->get();
            }
            elseif (in_array(auth()->user()->userRole->name, ['super-consultant', 'super-co-ordinator'])) {

                $patients = Patient::with(['serviceProvider', 'district', 'country','disease', 'stage'])
                    ->join('service_providers as sp', 'patients.service_provider_id', '=', 'sp.id')
                    ->join('service_provider_types as spt', 'sp.service_provider_type_id', '=', 'spt.id')
                    ->where(function ($query) {
                        return $query->where('spt.id', auth()->user()->service_provider_type_id)
                            ->orWhereHas('appointments', function ($sql) {
                                return $sql->where('spt.id', auth()->user()->service_provider_type_id);
                            });
                    })->select('patients.*')->get();

            }
            else {
                $patients = Patient::with(['serviceProvider', 'district', 'country', 'disease', 'stage'])->where('status', 0)->orderBy('id', 'desc')->get();
            }

        return view('admin.patient.index', compact('patients'));
    }
