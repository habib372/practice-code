<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Header;
use Auth;
use Carbon\Carbon;
use Image;
use Brian2694\Toastr\Facades\Toastr;

class HeaderController extends Controller
{
    public function create()
    {
        return view('admin.header.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'header_title' => 'required',
            'mobile' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|required|max:1024',
        ]);

        $logo_id = Header::insertGetId([
            'added_by' => Auth::id(),
            'header_title' => $request->header_title,
            'address' => $request->address,
            'team_text' => $request->team_text,
            'schedule' => $request->schedule,
            'schedule_two' => $request->schedule_two,
            'mobile' => $request->mobile,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instragram' => $request->instragram,
            'whatsapp' => $request->whatsapp,
            'created_at' => Carbon::now(),
        ]);

        if ($request->hasFile('image')) {
            $upload_logo_photo = $request->file('image');
            $new_upload_logo_photo_name = $logo_id . '.' . $upload_logo_photo->extension();
            $new_logo_photo_location = base_path('public/uploads/header/') . $new_upload_logo_photo_name;
            Image::make($upload_logo_photo)->save($new_logo_photo_location);
            Header::find($logo_id)->update([
                'image' => $new_upload_logo_photo_name,
            ]);
        }

        Toastr::success('Header Add successfully :)', 'Success');
        return back();
    }
    public function view()
    {
        $all_header = Header::orderBy('id', 'desc')->get();
        return view('admin.header.view', compact('all_header'));
    }
    public function status($id)
    {
        $data = Header::find($id);
        if ($data->status == 0) {
            Header::where('id', $id)->update([
                'status' => 1,
            ]);

            Header::where('id', '!=', $id)->update([
                'status' => 0,
            ]);
        } else {
            Header::where('id', $id)->update([
                'status' => 0,
            ]);

            Header::where('id', '!=', $id)->update([
                'status' => 1,
            ]);
        }

        Toastr::success('Status Change successfully :)', 'Success');
        return back();
    }
    public function delete($id)
    {
        $data = Header::find($id);
        $image_path = public_path() . 'uploads/header/' . $data->image;
        unlink("uploads/header/" . $data->image);
        $data->delete();

        Toastr::success('Header Delete successfully :)', 'Success');
        return back();
    }
    public function edit(Request $request)
    {
        $get_image = Header::find($request->id);
        $request->all();
        if ($request->hasFile('image')) {
            if ($get_image->image != 'photo.jpg') {
                $delete_location = base_path('public/uploads/header/' . $get_image->image);
                unlink($delete_location);
            }
            $uploaded_product_photo = $request->file('image');
            $new_product_photo_name = $get_image->id . '.' . $uploaded_product_photo->extension();
            $new_product_photo_location = base_path('public/uploads/header/' . $new_product_photo_name);
            Image::make($uploaded_product_photo)->save($new_product_photo_location);
            $get_image->image = $new_product_photo_name;
        }
        $get_image->header_title = $request->header_title;
        $get_image->address = $request->address;
        $get_image->team_text = $request->team_text;
        $get_image->schedule = $request->schedule;
        $get_image->schedule_two = $request->schedule_two;
        $get_image->mobile = $request->mobile;
        $get_image->facebook = $request->facebook;
        $get_image->twitter = $request->twitter;
        $get_image->instragram = $request->instragram;
        $get_image->whatsapp = $request->whatsapp;
        $get_image->added_by = Auth::id();
        $get_image->created_at = Carbon::now();
        $get_image->save();

        Toastr::success('Header Update successfully :)', 'Success');
        return back();
    }
}
