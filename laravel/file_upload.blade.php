 function singleImage($file, $title, $locations){

        $fileNameWithExtension = $file->getClientOriginalName();
        $ModifiedFileNameWithoutExtension = Helper::bn_slug($title, '_').'_'.md5(microtime());
        $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);
        $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.'.$fileExtension;
        $image = Image::make($file->getRealPath());

        $image->resize(650, 450);
        $image->orientate();

        $pathWithFileName = $locations.$ModifiedFileNameWithExtension;

        if (!file_exists($locations)) {
            mkdir($locations, 0777, true);
        }

        $image->save($pathWithFileName, 50);

        $featureImage = $ModifiedFileNameWithExtension;
        return $featureImage;
    }


    function multiImage($title, $files, $location, $id)
    {
        $i = 2;
        foreach ($files as $key => $other_image) {
            $file = $other_image;
            $fileNameWithExtension = $file->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = Helper::bn_slug($title, '_').'_'.md5(microtime()). $i++;
            $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);
            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.'.$fileExtension;
            $img = Image::make($file->getRealPath());
            // $img->resize(650, 500);
            $save_path = $location;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $img->save($save_path.'_'.$ModifiedFileNameWithExtension);
            $pro_image = new PropertyImage;
            $pro_image->image = $ModifiedFileNameWithExtension;
            $pro_image->property_id = $id;
            // $pro_image->image_number = $i;
            $pro_image->save();
            $i++;
        }
        unset($i);
        unset($key);
        return true;
    }