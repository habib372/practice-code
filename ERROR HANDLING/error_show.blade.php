<!-- error handling -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 error-message">
                @if (session('success'))
                <div id="success-alert" class="alert alert-success alert-dismissible fade show m-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></button>
                    {{session('success')}}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-error alert-danger alert-dismissible fade show m-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fa fa-close"></i></button>
                    <strong>Whoops!</strong> There were some problems with your input. Please Check all fields.
                </div>
                @endif
            </div>
        </div>
    </div>