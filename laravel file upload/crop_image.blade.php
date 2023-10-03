
    public function updateProfilePhoto(Request $request){
        // dd($request->all());
        $folderPath = public_path('images/patients/');
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        // dd($image_base64);
        $imageName = uniqid() . '.png';
        $imageFullPath = $folderPath.$imageName;

        file_put_contents($imageFullPath, $image_base64);
        $patient = Patient::findOrFail(auth('patient')->id());
        $patient->photo = $imageName;
        $patient->save();
        return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }
