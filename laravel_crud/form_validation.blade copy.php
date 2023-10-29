
<?php

public function doPatientRegistration(Request $request){


    // Form validation
        $rules = [
            'patient_name' => 'required',
            'patient_email' => 'email|unique:patients,email',
            'patient_password' => 'required',
            'patient_mobile' => 'required',
            'patient_username' => 'required|unique:patients,username',
            'patient_disease_id' => 'required'
        ];

        if ($request->hasFile('photo')) {
            $rules['photo'] = 'image';
        }

        $messages = [
            'patient_disease_id.required' => 'Disease must be selected!'
        ];

        $this->validate($request, $rules, $messages);

        $photo_name = '';
        if ($request->hasFile('photo')) {
            $photo_name = $this->uploadImages($request->file('photo'));
        }

        $patient = Patient::create([
            'name' => $request->patient_name,
            'email' => $request->patient_email,
            'mobile' => $request->patient_mobile,
            'username' => $request->patient_username,
            'phone' => $request->patient_phone,
            'disease_id' => $request->patient_disease_id,
            'staged_id' => $request->patient_stage_id,
            'address' => $request->patient_address,
            'district_id' => $request->patient_district_id,
            'country_id' => $request->patient_country_id,
            'date_of_birth' => $request->patient_date_of_birth,
            'password' => Hash::make($request->patient_password),
            'registration_date' => now(),
            'profession' => 'patient_profession',
            'status' => 'pending',
            'photo' => $photo_name

        ]);

        if($patient){
            return redirect()->route('home')->with('success', 'You have been registered successfully!');
        }

        return redirect()->back()->withInput();
    }