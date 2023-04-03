<div class="modal fade " id="editModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">
                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to Edit ?</h5>
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form action="{{url('admin/update/product')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
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
                        <div class="col-lg-4" style="display: none;">
                            <label for="title">Sub-Category Name:</label>
                            <select name=subcategory_id id="subcategory_id" class="form-control">
                                <option value="{{$product->subcategory_id}}">{{$product->connect_subcategory->title??''}}</option>
                            </select>
                            <select style="width: 100%;" name="subcategory_id" id="subcategory" class="form-control">
                                <option value="">Select</option>
                                @foreach($all_subcategory as $subcategory)
                                <option value="{{$subcategory->id}}" {{$product->subcategory_id == $subcategory->id ? 'selected':''}}>{{$subcategory->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4" style="display: none;">
                            <label for="title">Child-Category Name:</label>
                            <select name=childcategory_id id="childcategory_id" class="form-control">
                                <option value="{{$product->childcategory_id}}">{{$product->connect_childcategory->title??''}}</option>
                            </select>
                            {{-- <select style="width: 100%;" name="childcategory_id" id="childcategory" class="form-control">
									                	<option value="">Select</option>
													    @foreach($all_childcategory as $childcategory)
													    <option value="{{$childcategory->id}}" {{$product->childcategory_id == $childcategory->id ? 'selected':''}}>{{$childcategory->title}}</option>
                            @endforeach
                            </select> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-8">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control form-control-solid" value="{{$product->product_name}}" />
                            <input type="hidden" name="id" class="form-control form-control-solid" value="{{$product->id}}" />
                            <span class="form-text text-muted">Please enter your Product Name</span>
                        </div>
                        <!--<div class="col-lg-4">-->
                        <!--  <label>Price:</label>-->
                        <!-- <input type="text" class="form-control form-control-solid" name="price" value="{{$product->price}}"/>-->
                        <!-- <span class="form-text text-muted">Please enter your Price</span>-->
                        <!--</div>-->
                    </div>
                    <div class="form-group">
                        <label>Product Photo Browser</label>
                        <div></div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="image" id="profile-photo" onchange="preview_photo(event)" />
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            <img src="{{asset('uploads/product')}}/{{$product->image}}" id="output_photo" width="200px" style="padding-top: 5px;" />
                        </div>
                    </div>
                    @error('image')
                    <div class="alert alert-danger">
                        <strong>{{$mesage}}</strong>
                    </div>
                    @enderror
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="summernotetwo" name="description">{!! $product->description??'' !!}</textarea>
                    </div>

                    <div class="form-group" style="text-align:end;">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>