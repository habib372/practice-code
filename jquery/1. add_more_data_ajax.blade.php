 <div class="col-md-11 m-upload">
     <!--Ajax Content will load here-->
     <label for="visit_reason">Medical Attachments <small>(Max file size: 10MB; Allowed type: pdf, image)</small></label>
     <div class="row mb-2">
         <div class="col-md-5"><strong>Attachment Title</strong></div>
         <div class="col-md-4"><strong>Attachments file</strong></div>
     </div>
     @for($i=1; $i<2; $i++)
     <div class="row  mb-2" id="attachmentsHolder">
         <div class="col-md-5">
             <input type="text" class="form-control m-input" name="attachs[{{$i}}][title]" id="title_{{$i}}">
         </div>
         <div class="col-md-4">
             <input type="file" class="form-control m-input file_upload" name="attachs[{{$i}}][file]" id="files_{{$i}}">
         </div>
         @if($i==1)
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
        var attrIndex = 2;
        $('body').on('click', '#addMoreAttributes', function () {

            $('#addMoreAttributes').remove();

            var html = '<div id="attribute-'+attrIndex+'" class="row mb-2">'+
                    '<div class="col-md-5">'+
                        '<input type="text" class="form-control m-input" name="visit_attributes_name['+attrIndex+']" id="visit_attributes_name_'+attrIndex+'">'+
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<input type="text" class="form-control m-input file_upload" name="visit_attributes_value['+attrIndex+']" id="visit_attributes_value_'+attrIndex+'">'+
                    '</div>'+

                    '<div class="col-md-3">'+
                        '<a id="addMoreAttributes" href="javascript:void(0)" class="btn m_btn-custom">'+
                            '<span>'+
                                '<i class="fa fa-plus"></i>'+
                                '<span>Add More</span>'+
                            '</span>'+
                        '</a>'+
                    '</div>'+
                '</div>	';
            attrIndex++;

            $('#attributesHolder').append(html);
        });


        var attachIndex = 2;
        $('body').on('click', '#addMoreAttach', function () {

            $('#addMoreAttach').remove();

            var html = '<div id="attribute-'+attachIndex+'" class="row mb-2">'+
                    '<div class="col-md-5">'+
                        '<input type="text" class="form-control m-input" name="attachs['+attachIndex+'][title]" id="title_'+attrIndex+'">'+
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<input type="file" class="form-control m-input file_upload" name="attachs['+attachIndex+'][file]" id="files_'+attrIndex+'">'+
                    '</div>'+

                    '<div class="col-md-3">'+
                        '<a id="addMoreAttach" href="javascript:void(0)" class="btn m_btn-custom">'+
                            '<span>'+
                                '<i class="fa fa-plus"></i>'+
                                '<span>Add More</span>'+
                            '</span>'+
                        '</a>'+
                    '</div>'+
                '</div>	';
            attachIndex++;

            $('#attachmentsHolder').append(html);
        });
    </script>