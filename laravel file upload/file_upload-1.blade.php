

<!-- create -->
public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name_en' => 'required',
        //     'logo' => 'mimes:jpg,jpeg,png,gif|required'
        // ]);

        $newFilename = '';
        if ($request->hasFile('logo')) {
            $path = public_path('/images/serviceprovidertype');

            // Create the directory if it doesn't exist
            if (!is_dir($path)) {
                File::makeDirectory($path, 0755, true);
            }

            $uploadedLogo = $request->file('logo');
            $newFilename = time().'_'.$uploadedLogo->getClientOriginalName();

            // Move the uploaded logo to the specified path
            $uploadedLogo->move($path, $newFilename);

            // Resize the image to a width of 200px (assuming you are using the Intervention Image library)
            $image = Image::make($path . '/' . $newFilename);
            $image->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save($path . '/' . $newFilename);
        } else {
            $newFilename = 'default_logo.png';
        }

            $createData =ServiceProviderType::create([
                'name_en' => $request->name_en,
                'name_bn' => $request->name_bn,
                'description_en' => $request->description_en,
                'description_bn' => $request->description_bn,
                'featured' => $request->featured,
                'order' => $request->order,
                'status' => $request->status,
                'icon' => $request->icon,
                'logo' => $newFilename,
                'created_by' => auth()->id()
            ]);

            // You can update the data directly without checking for $filename
            if ($createData) {
                return redirect()->route('tsr-admin.branch-type.index')->with('success', 'Service Provider Type has been Create successfully');
            } else {
                return redirect()->back()->withInput();
            }

    }

<!-- updated -->
public function update(Request $request, $id)
    {
        $data = ServiceProviderType::find($id);

        if (!$data) {
            return redirect()->route('tsr-admin.branch-type.index')->with('error', 'Service Provider Type not found');
        }

        $filename = $data->logo;
        if ($request->hasFile('logo')) {
            $path = public_path('/images/serviceprovidertype');
            if (!is_dir($path)) {
                File::makeDirectory($path, 0755, true); // Create the directory recursively with proper permissions
            }

            $uploadedLogo = $request->file('logo');
            $newFilename = time() . '_' . $uploadedLogo->getClientOriginalName();

            // Move the uploaded logo and delete the old one
            $uploadedLogo->move($path, $newFilename);
            @unlink($path . '/' . $data->logo);

            // Resize the image to a width of 200px
            $image = Image::make($path . '/' . $newFilename);
            $image->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save($path . '/' . $newFilename);

            // Update the filename in the database
            $filename = $newFilename;
        }

        $updateData = [
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'description_en' => $request->description_en,
            'description_bn' => $request->description_bn,
            'featured' => $request->featured,
            'order' => $request->order,
            'status' => $request->status,
            'icon' => $request->icon,
            'logo' => $filename, // Update the logo filename
            'created_by' => auth()->id()
        ];

        // You can update the data directly without checking for $filename
        if ($data->update($updateData)) {
            return redirect()->route('tsr-admin.branch-type.index')->with('success', 'Service Provider Type has been updated successfully');
        } else {
            return redirect()->route('tsr-admin.branch-type.index')->with('error', 'Failed to update Service Provider Type');
        }
    }
