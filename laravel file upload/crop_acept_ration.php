

// single image upload function
    function singleImage($file, $title, $path) {
        $fileNameWithExtension = $file->getClientOriginalName();
        $modifiedFileNameWithoutExtension = Helper::bn_slug($title, '-') . '_' . time();
        $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);
        $modifiedFileNameWithExtension = $modifiedFileNameWithoutExtension . '.' . $fileExtension;
        $image = Image::make($file->getRealPath());
        $image->resize(null, 900, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->orientate();
        $pathWithFileName = $path . $modifiedFileNameWithExtension;
    
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    
        // Save the image without specifying the quality (default quality)
        $image->save($pathWithFileName);
    
        $featureImage = $modifiedFileNameWithExtension;
        return $featureImage;
    }
    
    

    // multi-image
    function multiImage($title, $files, $location, $id)
    {
        $i = 2;

        foreach ($files as $key => $other_image) {
            $file = $other_image;
            $fileNameWithExtension = $file->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $modifiedFileNameWithoutExtension = Helper::bn_slug($title, '-') . '_' .time() . $i;
            $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);
            $modifiedFileNameWithExtension = $modifiedFileNameWithoutExtension . '.' . $fileExtension;

            $img = Image::make($file->getRealPath());
            $img->resize(null, 900, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->orientate();

            $save_path = $location;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $img->save($save_path . '/' . $modifiedFileNameWithExtension);

            $pro_image = new PropertyImage;
            $pro_image->image = $modifiedFileNameWithExtension;
            $pro_image->property_id = $id;
            // $pro_image->image_number = $i;
            $pro_image->save();

            $i++;
        }

        return true;
    }