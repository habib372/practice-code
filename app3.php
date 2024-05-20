 public function print($patientVisitId, Request $request){

        // dd($request->all());
        $print_type = $request->type;
        // echo $print_type;exit;
        $examinationType = ExaminationType::find($request->examinationType);

        $allTypes = ExaminationType::where(function ($q) use ($request) {
            $q->where('parent_id', $request->examinationType)->orWhere('id', $request->examinationType);
        })->pluck('id')->toArray();

        $visit = PatientVisit::with(['patient.disease', 'referral', 'doctor', 'serviceProvider'
        , 'medicines' => function($query){
            $query->join('medicines', 'medicines.id', '=', 'patient_visit_medicines.medicine_id')
            ->select('patient_visit_medicines.*', 'medicines.name as medicine_name');
        }, 'examinations' => function($query) use ($allTypes){
                $query->whereIn('examinations.examination_type_id', $allTypes)
                ->join('examinations', 'examinations.id', '=', 'patient_visit_examinations.examination_id')
                ->select('patient_visit_examinations.*', 'examinations.name as examination_name');
        }])->findOrFail($patientVisitId);

        $referral_doctor = PatientVisitReferral::where('patient_visit_id', $visit->id)->first();

        $sealInfo = DoctorServiceProvider::where('doctor_id', $visit->doctor_id)->where('service_provider_id', $visit->service_provider_id)
            ->first();

        if ($print_type == 'prescriptionPdf') {

            $pdf = PDF::loadView('admin.patient-visit.prescription_generate_pdf', ['visit' => $visit, 'examinationType' => $examinationType, 'sealInfo' => $sealInfo] );

            return $pdf->download();

        }


    }