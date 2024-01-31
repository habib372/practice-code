<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ServiceProvider\Store;
use App\Http\Requests\ServiceProvider\Update;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ServiceProvider;
use App\Models\ServiceProviderType;
use App\Models\User;
use DataTables;
use File;
use Illuminate\Support\Str;


// Note: ==== Service provider is a Branch =====>

class ServiceProviderController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {

            if(auth()->user()->userRole->name == 'service-provider'){
                $data = ServiceProvider::with('serviceProviderType')->where('service_provider_id', auth()->user()->id)->select('service_providers.*');
            }
            if(auth()->user()->userRole->name == 'admin'){
                $data = ServiceProvider::with('serviceProviderType')->select('service_providers.*');
            }

            return DataTables::eloquent($data)->make(true);
        }
        return view('admin.branch.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $serviceProviderTypes = ['' => '-- Select Service Provider --'] + ServiceProviderType::where('status', 'active')->pluck('name_en', 'id')->toArray();
        $parentCompany = ['' => '--Select Parent Company--'] + ServiceProvider::where('status', 'active')->pluck('name_en', 'id')->toArray();
        $serviceProviderUserList = ['' => '--Select Managed Person--'] + User::where('status', 'active')->pluck('name', 'id')->toArray();

        return view('admin.branch.create', compact(['serviceProviderTypes', 'parentCompany', 'serviceProviderUserList']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $data = $request->all();
        $data['created_by'] = auth()->id();
        // $data['logo'] = time()."_".$request->file('logo')->getClientOriginalName();

        if($request->hasFile('logo')){
            $fileName = time() . "_" . str_replace(' ', '-', $request->file('logo')->getClientOriginalName());
            $data['logo'] = $fileName;
            $this->uploadImages($request->file('logo'), 200, $fileName);
        }

        if (ServiceProvider::create($data)) {
            return redirect()->route('tsr-admin.branch.index')->with('success', 'Branch created successfully');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $serviceProvider = ServiceProvider::find($id);
        return view('admin.branch.show', compact('serviceProvider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serviceProvider = ServiceProvider::find($id);
        $serviceProviderTypes = ['' => '-- Select Service Provider --'] + ServiceProviderType::where('status', 'active')->pluck('name_en', 'id')->toArray();
        $parentCompany = ['' => '--Select Parent Company--'] + ServiceProvider::where('status', 'active')->pluck('name_en', 'id')->toArray();
        $serviceProviderUserList = ['' => '--Select Managed Person--'] + User::where('status', 'active')->pluck('name', 'id')->toArray();

        return view('admin.branch.edit', compact(['serviceProvider', 'serviceProviderTypes', 'parentCompany', 'serviceProviderUserList']));
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        // dd($request);
        $data = ServiceProvider::find($id);

        $filename = $data->logo;
        if ($request->hasFile('logo')) {
            $fileName = time() . "_" . str_replace(' ', '-', $request->file('logo')->getClientOriginalName());
            $this->uploadImages($request->file('logo'), 200, $fileName);

            if ($data->logo) {
                $oldPhotoPath = public_path('/images/branch') . '/' . $data->logo;
                if (file_exists($oldPhotoPath)) {
                    @unlink($oldPhotoPath);
                }
            }
            $filename = $fileName;
        }

        $updateData = [
            'service_provider_type_id' => $request->service_provider_type_id,
            'parent_company_id' => $request->parent_company_id,
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'description_en' => $request->description_en,
            'description_bn' => $request->description_bn,
            'contact_person_en' => $request->contact_person_en,
            'contact_person_bn' => $request->contact_person_bn,
            'contact_address_en' => $request->contact_address_en,
            'contact_address_bn' => $request->contact_address_bn,
            'contact_number' => $request->contact_number,
            'featured' => $request->featured,
            'logo' => $filename,
            'order' => $request->order,
            'status' => $request->status,
            'updated_by' => auth()->id()
        ];

        if ($data->update($updateData)) {
            return redirect()->route('tsr-admin.branch.index')->with('success', 'Branch has been updated successfully');
        } else {
            return redirect()->route('tsr-admin.branch.index')->with('error', 'Failed to update Branch');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceProvider  $serviceProvider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ServiceProvider::find($id);
        if ($data->delete()) {
            @unlink(public_path() . "/images/service_provider/" . $data->logo);
            return back()->with('success', 'Branch has been deleted');
        }
    }

    /**
     * Upload service provider logo.
     *
     * @param  file  $image
     * @return \Illuminate\Http\Response
     */
    public function uploadImages($image, $width, $fileName){
        // $originalExtension = $image->getClientOriginalExtension();

        $path = public_path().'/images/branch';
        if (!is_dir($path)) {
            File::makeDirectory($path);
        }

        $image = Image::make($image);
        $image->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path . '/'. $fileName);

        // $image->widen(100)->save($path . "/thumb_".$originalName);
    }


}
