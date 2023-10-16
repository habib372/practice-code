
 {{-- controller update  --}}
 public function updateProfile(Request $request)
{
    $photo_name = '';
        if($request->hasFile('photo')){
           $photo_name = $this->uploadImages($request->file('photo'));
        }

    $patient = Patient::findOrFail(auth('patient')->id());
        $patient->name = $request->patient_name;
        $patient->mobile = $request->patient_mobile;
        $patient->email = $request->patient_email;
        if (!empty($photo_name)) {
            if ($patient->photo) {
                $oldPhotoPath = public_path('/images/patients/') . $patient->photo;
                if (file_exists($oldPhotoPath)) {
                    @unlink($oldPhotoPath);
                }
            }
            $patient->photo = $photo_name;
        }

     if($patient->save()){
            return response()->json(['response' => 'My Profile Updated Successfully'], 200);
        }else{
            return response()->json(['response' => 'My Profile could not be updated'], 200);
        }
}


    <!--File upload function -->
    public function uploadImages($image)
    {
        $originalName = $image->getClientOriginalName();
        $photo_name = strtotime("now").'_'.$originalName;

        $image = Image::make($image);
        $image->resize(200, 200)->save(public_path() . "/images/patients/".$photo_name);
        return $photo_name;
    }

    <!--File upload function -->
    public function uploadImages($image)
    {
        $originalName = $image->getClientOriginalName();
        $filename = strtotime("now") . '_' . $originalName;

        $image = Image::make($image);
        $image->save(public_path() . "/images/membership/" . $filename);
        return $filename;
    }
