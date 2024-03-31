<?php

public function store(Request $request)
{
    $this->validate($request, [
        'traveller_id' => 'required',
        'doctor_id' => 'required'
    ]);

    $patientId = auth('patient')->id();
    $buyPackage = BuyPackage::where('patient_id', $patientId)->latest()->first();
    $travellerInfo = Traveller::where('id', $request->traveller_id)->latest()->first();
    $service_provider_id = 1;
    $service_id = 1;

    DB::beginTransaction();

    try {
        $patientResponse = Http::post('https://tsrenp.tsrhealthservices.com.au/api/create-mr-patient', [
            'service_provider_id' => $service_provider_id,
            'name' => $travellerInfo->name,
            'email' => $travellerInfo->email,
            'mobile' => $travellerInfo->mobile,
            'username' => $travellerInfo->mobile,
            'password' => Hash::make('mr123456789'),
            'date_of_birth' => $travellerInfo->date_of_birth,
            'gender' => $travellerInfo->gender,
            'address' => $travellerInfo->address,
            'phone' => $travellerInfo->phone,
            'disease_id' => 42,
            'status' => 'active'
        ]);

        if ($patientResponse->successful()) {
            $patientId = $patientResponse->json()['id'];

            $appointmentResponse = Http::post('https://tsrenp.tsrhealthservices.com.au/api/create-mr-appointment', [
                'service_provider_id' => $service_provider_id,
                'patient_id' => $patientId,
                'doctor_id' => $request->doctor_id,
                'service_id' => $service_id,
                'visit_type' => 'Individual Doctor',
                'date' => now(),
                'appointment_start_time' => $request->appointment_date . ' ' . $request->start_time,
                'appointment_end_time' => $request->appointment_date . ' ' . $request->end_time,
                'remarks' => $request->remarks,
                'status' => 'Scheduled',
                'created_by' => $patientId
            ]);

            if ($appointmentResponse->successful()) {
                DB::commit();
                return back()->with('success', 'Appointment created successfully');
            } else {
                DB::rollBack();
                return back()->with('error', 'Error creating appointment');
            }
        } else {
            DB::rollBack();
            return back()->with('error', 'Error creating patient');
        }
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Internal server error: ' . $e->getMessage());
    }
}
