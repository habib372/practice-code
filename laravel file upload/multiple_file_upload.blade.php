<div class="col-lg-6 col-md-6 col-sm-12">
	<label>Add More Product Photo </label>
	<div class="custom-file">
		<input type="file" class="form-control" name="images[]" multiple>
	</div>
</div>


<?php


// Edit image
public function update(Request $request, $id)
{
    $existData = FeaturedServiceProvider::find($id);
    $data = $request->all();

    // Handle logo update
    if ($request->hasFile('logo')) {
        $data['logo'] = time() . "_" . $request->file('logo')->getClientOriginalName();
        $this->uploadImages($request->file('logo'));

        // Delete old logo if it exists
        if (is_file(public_path('/images/featured_serviceprovider/' . $existData->logo))) {
            unlink(public_path('/images/featured_serviceprovider/' . $existData->logo));
        }
    } else {
        $data['logo'] = $existData->logo;
    }

    // Handle featured image update
    if ($request->hasFile('featured_image')) {
        $data['featured_image'] = time() . "_" . $request->file('featured_image')->getClientOriginalName();
        $this->uploadImages($request->file('featured_image'));

        // Delete old featured image if it exists
        if (is_file(public_path('/images/featured_serviceprovider/' . $existData->featured_image))) {
            unlink(public_path('/images/featured_serviceprovider/' . $existData->featured_image));
        }
    } else {
        $data['featured_image'] = $existData->featured_image;
    }

    $data['updated_by'] = auth()->id();

    if ($existData->update($data)) {
        return redirect()->route('tsr-admin.featured-service-providers.index')->with('success', 'Featured Service Provider has been updated successfully');
    }

    return redirect()->back()->withInput();
}


// 1 ==> image upload function with resize
public function uploadImages($image, $width)
    {
        $originalName = $image->getClientOriginalName();

        $path = public_path() . '/images/folder_name';
        if (!is_dir($path)) {
            File::makeDirectory($path);
        }

        $image = Image::make($image);
        $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path . '/' . time() . '_' . $originalName);

        $image->widen(100)->save($path . "/thumb_" . $originalName);  //for another resize copy

    }



 // 2 ==> image upload function without resize
 public function uploadImages($image)
    {
        $originalName = $image->getClientOriginalName();

        $path = public_path() . '/images/folder_name';
        if (!is_dir($path)) {
            File::makeDirectory($path);
        }

        $image->move($path, time() . '_' . $originalName);
        return $photo_name;

    }


// 3 ==> image upload function without resize and delete old img
public function uploadImages($image)
{
    $originalName = $image->getClientOriginalName();
    $path = public_path() . '/images/folder_name';

    if (is_file($path . '/' . $originalName)) {
        unlink($path . '/' . $originalName);
    }

    if (!is_dir($path)) {
        File::makeDirectory($path);
    }

    // Move the new image
    $image->move($path, time() . '_' . $originalName);
}


// with resize
public function uploadImages($image){
        $originalName = $image->getClientOriginalName();
        $photo_name = strtotime("now").'_'.$originalName;

        $image = Image::make($image);
        $image->resize(200, 200)->save(public_path() . "/images/patients/".$photo_name);
        return $photo_name;
    }