

 public function delete($id)
    {
        $data = Page::find($id);
        if (file_exists( public_path().'/uploads/page/'.$data->image)) {
            $image_path = public_path().'uploads/page/'.$data->image;
            unlink("uploads/page/".$data->image);
        }
        $data->delete();

        Toastr::success(('Category Delete successfully :)','Success');
        return back();
    }