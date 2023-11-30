<?php
// rulse -1
$data = $request->validate([
    'title' => 'required|max:255',
    'tag' => 'nullable|max:1000',
    'code' => 'required|max:255',
    'total_qty' => 'required|integer|max:100000',
    "stock" => "nullable|array|min:1",
    "stock.size.*" => "required_with:stock|distinct",
    "stock.qty.*" => "required_with:stock",
    'brand_id' => 'nullable|integer|max:2000',
    'price' => 'required|numeric|max:1000000',
    'discount_type' => 'required|boolean',
    'discount_amount' => 'required|numeric|max:1000000',
    'display' => 'required',
    'excerpt' => 'nullable|max:2000',
    'deliverydays' => 'nullable|max:255',
    'description' => 'nullable|max:10000',
    'category_id' => 'required|integer|max:10000',
    'order' => 'nullable|string|max:500',
    'slug' => 'nullable|alpha_dash',
    'size_chart' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1920|max:1024',
    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=285,min_height=380|max:1024',
    'other_images' => 'required',
    'other_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1920|max:1024',
]);

// rulse -2


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
    'doctor_mobile' => '',
    'doctor_email' => '',
    'doctor_address' => '',
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
    'patient_treatment_type.required' => 'Treatment type field is required!',
    'treatment_date.required' => 'Patient treatment date field is required!',
    'treatment_details.required' => 'Treatment details field is required!',
    'fund_request_reason.required' => 'This field is required!',
    'treating_service_provider.required' => 'This field is required!',
    'service_provider_address.required' => 'This field is required!',
    'doctor_name.required' => 'Doctor name field is required!',
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

// or

$validator = Validator::make($request->all(), $rules, $messages);

if ($validator->fails()) {

    return redirect()->back()->withErrors($validator);
}