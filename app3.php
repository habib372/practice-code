<div class="form-group m-form__group m-attach">
    <div class="row">
        <div class="col-md-11" id="attachmentsHolder">
            <!-- Ajax Content will load here -->
            <label for="visit_reason">Medical Attachments <small>(Max file size: 10MB; Allowed type: pdf or scan image)</small> <span class="text-danger">*</span></label>
            <div class="row mb-2 attach_title">
                <div class="col-md-5">Attachment Title</div>
                <div class="col-md-4">Attachments file</div>
            </div>
            @for ($i = 0; $i < 1; $i++)
            <div class="row mb-2" id="attachmentsHolder{{$i}}">
                <div class="col-md-5">
                    <input type="text" class="form-control m-input" name="attachs[{{$i}}][title]" id="title_{{$i}}">
                </div>
                <div class="col-md-4">
                    <input type="file" class="form-control m-input file_upload" name="attachs[{{$i}}][file]" id="files_{{$i}}">
                </div>
                @if ($i == 0)
                <div class="col-md-3">
                    <a href="javascript:void(0)" id="addMoreAttach" class="m_btn-custom">
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
</div>
</div>