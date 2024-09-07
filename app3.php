@extends('admin.layouts.app')
@section('page_title', 'Create New Content')

@section('content')
<div class="m-content">
    <div class="row">
        <div class="col-md-12">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Create New Content
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" action="{{ route('tsr-admin.content.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!---- content Section---->
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label for="content_category_id">Select Content Category</label>
                                {!! Form::select('content_category_id', $categories, null, ['class' => 'form-control m-select2 m_select2_1', 'id' => 'content_category_id', 'placeholder' => 'Select Content Category']) !!}
                                @error('content_category_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <div class="col-lg-6">
                                <label for="title_en">Content Title (English) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control m-input{{ $errors->has('title_en')? ' border-danger' : '' }}" name="title_en" id="title_en" aria-describedby="title_en" value="{{ old('title_en') }}" placeholder="Enter title in english">
                                @error('title_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="title_bn">Content Title (Bangla) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control m-input{{ $errors->has('title_bn')? ' border-danger' : '' }}" name="title_bn" id="title_bn" aria-describedby="title_bn" value="{{ old('title_bn') }}" placeholder="Enter title in bangla">
                                @error('title_bn')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-12 col-12 mb-4">
                                <label for="description_en">Description (English)<span class="text-danger">*</span></label>
                                <textarea name="description_en" class="form-control m-input tinymce_editor" id="description_en" rows="5">{{ old('description_en') }}</textarea>
                            </div>
                            <div class="col-lg-12 col-12 mb-4">
                                <label for="description_bn">Description (Bangla)<span class="text-danger">*</span></label>
                                <textarea name="description_bn" class="form-control m-input tinymce_editor" id="description_bn" rows="5">{{ old('description_bn') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group m-form__group row">
                            <div class="col-lg-3">
                                <label for="image_en">Image (English)</label>
                                <input type="file" class="form-control-file m-input{{ $errors->has('image_en')? ' border-danger' : '' }}" id="image_en" name="image_en" value="">
                                @error('image_en')
                                <span class="file-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <img src="" alt="" width="150" id="output_image_en">
                            </div>

                            <div class="col-lg-3">
                                <label for="image_bn">Image (Bangla)</label>
                                <input type="file" class="form-control-file m-input{{ $errors->has('image_bn')? ' border-danger' : '' }}" id="image_bn" name="image_bn" value="">
                                @error('image_bn')
                                <span class="file-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <img src="" alt="" width="150" id="output_image_bn">
                            </div>
                        </div>

                        <!----content inner images----->
                        <div class="form-group m-form__group row mt-4">
                            <div class="col-lg-4">
                                <label for="innerImagesUpload">Content Inner Images (if needed) </label>
                                <input type="file" class="form-control-file m-input" id="innerImagesUpload" name="content_inner_images[]" multiple>
                            </div>
                            <div class="col-lg-8">
                                <label for="innerImagesPreview">Content Inner Images Links</label>
                                <textarea name="" class="form-control m-input" id="innerImagesPreview" rows="5"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                            <a href="{{ route('tsr-admin.content.index') }}" class="btn btn-secondary">Cancel</a>
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
{{-- <script>
    	 $('div.note-editable').height(300);
    </script> --}}

<!-- image preview -->
<script type="text/javascript">
    function readURL(input, target) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(target).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image_en").change(function() { // name = "image_en"
        readURL(this, '#output_image_en'); // id = "output_image_en"
    });

    $("#image_bn").change(function() { // name = "image_bn"
        readURL(this, '#output_image_bn'); // id = "output_image_bn"
    });
</script>

<script>
    $(document).ready(function() {
        $('#innerImagesUpload').on('change', function() {
            var files = $(this)[0].files;
            var formData = new FormData();

            for (var i = 0; i < files.length; i++) {
                formData.append('content_inner_images[]', files[i]);
            }

            formData.append('_token', '{{ csrf_token() }}'); // Add CSRF token

            $.ajax({
                url: "{{ url('tsr-admin/content/uploadContentInnerImg') }}", // Replace with your route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#innerImagesPreview').empty(); // Clear the preview area

                    // Append the uploaded images to the preview area
                    response.images.forEach(function(image) {
                        var imgElement = $('<img>').attr('src', image).attr('width', '100');
                        $('#innerImagesPreview').append(imgElement);
                    });
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

@stop


@endsection