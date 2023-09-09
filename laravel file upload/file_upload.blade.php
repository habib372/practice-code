<!-- - View file Create-->
<form action="{{ route('tsr-admin.branch-type.store') }}" method="POST" enctype="multipart/form-data">
    <div class="col-lg-4">
        <label for="logo">Branch Type Logo</label>
        <input type="file" class="form-control-file m-input{{ $errors->has('logo')? ' border-danger' : '' }}" id="logo" name="logo" value="">
        @error('logo')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</form>


<!-- - ServiceProviderType Controller file -->
use App\Http\Requests\ServiceProviderType\Store;  //for method -1
use Illuminate\Http\Request;     //for method -2
use File;

<!-- - method 1 create-->
    <!-- create-->
  public function store(Store $request)
    {
        dd($request->all());

        $data = $request->all();
        $data['created_by'] = auth()->id();
        $data['logo'] = $request->logo ? $request->file('logo')->getClientOriginalName() : '';

        if (ServiceProviderType::create($data)) {
            if ($request->hasFile('logo')) {
                $this->uploadImages($request->file('logo'), 200);
            }
            return redirect()->route('tsr-admin.branch-type.index')->with('success', 'Service Provider Type created successfully');
        }

        return redirect()->back()->withInput();
    }
    <!-- Update-->
 public function update(Update $request, ServiceProviderType $serviceProviderType)
    {
        $data = $request->all();
        $data['logo'] = $request->logo ? $request->file('logo')->getClientOriginalName() : $serviceProviderType->logo;
        $data['updated_by'] = auth()->id();

        if ($serviceProviderType->update($data)) {
            //Upload Service Provider Type logo
            if ($request->hasFile('logo')) {
                $this->uploadImages($request->file('logo'), 200);
            }
            return redirect()->route('tsr-admin.branch-type.index')->with('success', 'Service Provider Type has been updated successfully');
        }

        return redirect()->back()->withInput()->with('errors', 'Somthing is wrong');
    }
    <!-- method 1 function for single resize image-->
    public function uploadImages($image, $width)
    {
        $originalName = $image->getClientOriginalName();

        $path = public_path().'/images/serviceprovidertype';
        if (!is_dir($path)) {
            File::makeDirectory($path);
        }

        $image = Image::make($image);
        $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path.'/'.$originalName);

    }
    <!-- method 1 function for multiple resize image-->
    public function uploadImages($image, $width)
    {
        $originalName = $image->getClientOriginalName();

        $path = public_path().'/images/serviceprovidertype';
        if (!is_dir($path)) {
            File::makeDirectory($path);
        }

        $image = Image::make($image);
        $image->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path . "/large_" . $originalName);

        $image->widen(100)->save($path . "/thumb_" . $originalName);
    }
<!-- End method 1 -->


<!-- - method 2 -->
    public function store(Request $request)
    {
        <!--validate-->
        $this->validate($request, [
            'logo' => 'mimes:jpg,jpeg,png,gif|required'
        ]);

        $filename = null;
        if ($request->hasFile('logo')) {
            $path = public_path() . '/images/serviceprovidertype';
            if (!is_dir($path)) {
                File::makeDirectory($path);
            }
            $filename = time() . rand(0, 1000) . '.' . $request->file('logo')->getClientOriginalExtension();
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
            'logo' => $filename,
            'created_by' =>  auth()->id()
        ]);

        if ($branch_type) {
            return redirect()->route('tsr-admin.branch-type.index')->with('success', 'Branch Type has been Crated successfully');
        } else {
            return redirect()->back()->withInput()->with('errors', 'Somthing is missing');
        }
    }
<!--End method 2 -->