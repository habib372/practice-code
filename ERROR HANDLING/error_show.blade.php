<div class="container">
    @if (session('success'))
        <div id="success-alert" class="alert alert-success text-center mb-0 mt-3" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            {{session('success')}}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error alert-danger text-center mb-0 mt-3" role="alert" id="danger-alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></button>
            <strong>Whoops!</strong> There were some problems with your input. Please Check all fields.
        </div>
    @endif
</div>