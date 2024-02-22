<?php
$this->validate($request, [
    'name' => 'required|unique:medicines,name',
    'status' => 'required|in:active,inactive'
]);

$data = $request->validate([
    'name_en' => 'required|unique:services,name_en',
    'name_bn' => 'required|unique:services,name_bn',
    'service_type_id' => 'required',
    'standard_fees' => 'required',
    'status' => 'required|in:active,inactive',
    'title' => 'required|max:255',
    'tag' => 'nullable|max:1000',
    'code' => 'required|max:255',
    'total_qty' => 'required|integer|max:100000',
    "stock" => "nullable|array|min:1",
    "stock.size.*" => "required_with:stock|distinct",
    "stock.qty.*" => "required_with:stock",
    'brand_id' => 'nullable|integer|max:2000',
    'price' => 'required|numeric|max:1000000',
    'discount_type' => 'required|boolean',
    'discount_amount' => 'required|numeric|max:1000000',
    'display' => 'required',
    'excerpt' => 'nullable|max:2000',
    'deliverydays' => 'nullable|max:255',
    'description' => 'nullable|max:10000',
    'category_id' => 'required|integer|max:10000',
    'order' => 'nullable|string|max:500',
    'slug' => 'nullable|alpha_dash',
    'size_chart' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1920|max:1024',
    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:min_width=285,min_height=380|max:1024',
    'other_images' => 'required',
    'other_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1920|max:1024',
]);


