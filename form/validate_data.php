<?php

$data = $request->validate([
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
    'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
    'other_images' => 'required',
    'other_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1920|max:1024',
]);


$table->id();
$table->integer('added_by')->nullable();
$table->string('showroom_name')->nullable();
$table->string('address')->nullable();
$table->string('map_link')->nullable();
$table->string('email')->nullable();
$table->string('mobile')->nullable();
$table->string('facebook')->nullable();
$table->string('whatsapp')->nullable();
$table->string('linkedin')->nullable();
$table->string('youtube')->nullable();
$table->string('image')->default('photo.jpg');
$table->integer('status')->default(0);
$table->timestamps();