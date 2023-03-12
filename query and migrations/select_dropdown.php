<div class="col-lg-4">
	<label>Category Name:</label><br>
	{{-- <select style="width: 100%;" class="form-control" name="category_id" id="category">
													    <option value="">Select</option>
													    @foreach($all_category as $category)
													    <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected':''}}>{{$category->category_name}}</option>
	@endforeach
	</select> --}}
	<select id="category_id" name=category_id class="form-control">
		<option value="" selected disabled>Select</option>
		@foreach($all_category as $category)
		<option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected':''}}>{{$category->category_name}}</option>
		@endforeach
	</select>
	<span class="form-text text-muted">Please select an option.</span>
</div>


<option value="" selected disabled>Select</option>


<a class="dropdown-item text-warning" href="{{ url('admin/product/edit',$product->id) }}"><i class="flaticon2-edit icon-lg"></i> Edit
</a>