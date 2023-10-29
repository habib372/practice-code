public function store(Request $request)
    {
// dd($request);
        $rules = [
            'patient_name' => 'required',
            'patient_password' => 'required',
            'patient_mobile' => 'required|unique:patients,mobile',
            'patient_username' => 'required|unique:patients,username',
            'patient_disease_id' => 'required',
            'patient_type' => 'required'
        ];

        $messages = [
            'patient_disease_id.required' => 'Disease must be selected!',
            'patient_type.required' => 'Patient type must be selected!'
        ];


        $rowNo = 1;

        foreach ($request->attachs as $key => $attach) {
            if(!empty($attach['title']) || ($request->hasfile('attachs.'.$key))) {

                $rules['attachs.'.$key.'.title'] = 'required';
                $rules['attachs.'.$key.'.file'] = 'required|mimes:doc,pdf,docx,jpeg,jpg,png|max:10240';
                $messages['attachs.'.$key.'.title.required'] = 'Attachmet title required in row no '.$rowNo;
                $messages['attachs.'.$key.'.file.required'] = 'Attachmet file required in row no '.$rowNo;
                $messages['attachs.'.$key.'.file.mimes'] = 'Attachmet file type must be {mimes} in row no '.

                $rowNo;
            }

            $rowNo++;
        }

        // Form validation
        $this->validate($request, $rules, $messages);

        $photo_name = '';
        if($request->hasFile('photo')){
           $photo_name = $this->uploadImages($request->file('photo'));
        }

        DB::transaction(function () use ($request, $photo_name) {

            // dd($request);
            $patient = Patient::create([
                'service_provider_id' => (auth()->user()->userRole->name == 'admin') ? $request->patient_service_provider_id : auth()->user()->service_provider_id,
                'name' => $request->patient_name,
                'email' => $request->patient_email,
                'mobile' => $request->patient_mobile,
                'username' => $request->patient_username,
                'phone' => $request->patient_phone,
                'patient_type' => $request->patient_type,
                'disease_type_id' => $request->patient_disease_type_id,
                'disease_id' => $request->patient_disease_id ? implode(',', $request->patient_disease_id) : '',
                'staged_id' => $request->patient_stage_id,
                'address' => $request->patient_address,
                'district_id' => $request->patient_district_id,
                'country_id' => $request->patient_country_id,
                'profession' => $request->patient_profession,
                'date_of_birth' => $request->patient_date_of_birth,
                'marriage_anniversary' => $request->patient_marriage_anniversary,
                'allergies' => $request->patient_allergies,
                'password' => Hash::make($request->patient_password),
                'referral_source' => $request->patient_referral_source,
                'referral_doctor_id' => $request->patient_referral_doctor_id,
                'gender' => $request->patient_gender,
                'religion' => $request->patient_religion,
                'marital_status' => $request->patient_marital_status,
                'spouse_name' => $request->patient_spouse_name,
                'status' => 'active',
                'photo' => empty($photo_name) ? null : $photo_name
            ]);


                if(!empty($request->file('attachs'))) {

                    $path = public_path().'/uploads/visit-attachments';

                    foreach($request->file('attachs') as $key => $file){

                        if(!empty($file)){
                            $originalName = $file['file']->getClientOriginalName();

                            $fileName = time().rand(0, 1000).'.'.$file['file']->getClientOriginalExtension();

                            if ($file['file']->move($path, $fileName)) {
                                // save file name in the database
                                VisitAttachment::create([
                                    'patient_visit_id' => $visit->id,
                                    'title' => $request['attachs'][$key]['title'],
                                    'file_name' => $fileName,
                                    'file_original_name' => $originalName
                                ]);
                            }
                        }
                    }
                }

        });

        return redirect()->route('patient.apply_sponsorship')->with('success', 'Sponsorship Application submitted successfully!');

    }