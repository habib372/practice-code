

 public function destroy($id)
    {
        $data = User::find($id);
        if ($data->delete()) {
            @unlink(public_path() . "/images/users/" . $data->profile_photo);
            return back()->with('success', 'User ' . $data->name . ' has been deleted.');
        }
    }