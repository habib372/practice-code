<div class="col-lg-6">
    <label for="service_provider_type_id"> Service Provider <span class="text-danger">*</span></label>
    {!! Form::select('service_provider_type_id', $serviceProviderTypes, old('service_provider_type_id') ?? $user->service_provider_type_id, ['class' => 'form-control m-input m-select2 m_select2_1', 'id' => 'service_provider_type_id', 'readonly' => 'readonly', 'style' => 'width:100%;']) !!}
    @error('service_provider_type_id')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>