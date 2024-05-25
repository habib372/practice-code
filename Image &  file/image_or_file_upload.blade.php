<?php

use File;
use Intervention\Image\Facades\Image;


//-- create-- function 1
$filename = null;
if ($request->hasFile('logo')) {
    $this->uploadImages($request->file('logo'), 200);
}

//updated
$filename = $data->logo;
 if ($request->logo) {
    $this->deleteImages($data->logo);
    $this->uploadImages($request->file('logo'), 200);
}

//-- function 1-->
public function uploadImages($image, $width)
{
    $fileName = time() . "_" . str_replace(' ', '-', $request->file('logo')->getClientOriginalName());
    $path = public_path() . '/images/logo';

    if (!is_dir($path)) {
        File::makeDirectory($path);
    }

    $image = Image::make($image);
    $image->resize($width, null, function ($constraint) {
        $constraint->aspectRatio();
    })->save($path . '/' . $fileName);

    return $fileName;

    // $image->widen(100)->save($path . "/thumb_".$originalName);
}

// Delete image
 public function deleteImages($image){

    if(file_exists(public_path() . "/images/logo" . $image)){
        unlink(public_path() . "/images/logo" . $image);
    }

}




//-- function 2-->
if ($request->hasFile('logo')) {
    $this->uploadImages($request->file('logo'));
}

//-- function 2-->
public function uploadImages($image)
{
    $fileName = strtotime("now"). "_" . str_replace(' ', '-', $request->file('logo')->getClientOriginalName());
    $path = public_path() . '/images/branch';

    if (!is_dir($path)) {
        File::makeDirectory($path);
    }

    $image = Image::make($image);
    $image->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path . '/' . $fileName);

    return $fileName;
}

// Delete image
 public function deleteImages($image){

    if(file_exists(public_path() . "/images/partner/" .$partnerId. "_large_". $image)){
        unlink(public_path() . "/images/partner/" . $partnerId ."_large_" . $image);
    }

}