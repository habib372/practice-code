@extends('admin.layouts.app')
@section('page_title', 'Create New Service Provider')

@section('content')
	<div class="m-content">
		<div class="row">
			<div class="col-md-11">
				<!--begin::Portlet-->
				<div class="m-portlet m-portlet--tab">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<span class="m-portlet__head-icon m--hide">
									<i class="la la-gear"></i>
								</span>
								<h3 class="m-portlet__head-text">
									Create New Service Provider
								</h3>
							</div>
						</div>
					</div>
                    <!--begin::Form-->
					<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" action="" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="m-portlet__body">
							<div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label for="name_en">Service Provider Name (English) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input{{ $errors->has('name_en')? ' border-danger' : '' }}" name="name_en" id="name_en" aria-describedby="name_en" value="{{ old('name_en') }}" placeholder="Enter name in english">
                                    @error('name_en')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="name_bn">Service Provider Name  (Bangla) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control m-input{{ $errors->has('name_bn')? ' border-danger' : '' }}" name="name_bn" id="name_bn" aria-describedby="name_bn" value="{{ old('name_bn') }}" placeholder="Enter name in bangla">
                                    @error('name_bn')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label for="description_en">Description (English) <span class="text-danger">*</span></label>
                                    <textarea name="description_en" class="form-control m-input summernote" id="description_en" rows="3">{{ old('description_en') }}</textarea>
                                    @error('description_en')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="description_bn">Description (Bangla) <span class="text-danger">*</span></label>
                                    <textarea name="description_bn" class="form-control m-input summernote" id="description_bn" rows="3">{{ old('description_bn') }}</textarea>
                                    @error('description_bn')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group m-form__group row">
                                <div class="col-lg-6">
                                    <label for="featured">Featured</label>
                                    {!! Form::select('featured', ['yes'=>'Yes', 'no'=>'No'], 'no', ['class' => 'form-control', 'id' => 'featured', 'placeholder' => 'Seelect One']) !!}
                                    @error('featured')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6">
                                    <label for="order">Order </label>
                                    <input type="number" class="form-control m-input{{ $errors->has('order')? ' border-danger' : '' }}" name="order" id="order" min="1" value="{{ old('order')??1 }}" placeholder="Enter Appearance Order">
                                    @error('order')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

							<div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    {!! Form::select('status', ['active'=>'Active', 'inactive'=>'Inactive'], 'active', ['class' => 'form-control', 'id' => 'status', 'placeholder' => 'Select status']) !!}
                                    @error('status')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label for="icon">Fontawesome Icon (code)</label>
                                    <input type="text" class="form-control m-input{{ $errors->has('icon')? ' border-danger' : '' }}" name="icon" id="icon" value="{{ old('icon')??'fa fa-hospital-o' }}" placeholder="Enter fontawesome icon code">
                                    @error('icon')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label for="logo">Service Provider Logo</label>
                                    <input type="file" class="form-control-file m-input{{ $errors->has('logo')? ' border-danger' : '' }}" id="logo" name="logo" value="">
                                    @error('logo')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
							</div>
						</div>
						<div class="m-portlet__foot m-portlet__foot--fit">
							<div class="m-form__actions">
								<button type="submit" class="btn btn-primary">
									Submit
								</button>
								<a href="{{ route('tsr-admin.service-provider.index') }}" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
					</form>
					<!--end::Form-->
				</div>
				<!--end::Portlet-->
			</div>
		</div>
	</div>

    @section('scripts')
    <script>
    	 $('div.note-editable').height(200);
    </script>
	@stop

@endsection
