<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\District;
use App\Models\DiscountPartner;
use Intervention\Image\Facades\Image;

class DiscountPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = DiscountPartner::with('district')->select('*');
            return datatables()->eloquent($data)->make(true);
        }

        return view('admin.discount_partner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::orderBy('name')->pluck('name', 'id');
        $districts = District::where('country_id', 19)->orderBy('name')->pluck('name', 'id');
        $discountCategory = ['' => 'Select discount category', 'hospital' => 'Hospital', 'diagnostic-centre' => 'Diagnostic Centre', 'pharmacy' => 'Pharmacy', 'food-restaurant' => 'Food and Restaurant', 'grocery' => 'Grocery', 'life-style' => 'Life Style', 'others' => 'Others',];

        return view('admin.discount_partner.create', compact('countries', 'districts', 'discountCategory'));
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
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name_en' => 'required',
            'name_bn' => 'required',
            'address_en' => 'required',
            'address_bn' => 'required',
            'discount_category' => 'required',
            'district_id' => 'required',
        ]);

        $filename = '';
        if ($request->hasFile('logo')) {
            $filename = $this->uploadImages($request->file('logo'));
        }

        $data = $request->all();
        $data['created_by'] = auth()->id();
        $data['logo'] = $request->logo ?  $filename: '';

        if (DiscountPartner::create($data)) {
            return redirect()->route('tsr-admin.discount-partner.index')->with('success', 'Discount Partner created successfully');
        }

        return redirect()->back()->withInput();
    }

    // <!--File upload function -->
    public function uploadImages($image)
    {
        $originalName = $image->getClientOriginalName();
        $filename = strtotime("now") . '_' . $originalName;

        $image = Image::make($image);

        $image->save(public_path() . "/images/discount_partner/" . $filename);
        // $image->resize(200, 200)->save(public_path() . "/images/discount_partner/" . $filename);
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
        $discountPartner = DiscountPartner::FindOrFail($id);

        $countries = Country::orderBy('name')->pluck('name', 'id');
        $districts = District::where('country_id', 19)->orderBy('name')->pluck('name', 'id');
        $discountCategory = ['' => 'Select discount category', 'hospital' => 'Hospital', 'diagnostic-centre' => 'Diagnostic Centre', 'pharmacy' => 'Pharmacy', 'food-restaurant' => 'Food and Restaurant', 'grocery' => 'Grocery', 'life-style' => 'Life Style', 'others' => 'Others',];

        return view('admin.discount_partner.edit', compact('countries', 'districts', 'discountPartner', 'discountCategory'));
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
        $data = DiscountPartner::findOrFail($id);
        //validation
        $this->validate($request, [
            // 'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name_en' => 'required',
            'name_bn' => 'required',
            'address_en' => 'required',
            'address_bn' => 'required',
            'discount_category' => 'required',
            'district_id' => 'required',
        ]);

        $filename = $data->logo;
        if ($request->hasFile('logo')) {
            $filename = $this->uploadImages($request->file('logo'));
            if ($data->logo) {
                $oldPhotoPath = public_path('/images/discount_partner/') . $data->logo;
                if (file_exists($oldPhotoPath)) {
                    @unlink($oldPhotoPath);
                }
            }
        }

        $updatedata = $request->all();
        $updatedata['updated_by'] = auth()->id();
        $updatedata['logo'] = $filename;

        if ($data->update($updatedata)) {
            return redirect()->route('tsr-admin.discount-partner.index')->with('success', 'Discount Partner Updated successfully');
        }

        return redirect()->back()->withInput();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DiscountPartner::find($id);
        if ($data->delete()) {
            @unlink(public_path() . "/images/discount_partner/" . $data->logo);
            return back()->with('success',  $data->name_en . ' has been deleted.');
        }
    }
}
