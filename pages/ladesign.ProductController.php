<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\ChildCategory;
use App\Product;
use Auth;
use Carbon\Carbon;
use Image;
use Brian2694\Toastr\Facades\Toastr;

class ProductController extends Controller
{
    public function create()
    {
      
        $products = Product::orderBy('id','desc')->get();

        return view('admin.product.create',compact('products'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpg,jpeg,png|required|max:1024',
            // 'category_id' => 'required',
            'product_name' => 'required',
        ]);

        $logo_id = Product::insertGetId([
            'added_by' => Auth::id(),
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);

        if ($request->hasFile('image')) 
        {
            $upload_logo_photo = $request->file('image');
            $new_upload_logo_photo_name = $logo_id.'.'.$upload_logo_photo->extension();
            $new_logo_photo_location = base_path('public/uploads/product/').$new_upload_logo_photo_name;
            Image::make($upload_logo_photo)->save($new_logo_photo_location);
            Product::find($logo_id)->update([
                'image' => $new_upload_logo_photo_name,
            ]);
        }

        Toastr::success('Product Add successfully :)','Success');
        return back();

    }
    
    public function delete($id)
    {
        $data = Product::find($id); 
        unlink("uploads/product/".$data->image);
        $data->delete();

        Toastr::success('Product Delete successfully :)','Success');
        return back();
    }
    public function status($id)
    {
        $data = Product::find($id);
        if ($data->status == 0) 
        {
           Product::where('id',$id)->update([
                'status' => 1,
           ]);
        } 
        else 
        {
            Product::where('id',$id)->update([
                'status' => 0,
            ]);
        }

        Toastr::success('Status Change successfully :)','Success');
        return back();
        
    }
    public function edit(Request $request)
    {
        // $request->validate([
        //     'category_id' =>'required',
        // ]);
        $get_image = Product::find($request->id);
        $request->all();
        if ($request->hasFile('image')) {
          if ($get_image->image != 'photo.jpg') {
            $delete_location = base_path('public/uploads/product/'.$get_image->image);
            unlink($delete_location);
          }
        $uploaded_product_photo = $request->file('image');
        $new_product_photo_name = $get_image->id.'.'.$uploaded_product_photo->extension();
        $new_product_photo_location = base_path('public/uploads/product/'.$new_product_photo_name);
        Image::make($uploaded_product_photo)->save($new_product_photo_location);
        $get_image->image = $new_product_photo_name;
        }
        // $get_image->category_id = $request->category_id;
        $get_image->product_name = $request->product_name;
        $get_image->price = $request->price;
        $get_image->description = $request->description;
        $get_image->added_by = Auth::id();
        // $get_image->created_at = Carbon::now();
        $get_image->save();
        
        Toastr::success('Product Update successfully :)','Success');
        return back();
    }
    public function findCityWithStateID($id)
    {
        $city = SubCategory::where('category_id',$id)->get();
        return response()->json($city);
    }
    public function getStateList($id)
    {
        $states = SubCategory::where('category_id',$id)->get();
        return response()->json($states);
    }

    public function getCityList($id)
    {
        $cities = ChildCategory::where('subcategory_id',$id)->get();
        return response()->json($cities);
    }



}
