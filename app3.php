 public function store(Store $request)
    {
        // dd($request->all());

        $filename = null;
        if ($request->hasFile('logo')) {
            $path = public_path() . '/images/serviceprovidertype';
            if (!is_dir($path)) {
                File::makeDirectory($path);
            }
            $filename = time() . '.' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move($path, $filename);
        }

         $branch_type = ServiceProviderType::create([
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'description_en' => $request->description_en,
            'description_bn' => $request->description_bn,
            'featured' => $request->featured,
            'order' => $request->order,
            'status' => $request->status,
            'icon' => $request->icon,
            'logo' => $request->$filename,
            'created_by' =>  auth()->id()
         ]);

         if($branch_type){
            return redirect()->route('tsr-admin.branch-type.index')->with('success', 'Branch Type has been Crated successfully');
         }else{
            return redirect()->back()->withInput()->with('errors','Somthing is missing');
         }
    }

    $filename = null;
    if ($request->hasFile('doctor_image')) {
        $path = public_path() . '/images/specialist';
        if (!is_dir($path)) {
            File::makeDirectory($path);
        }

        $uploadedImage = $request->file('doctor_image');
        $filename = time() . '.' . $uploadedImage->getClientOriginalName();
        $uploadedImage->move($path, $filename);

        // Resize the image to a width of 200px
        $image = Image::make($path . '/' . $filename);
        $image->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save($path . '/' . $filename);
    }