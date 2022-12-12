<form action="{{ @$data ? route('basicinfo.update', $data->id) : route('basicinfo.add') }}" method="POST">
    @if (@$data)
    @csrf
    @method('PUT')
    @else
    @csrf
    @endif
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="form-group">
                <label>Full Name</label>

                <input type="text" name="fullname" class="form-control" id="fullname" value="{{ auth::user()->name}}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your Name'">
                @if ($errors->has('fullname'))
                <span class="text-danger">{{ $errors->first('fullname') }}</span>
                @endif
            </div>
        </div>
    </div>
</form>