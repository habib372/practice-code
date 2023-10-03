
{{-- rulse 1 --}}
public function updateProfile(Request $request, User $user)
    {
        if ($request->hasFile('profile_photo')) {
            $updateFile = time() . '_' . $request->file('profile_photo')->getClientOriginalName();
            $this->uploadImages($request->file('profile_photo'));

            if (is_file(public_path('/images/users/' . $user->profile_photo))) {
                @unlink(public_path('/images/users/' . $user->profile_photo));
            }
        } else {
            $updateFile = $user->profile_photo;
        }

        $updateStatus = $user->update([
            'name' => $request->name,
            'profile_photo' => $updateFile,
            'password' => $request->password ? Hash::make($request->password):$user->password,
            'updated_by' => auth()->user()->id
        ]);

        return redirect('tsr-admin/user/showprofile')->with('success', 'Your profile has been updated');
    }


{{-- rulse 2 --}}
public function update(Request $request, $id)
    {
        $existData = User::find($id);
        $data = $request->all();
        $data['updated_by'] = auth()->id();

        if ($request->hasFile('logo')) {
            $data['logo'] = time() . "_" . $request->file('logo')->getClientOriginalName();
            $this->uploadImages($request->file('logo'));

            if (is_file(public_path('/images/users/' . $existData->logo))) {
                @unlink(public_path('/images/users/' . $existData->logo));
            }
        } else {
            $data['logo'] = $existData->logo;
        }

        if ($existData->update($data)) {
            return redirect()->route('tsr-admin.featured-service-providers.index')->with('success', 'Featured Service Provider has been updated successfully');
        }

        return redirect()->back()->withInput();
    }


{{-- function --}}
    public function uploadImages($image)
    {
        $originalName = $image->getClientOriginalName();

        $path = public_path() . '/images/users';
        if (!is_dir($path)) {
            File::makeDirectory($path, 0755, true, true);
        }

        {{-- $image = Image::make($image);                         //resize img
        $image->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path . "/" . time().'_'.$originalName); --}}

        {{-- $image->widen(100)->save($path . "/thumb_" . $originalName);  //for another resize copy --}}

        $image->move($path, time() . '_' . $originalName);


    }