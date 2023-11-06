 <?php

 public function sponsorshipDataSave(Request $request)
    {
        // dd($request);
        $rules = [
            'patient_name' => 'required',
            'patient_mobile' => 'required|unique:patients,mobile',
            'patient_email' => 'email|unique:patients,email',
            'patient_address' => 'required',
            'patient_country_id' => 'required',
            'patient_district_id' => 'required',
            'patient_disease_id' => 'required',
            'patient_stage_id' => 'required',
            'patient_treatment_type' => 'required',
            'treatment_date' => 'required',
            'treatment_details' => 'required',
            'fund_request_reason' => 'required',
            'treating_service_provider' => 'required',
            'service_provider_address' => 'required',
            'doctor_name' => 'required',
            'doctor_mobile' => 'required',
            'doctor_email' => 'required',
            'doctor_address' => 'required',
            'total_treatment_cost' => 'required|numeric',
            'your_contribution' => 'required|numeric',
            'donation_request_amount' => 'required|numeric',
            'account_holder_name' => 'required',
            'account_number' => 'required|numeric',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'doctor_recommend_letter' => 'required|mimes:pdf,jpeg,jpg,png|max:10240',
        ];

        $messages = [
            'patient_name.required' => 'Patient name field is required!',
            'patient_mobile.required' => 'Patient mobile field is required!',
            'patient_email.required' => 'Patient email field is required!',
            'patient_address.required' => 'Patient address field is required!',
            'patient_country_id.required' => 'Country must be selected!',
            'patient_district_id.required' => 'District must be selected!',
            'patient_disease_id.required' => 'Disease must be selected!',
            'patient_stage_id.required' => 'Stage must be selected!',
            'patient_treatment_type.required' => 'Treatment type must be selected!',
            'treatment_date.required' => 'Patient treatment date field is required!',
            'treatment_details.required' => 'Treatment details field is required!',
            'fund_request_reason.required' => 'This field is required!',
            'treating_service_provider.required' => 'This field is required!',
            'service_provider_address.required' => 'This field is required!',
            'doctor_name.required' => 'Doctor name field is required!',
            'doctor_mobile' => 'Doctor mobile field is required!',
            'doctor_email' => 'Doctor email field is required!',
            'doctor_address' => 'Doctor address field is required!',
            'total_treatment_cost' => 'This field is required!',
            'your_contribution' => 'This field is required!',
            'donation_request_amount' => 'This field is required!',
            'account_holder_name' => 'This field is required!',
            'account_number' => 'This field is required!',
            'bank_name' => 'This field is required!',
            'branch_name' => 'This field is required!',
            'doctor_recommend_letter' => 'This field is required!',
        ];


        $rowNo = 1;

        foreach ($request->attachs as $key => $attach) {
            if (!empty($attach['title']) || ($request->hasfile('attachs.' . $key))) {

                $rules['attachs.' . $key . '.title'] = 'required';
                $rules['attachs.' . $key . '.file'] = 'required|mimes:doc,pdf,docx,jpeg,jpg,png|max:10240';
                $messages['attachs.' . $key . '.title.required'] = 'Attachmet title required in row no ' . $rowNo;
                $messages['attachs.' . $key . '.file.required'] = 'Attachmet file required in row no ' . $rowNo;
                $messages['attachs.' . $key . '.file.mimes'] = 'Attachmet file type must be {mimes} in row no ' .

                $rowNo;
            }

            $rowNo++;
        }

        // Form validation
        $this->validate($request, $rules, $messages);

        $photo_name = '';
        if ($request->hasFile('doctor_recommend_letter')) {
            $photo_name = $this->uploadFile($request->file('doctor_recommend_letter'));
        }

        DB::transaction(function () use ($request, $photo_name) {

            // dd($request);
            $patient = Sponsorship::create([
                'patient_id' => auth('patient')->id(),
                'patient_name' => $request->patient_name,
                'patient_mobile' => $request->patient_mobile,
                'patient_email' => $request->patient_email,
                'patient_address' => $request->patient_address,
                'patient_phone' => $request->patient_phone,
                'patient_country_id' => $request->patient_country_id,
                'patient_district_id' => $request->patient_district_id,
                'patient_disease_id' => $request->patient_disease_id ? implode(',', $request->patient_disease_id) : '',
                'patient_stage_id' => $request->patient_stage_id,

                'patient_treatment_type' => $request->patient_treatment_type,
                'treatment_date' => $request->treatment_date,
                'treatment_details' => $request->treatment_details,
                'fund_request_reason' => $request->fund_request_reason,
                'treating_service_provider' => $request->treating_service_provider,
                'service_provider_address' => $request->service_provider_address,

                'doctor_name' => $request->doctor_name,
                'doctor_mobile' => $request->doctor_mobile,
                'doctor_email' => $request->doctor_email,
                'doctor_address' => $request->doctor_address,

                'total_treatment_cost' => $request->total_treatment_cost,
                'your_contribution' => $request->your_contribution,
                'donation_request_amount' => $request->donation_request_amount,

                'account_holder_name' => $request->account_holder_name,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'branch_name' => $request->branch_name,

                'doctor_recommend_letter' => empty($photo_name) ? null : $photo_name
            ]);


            if (!empty($request->file('attachs'))) {

                $path = public_path() . '/uploads/sponsorship-attachments';

                foreach ($request->file('attachs') as $key => $file) {

                    if (!empty($file)) {
                        // $originalName = $file['file']->getClientOriginalName();

                        $fileName = time() . rand(0, 1000) . '.' . $file['file']->getClientOriginalName();

                        if ($file['file']->move($path, $fileName)) {
                            // save file name in the database
                            SponsorshipAttachment::create([
                                'sponsorship_id' => $patient->id,
                                'file_title' => $request['attachs'][$key]['title'],
                                'file_original_name' => $fileName,
                                // 'file_original_name' => $originalName
                            ]);
                        }
                    }
                }
            }

            if ($patient->id) {
                SponsorshipVerify::create([
                    'sponsorship_id' => $patient->id,
                ]);
            }

        });

        return redirect()->route('patient.apply_sponsorship')->with('success', 'Sponsorship Application submitted successfully!');
    }
