
<!-- update code -->
public function update(Update $request, ServiceProvider $serviceProvider)
{
    $data = $request->all();

    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $data['logo'] = time() . "_" . $logo->getClientOriginalName();
        $this->uploadImages($logo, 200);

        // Check if the old logo file exists before deleting it
        $oldLogoPath = public_path('/images/branch') . '/' . $serviceProvider->logo;
        if (file_exists($oldLogoPath)) {
            unlink($oldLogoPath);
        }
    } else {
        // If no new logo is uploaded, keep the existing logo path
        $data['logo'] = $serviceProvider->logo;
    }

    $data['updated_by'] = auth()->id();

    if ($serviceProvider->update($data)) {
        return redirect()->route('tsr-admin.branch.index')->with('success', 'Branch has been updated successfully');
    }

    return redirect()->back()->withInput();
}


<!-- upload function -->
public function uploadImages($image, $width)
{
    $originalName = $image->getClientOriginalName();

    $path = public_path() . '/images/branch';
    if (!is_dir($path)) {
        File::makeDirectory($path, 0755, true, true);
    }

    $image = Image::make($image);
    $image->resize(auto, 450, function ($constraint) {
        $constraint->aspectRatio();
    })->save($path . "/" . $originalName);
}
