
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




   <!-- Upload image -->
    public function uploadImages($image)
    {
        $fileName = time() . rand(0, 1000) . "_" . str_replace(' ', '-', $image->getClientOriginalName());
        $path = public_path('images/contents');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $imageInstance = Image::make($image);
        $imageInstance->resize(500, null, function ($constraint) {   <!-- resize -->
            $constraint->aspectRatio();
        })->save($path . '/' . $fileName);

        return $fileName;
    }


    <!-- Delete image -->
    public function deleteImages($image)
    {
        $imagePath = public_path('images/contents/' . $image);
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }
    }

    <!-- image upload create-->
    if ($request->hasFile('image_en')) {
        $filename_en = $this->uploadImages($request->file('image_en'));
    } else {
        $filename_en = null;
    }


    <!-- image upload updated-->
    if ($request->hasFile('image_en')) {
        $this->deleteImages($content->image_en);
        $filename_en = $this->uploadImages($request->file('image_en'));
    } else {
        $filename_en = $content->image_en;
    }








    @if ($advertise !==null)
        @if (file_exists(public_path('/images/advertise/'). $advertise->ad_image))
            <a href="{{ $advertise->ad_link }}">
            <img src="{{'images/advertise/'. $advertise->ad_image }}" class="img-fluid rounded" alt="{{ $advertise->ad_provider_name }}">
        </a>
        @else
            <img src="/advertise/default-patient-ad.png" class="img-fluid rounded" alt="Fighting Cancer Bangladesh">
        @endif
    @else
        <a href="#">
            <img src="/advertise/default-patient-ad.png" class="img-fluid rounded" alt="Fighting Cancer Bangladesh">
        </a>
    @endif