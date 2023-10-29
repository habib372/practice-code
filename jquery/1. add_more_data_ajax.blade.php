 <div class="col-md-11 m-upload">
     <!--Ajax Content will load here-->
     <label for="visit_reason">Medical Attachments <small>(Max file size: 10MB; Allowed type: pdf, image)</small></label>
     <div class="row mb-2">
         <div class="col-md-5"><strong>Attachment Title</strong></div>
         <div class="col-md-4"><strong>Attachments file</strong></div>
     </div>
     @for($i=0; $i<1; $i++)
     <div class="row  mb-2" id="attachmentsHolder">
         <div class="col-md-5">
             <input type="text" class="form-control m-input" name="attachs[{{$i}}][title]" id="title_{{$i}}">
         </div>
         <div class="col-md-4">
             <input type="file" class="form-control m-input file_upload" name="attachs[{{$i}}][file]" id="files_{{$i}}">
         </div>
         @if($i==0)
         <div class="col-md-3">
             <a href="javascript:void(0)" id="addMoreAttach" class="btn m_btn-custom">
                 <span>
                     <i class="fa fa-plus"></i>
                     <span>Add More</span>
                 </span>
             </a>
         </div>
         @endif
    </div>
    @endfor
 </div>


<script>

    var attachIndex = 1;
        $('body').on('click', '#addMoreAttach', function () {
            $('#addMoreAttach').remove();

            var html = '<div id="attribute-' + attachIndex + '" class="row mb-2">' +
                '<div class="col-md-5">' +
                '<input type="text" class="form-control m-input" name="attachs[' + attachIndex + '][title]" id="title_' + attachIndex + '">' +
                '</div>' +
                '<div class="col-md-4">' +
                '<input type="file" class="form-control m-input file_upload" name="attachs[' + attachIndex + '][file]" id="files_' + attachIndex + '">' +
                '</div>' +

                '<div class="col-md-3">' +
                '<a id="addMoreAttach" href="javascript:void(0)" class="btn m_btn-custom">' +
                '<span>' +
                '<i class="fa fa-plus"></i>' +
                '<span>Add More</span>' +
                '</span>' +
                '</a>' +
                '</div>' +
                '</div>';
            attachIndex++;

            $('#attachmentsHolder').append(html);
        });
</script>