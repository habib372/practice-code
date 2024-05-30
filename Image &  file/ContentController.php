<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ContentCategory;
use App\Models\Content;
use Illuminate\Http\Request;
use DataTables;
use File;
use DB;
use Intervention\Image\Facades\Image;


class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $data = Content::with('contentCategory')->orderBy('content_category_id', 'ASC')->orderBy('order', 'ASC');
            return DataTables::eloquent($data)->make(true);
        }

        return view('admin.content.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get categories list
        $categories = ContentCategory::where('status', 'active')->pluck('title_en', 'id');

        return view('admin.content.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Form validation
        $this->validate($request, [
            'content_category_id' => 'required',
            'title_en' => 'required',
            'title_bn' => 'required',
            'description_en' => 'required',
            'description_bn' => 'required',
            'status' => 'required|in:active,inactive',
            // 'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Handle English image
        if ($request->hasFile('image_en')) {
            $filename_en = $this->uploadImages($request->file('image_en'));
        } else {
            $filename_en = null;
        }

        // Handle Bengali image
        if ($request->hasFile('image_bn')) {
            $filename_bn = $this->uploadImages($request->file('image_bn'));
        } else {
            $filename_bn = null;
        }

        $content = Content::create([
            'content_category_id' => $request->content_category_id,
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'description_en' => $request->description_en,
            'description_bn' => $request->description_bn,
            'image_en' => $filename_en,
            'image_bn' => $filename_bn,
            'meta_title_en' => $request->meta_title_en,
            'meta_title_bn' => $request->meta_title_bn,
            'meta_tag_en' => $request->meta_tag_en,
            'meta_tag_bn' => $request->meta_tag_bn,
            'meta_description_en' => $request->meta_description_en,
            'meta_description_bn' => $request->meta_description_bn,
            'featured' => $request->featured,
            'order' => $request->order,
            'status' => $request->status,
            'created_by' => auth()->id()
        ]);

        if ($content->id) {
            return redirect()->route('tsr-admin.content.index')->with('success', 'Content created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        return view('admin.content.web_view', compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Get category list
        $categories = ContentCategory::where('status', 'active')->pluck('title_en', 'id');

        $content = Content::findOrFail($id);
        return view('admin.content.edit', compact('content', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Content $content)
    {
        // Form validation
        $this->validate($request, [
            'content_category_id' => 'required',
            'title_en' => 'required',
            'title_bn' => 'required',
            'description_en' => 'required',
            'description_bn' => 'required',
            'status' => 'required|in:active,inactive'
        ]);

        // Handle English image
        if ($request->hasFile('image_en')) {
            $this->deleteImages($content->image_en);
            $filename_en = $this->uploadImages($request->file('image_en'));
        } else {
            $filename_en = $content->image_en;
        }

        // Handle Bengali image
        if ($request->hasFile('image_bn')) {
            $this->deleteImages($content->image_bn);
            $filename_bn = $this->uploadImages($request->file('image_bn'));
        } else {
            $filename_bn = $content->image_bn;
        }

        // Prepare data for updating the content
        $data = [
            'content_category_id' => $request->content_category_id,
            'title_en' => $request->title_en,
            'title_bn' => $request->title_bn,
            'description_en' => $request->description_en,
            'description_bn' => $request->description_bn,
            'image_en' => $filename_en,
            'image_bn' => $filename_bn,
            'meta_title_en' => $request->meta_title_en,
            'meta_title_bn' => $request->meta_title_bn,
            'meta_tag_en' => $request->meta_tag_en,
            'meta_tag_bn' => $request->meta_tag_bn,
            'meta_description_en' => $request->meta_description_en,
            'meta_description_bn' => $request->meta_description_bn,
            'featured' => $request->featured,
            'order' => $request->order,
            'status' => $request->status,
            'updated_by' => auth()->id()
        ];

        // Update content and redirect
        if ($content->update($data)) {
            return redirect()->route('tsr-admin.content.index')->with('success', 'Content has been updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update content');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        if ($content->delete()) {
            $imagePath = public_path('images/contents/' . $content->image_en);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }
            $imagePath2 = public_path('images/contents/' . $content->image_bn);
            if (file_exists($imagePath2) && is_file($imagePath2)) {
                unlink($imagePath2);
            }
            return redirect()->route('tsr-admin.content.index')->with('success', 'Content ' . $content->title_en . ' has been deleted.');
        }

        return redirect()->route('tsr-admin.content.index')->with('error', 'Content ' . $content->title_en . ' can not be deleted!');
    }


    //-- Upload image ->
    public function uploadImages($image)
    {
        $fileName = time() . rand(0, 1000) . "_" . str_replace(' ', '-', $image->getClientOriginalName());
        $path = public_path('images/contents');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $imageInstance = Image::make($image);
        $imageInstance->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path . '/' . $fileName);

        return $fileName;
    }

    // Delete image
    public function deleteImages($image)
    {
        $imagePath = public_path('images/contents/' . $image);
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }
    }
}
