@extends('layouts.dashboard')
@section('title')
Product 
@endsection
@section('product')
 menu-item-active
@endsection
@section('css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> --}}
@endsection
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <h6 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Product</h6>
                <!--end::Actions-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom">
					 	<div class="card-header">
						    <div class="card-title">
						   		<h3 class="card-label">All Product List</h3>
						    </div>

						    <div class="card-toolbar">
							   	<ul class="nav nav-bold nav-pills ml-auto">
								    <li class="nav-item">
								    	 <!-- Add Logo-->
					                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
					                        <i class="flaticon2-plus-1 icon-lg"></i> Add New Product
					                    </button>

					                    <!-- Modal-->
					                    <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
					                        <div class="modal-dialog modal-lg" role="document">
					                            <div class="modal-content">
					                                <div class="modal-header">
					                                    <h5 class="modal-title" id="exampleModalLabel">Create New Product</h5>
					                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                        <i aria-hidden="true" class="ki ki-close"></i>
					                                    </button>
					                                </div>
					                                <div class="modal-body">
					                                   	<form action="{{url('admin/post/product')}}" method="POST" enctype="multipart/form-data">
					                                   		@csrf
					                           
											  	<div class="form-group row">
													   	<div class="col-lg-4">
														   <label>Category Name:</label><br>
															
															<select id="country" name=category_id  class="form-control">
														        <option value="" selected disabled>Select</option>
														         @foreach($all_category as $category)
															    <option value="{{$category->id}}">{{$category->category_name}}</option>
															    @endforeach
													         </select>
													   	</div>
													   <div class="col-lg-4" style="">
														    <label for="title">Sub-Category Name:</label>
													        <select name=subcategory_id id="state" class="form-control">
													        </select>
													   </div>
													   <!--<div class="col-lg-4" style="">-->
														  <!--  <label for="title">Child-Category Name:</label>-->
														  <!--  <select name=childcategory_id id="city" class="form-control">-->
        								<!--					</select>-->
													   <!--</div>-->
												</div>
											  	<div class="form-group row">
													   	<div class="col-lg-8">
														   <label>Product Name</label>
														   <input type="text" name="product_name" class="form-control form-control-solid"/>
														   <span class="form-text text-muted">Please enter your Product Name</span>
													   	</div>
													   <!--<div class="col-lg-4">-->
														  <!--  <label>Price:</label>-->
														  <!-- <input type="text" class="form-control form-control-solid" name="price" />-->
														  <!-- <span class="form-text text-muted">Please enter your Price</span>-->
													   <!--</div>-->
												</div>
					                            <div class="form-group">
														<label>Product Photo Browser</label>
														<div></div>
														<div class="custom-file">
															<input type="file" class="custom-file-input" id="customFile" name="image" id="profile-img" onchange="preview_image(event)"/>
															<label class="custom-file-label" for="customFile">Choose file</label>
															<img src="" id="output_image" width="200px" style="padding-top: 5px;" />
														</div>
														@error('image')
													   <div class="alert alert-danger">
													   		<strong>{{$mesage}}</strong>
													   </div>
													   @enderror
												</div>
												<div class="form-group">
										  			 <label>Description</label>
				                					<textarea id="summernote" name="description"></textarea>
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
								    </li>
							   </ul>
							</div>
						</div>
						<div class="card-body">
						  	<!--begin: Search Form-->
										<!--begin: Datatable-->
										<table id="usertable" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>SL No.</th>
													<th>Category</th>
													<th>Name</th>
													<th>Photo</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@php
													$i = 1;
												@endphp
											@foreach($products as $product)
												<tr>
													<td>{{$i++}}</td>
													<td>{{$product->connect_category->category_name??'Null'}}</td>
													<td>{{$product->product_name??'Null'}}</td>
													<td><img src="{{asset('uploads/product')}}/{{$product->image}}" alt="" width="80px;"></td>
													<td>
														@if($product->status == 1)
														<a href="#statusModal{{$product->id}}" data-toggle="modal" class="btn btn-danger"  ><i class="fas fa-toggle-off icon-md"></i>Deactive
					                                    </a>
														@else
														<a href="#statusModal{{$product->id}}" data-toggle="modal" class="btn btn-success"  ><i class="fas fa-toggle-on icon-md"></i></i> Active
					                                    </a>
														@endif
													</td>
													<td>
					                                    <div class="dropdown">
														    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														        Action
														    </button>
														    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
														    	<a class="dropdown-item text-warning" href="#showModal{{$product->id}}" data-toggle="modal"><i class="flaticon-eye icon-lg"></i>&nbsp;&nbsp;Show
							                                    </a>
														        <a class="dropdown-item text-warning" href="#editModal{{$product->id}}" data-toggle="modal"><i class="flaticon2-edit icon-lg"></i>&nbsp;&nbsp;Edit
							                                    </a>
							                                    <a class="dropdown-item text-danger" href="#deleteModal{{$product->id}}" data-toggle="modal"><i class="flaticon2-rubbish-bin-delete-button icon-lg"></i> &nbsp;&nbsp;Delete
						                                    	</a>
														    </div>
														</div>
													</td>
											</tr>
<!-- Status Update -->
<div class="modal fade" id="statusModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">

            </div>
            <div class="modal-body m-auto">
                <h5 class="modal-title" id="exampleModalLongTitle">Are You Sure for Change Status?</h5>
            </div>
            <div class="modal-footer">
            	@if($product->status==1)
                <a href="{{url('admin/product/status')}}/{{$product->id}}" class="btn btn-danger">Active</a>
                @else
                <a href="{{url('admin/product/status')}}/{{$product->id}}" class="btn btn-danger">Deactive</a>
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete -->
<div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">

            </div>
            <div class="modal-body m-auto">
                <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to delete ?</h5>
            </div>
            <div class="modal-footer">
                <a href="{{url('admin/product/delete')}}/{{$product->id}}" class="btn btn-danger">Delete</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
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
													<select id="category_id" name="category_id"  class="cat_id form-control">
												        <option value="" disabled>Select</option>
												         @foreach($all_category as $category)
													    <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected':''}} data-id="{{$product->id}}">{{$category->category_name}}</option>
													    @endforeach
											         </select>
													<span class="form-text text-muted">Please select an option.</span>
											   	</div>
											   <div class="col-lg-4">
												    <label for="title">Sub-Category Name:</label>
												    <select name=subcategory_id id="subcategory_id" class="form-control subcategory_id_{{$product->id}}">
												    	<option value="{{$product->subcategory_id}}">{{$product->connect_subcategory->title??''}}</option>
													</select>
									                {{-- <select style="width: 100%;" name="subcategory_id" id="subcategory" class="form-control">
									                	<option value="">Select</option>
													    @foreach($all_subcategory as $subcategory)
													    <option value="{{$subcategory->id}}" {{$product->subcategory_id == $subcategory->id ? 'selected':''}}>{{$subcategory->title}}</option>
													    @endforeach
									                </select> --}}
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
													<input type="file" class="custom-file-input" id="customFile" name="image" id="profile-photo" onchange="preview_photo(event)"/>
													<label class="custom-file-label" for="customFile">Choose file</label>
												
												</div>
												<img src="{{asset('uploads/product')}}/{{$product->image}}" id="output_photo" width="200px" style="padding-top: 5px;" />
										</div>
										@error('image')
										   <div class="alert alert-danger">
										   		<strong>{{$mesage}}</strong>
										   </div>
										   @enderror
										   <div class="form-group">
									  			 <label>Description</label>
			                					<textarea class="summernotetwo" name="description">{!! $product->description??'' !!}</textarea>
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
<!-- Show -->
<div class="modal fade " id="showModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header state modal-primary">
                <h5 class="modal-title" id="exampleModalLongTitle">Product Information</h5>
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
              	<form action="{{url('admin/update/product')}}" method="POST" enctype="multipart/form-data">
			                                   		@csrf
			                           
									  	<div class="form-group row">
											   	<div class="col-lg-4">
												   <label>Category Name:</label><br>
												   <input type="text" name="product_name" class="form-control form-control-solid" value="{{$product->connect_category->category_name??''}}" />
											   	</div>
											   <div class="col-lg-4">
												   <label>Sub-Category Name:</label><br>
												   <input type="text" name="product_name" class="form-control form-control-solid" value="{{$product->connect_subcategory->title??'Null'}}" />
											   	</div>
											   <div class="col-lg-4">
												   <label>Sub-Category Name:</label><br>
												   <input type="text" name="product_name" class="form-control form-control-solid" value="{{$product->connect_childcategory->title??'Null'}}" />
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
												<label>Product Photo</label>
												<div></div>
												<div class="custom-file">
													<img src="{{asset('uploads/product')}}/{{$product->image}}" id="output_photo" width="200px" style="padding-top: 5px;" />
												</div>
										</div>
										@error('image')
										   <div class="alert alert-danger">
										   		<strong>{{$mesage}}</strong>
										   </div>
										   @enderror
										<div class="form-group" style="text-align:end;">
											<button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
										</div>
												</form>

            </div>
        </div>
    </div>
</div>
												@endforeach
											</tbody>
										</table>
										<!--end: Datatable-->
						</div>
					</div>
                </div>
            </div>
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

@endsection
@section('js')

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
{{-- <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> --}}
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

{!! Toastr::message() !!}
@if(Session::has('message'))
toastr.options =
{
"closeButton" : true,
"progressBar" : true
}
  toastr.success("{{ session('message') }}");
@endif
@if(Session::has('message'))
toastr.options =
{
"closeButton" : true,
"progressBar" : true
}
  toastr.error("{{ session('message') }}");
@endif
<script>
    $(function () {
            $("#usertable").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
    });
</script>
<script type='text/javascript'>
function preview_image(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_image');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
<script type='text/javascript'>
function preview_photo(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output_photo');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>

<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#profile-img-tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#profile-img").change(function(){
            readURL(this);
        });
</script>
<script type=text/javascript>
  $('#country').change(function(){
  var countryID = $(this).val();
  
  if(countryID){
      var url = "{{url('admin/get-state-list')}}"+"/"+countryID;
    $.ajax({
      type:"GET",
      url:url,
      data : {"_token":"{{ csrf_token() }}"},
      dataType: "json",
      success:function(res){        
      if(res){
        $("#state").empty();
        $("#state").append('<option value="">Select</option>');
        $.each(res,function(key,value){
          $("#state").append('<option value="'+value.id+'">'+value.title+'</option>');
        });
      
      }else{
        $("#state").empty();
      }
      }
    });
  }else{
    $("#state").empty();
    $("#city").empty();
  }   
  });
  $('#state').on('change',function(){
  var stateID = $(this).val();
  console.log(stateID);
  if(stateID){
    $.ajax({
      type:"GET",
      url:'/get-city-list/'+stateID,
      success:function(res){        
      if(res){
        $("#city").empty();
        $.each(res,function(key,value){
          $("#city").append('<option value="'+value.id+'">'+value.title+'</option>');
        });
      
      }else{
        $("#city").empty();
      }
      }
    });
  }else{
    $("#city").empty();
  }
    
  });
</script>
<script type=text/javascript>
  $('.cat_id').change(function(){
  var countryID = $(this).val();
  if(countryID){
       var id = $(this).find('option:selected').attr('data-id');
       alert(id);
      var url = "{{url('admin/get-state-list/')}}"+"/"+countryID;
    $.ajax({
      type:"GET",
      url:url,
      data : {"_token":"{{ csrf_token() }}"},
      dataType: "json",
      success:function(res){  
          console.log(res);
      if(res){
        $(".subcategory_id_"+id).empty();
        $(".subcategory_id+"+id).append('<option>Select</option>');
        $.each(res,function(key,value){
          $(".subcategory_id_"+id).append('<option value="'+value.id+'">'+value.title+'</option>');
        });
      
      }else{
        $(".subcategory_id_"+id).empty();
      }
      }
    });
  }else{
    $(".subcategory_id_"+id).empty();
    $("#childcategory_id").empty();
  }   
  });
  $('#subcategory_id').on('change',function(){
  var stateID = $(this).val();
  console.log(stateID);
  if(stateID){
    $.ajax({
      type:"GET",
      url:'/get-city-list/'+stateID,
      success:function(res){        
      if(res){
        $("#childcategory_id").empty();
        $.each(res,function(key,value){
          $("#childcategory_id").append('<option value="'+value.id+'">'+value.title+'</option>');
        });
      
      }else{
        $("#childcategory_id").empty();
      }
      }
    });
  }else{
    $("#childcategory_id").empty();
  }
    
  });
</script>
<script type="text/javascript">
	
	$(document).ready(function() { 
		$("#category").select2({
			placeholder:"search here",
			allowClear:true,
		}); 
	});
</script>
<script type="text/javascript">
	
	$(document).ready(function() { 
		$("#subcategory").select2({
			placeholder:"search here",
			allowClear:true,
		}); 
	});
</script>
<script type="text/javascript">
	
	$(document).ready(function() { 
		$("#childcategory").select2({
			placeholder:"search here",
			allowClear:true,
		}); 
	});
</script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
 <script type="text/javascript">
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 250,
            });
        });

    </script>
     <script type="text/javascript">
        $(document).ready(function () {
            $('.summernotetwo').summernote({
                height: 250,
            });
        });

    </script>
@endsection
