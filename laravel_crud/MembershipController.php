<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Intervention\Image\Facades\Image;
use App\Models\Membership;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Membership::select('*');
            return datatables()->eloquent($data)->make(true);
        }

        return view('admin.membership.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.membership.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'logo' => 'required|mimes:jpg,jpeg,png,gif,svg',
            'name_en' => 'required',
        ]);

        $filename = '';
        if ($request->hasFile('logo')) {
            $filename = $this->uploadImages($request->file('logo'));
        }

        $data = Membership::create([
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'status' => $request->status,
            'logo' => $filename,
            'created_by' => auth()->id()
        ]);

        // or


        if($data) {
            return redirect()->route('tsr-admin.membership.create')->with('success', 'Membership created successfully');
        }

        return redirect()->back()->withInput();
    }

    // <!--File upload function for not .gif-->
    public function uploadImages($image)
    {
        $originalName = $image->getClientOriginalName();
        $filename = strtotime("now") . '_' . $originalName;

        $image = Image::make($image);

        $image->save(public_path() . "/images/membership/" . $filename);
        // $image->resize(200, 200)->save(public_path() . "/images/membership/" . $filename);
        return $filename;
    }


    // <!--File upload function for all format-->
    public function uploadImages1($image)
    {
        $originalName = $image->getClientOriginalName();
        $filename = strtotime("now") . '_' . $originalName;

        //not .gif image
        $imagePath = public_path() . "/images/membership/" . $filename;

        // Check if the uploaded file is a GIF
        if ($image->getClientOriginalExtension() === 'gif') {
            // If it's a GIF, move it to the desired location without modifying it
            $image->move(public_path() . "/images/membership/", $filename);
        } else {
            // If it's not a GIF, process it as usual
            $image = Image::make($image);
            $image->save($imagePath);
        }

        return $filename;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $membership = Membership::findOrFail($id);
        return view('admin.membership.edit' , compact('membership'));
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
        $data = Membership::findOrFail($id);

        $this->validate($request, [
            'logo' => 'required|mimes:jpg,jpeg,png,gif,svg',
            'name_en' => 'required',
        ]);

        $filename = $data->logo;
        if ($request->hasFile('logo')) {
            $filename = $this->uploadImages($request->file('logo'));
            if ($data->logo) {
                $oldPhotoPath = public_path('/images/membership/') . $data->logo;
                if (file_exists($oldPhotoPath)) {
                    @unlink($oldPhotoPath);
                }
            }
        }

        $updateData = [
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'status' => $request->status,
            'updated_by' => auth()->id(),
            'logo' => $filename
        ];

        if ($data->update($updateData)) {
            return redirect()->route('tsr-admin.membership.index')->with('success', 'Membership Update Successfully');
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
        $data = Membership::find($id);
        if ($data->delete()) {
            @unlink(public_path() . "/images/membership/" . $data->logo);
            return back()->with('success',  $data->name_en . 'membership has been deleted.');
        }
    }

}
