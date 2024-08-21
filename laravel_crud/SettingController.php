<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = Setting::all();
        return view('admin.settings.index', compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Setting::findOrFail($id);
        return view('admin.settings.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Setting::findOrFail($id);
        return view('admin.settings.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $oldData = Setting::findOrFail($id);
        $this->validate($request, [
            'header_mobile' => 'required',
            'header_email' => 'required',
            'about_us_en' => 'required',
            'about_us_bn' => 'required',
            'newsletter_en' => 'required',
            'news_letter_bn' => 'required',
            'description_en' => 'required',
            'description_bn' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',
            'twitter' => 'required',
            'tinymce_api' => 'required',
        ]);

        // website logo
        if ($request->hasFile('web_logo')) {
            $this->deleteImages($oldData->web_logo);
            $filename_logo = $this->uploadImages($request->file('web_logo'));
        } else {
            $filename_logo = $oldData->web_logo;
        }

        // website favicon
        if ($request->hasFile('web_favicon')) {
            $this->deleteImages($oldData->web_favicon);
            $filename_fav = $this->uploadImages($request->file('web_favicon'));
        } else {
            $filename_fav = $oldData->web_favicon;
        }

        $updateData = $request->all();
        $updateData['web_logo'] =  $filename_logo;
        $updateData['web_favicon'] =  $filename_fav;

        if ($oldData->update($updateData)) {
            return redirect()->route('tsr-admin.settings.index')->with('success', 'Settings Update Successfully');
        } else {
            return redirect()->back()->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    //-- Upload image ->
    public function uploadImages($image)
    {
        $fileName = str_replace(' ', '-', $image->getClientOriginalName());
        $path = public_path('assets/frontend/img/');

        $imageInstance = Image::make($image);
        $imageInstance->save($path . '/' . $fileName);

        return $fileName;
    }

    // Delete image
    public function deleteImages($image)
    {
        $imagePath = public_path('assets/frontend/img/' . $image);
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }
    }
}
