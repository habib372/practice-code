

<!-- "user_role_id" ---->
<div class="col-lg-6">
    <label for="role">Role <span class="text-danger">*</span></label>
    {!! Form::select('user_role_id', $userRoles, null, ['class' => 'form-control m-select2 m_select2_1', 'id' => 'user_role_id']) !!}
    @error('user_role_id')
    <span class="text-danger">{{$message}}</span>
    @enderror
</div>

<!-- "service_provider_type_id" and "service_provider_id" -->
<div class="form-group m-form__group row" id="show_service_provider_type" style="display:none;">
    <div class="col-lg-6">
        <label for="service_provider_type_id"> Service Provider <span class="text-danger">*</span></label>
        {!! Form::select('service_provider_type_id', $serviceProviderTypes, null, ['class' => 'form-control m-input m-select2 m_select2_1', 'id' => 'service_provider_type_id', 'style' => 'width:100%;']) !!}
        @error('service_provider_type_id')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    <div class="col-lg-6" id="show_service_provider" style="display:none;">
        <label for="role"> Branch <span class="text-danger">*</span></label>
        {!! Form::select('service_provider_id', $serviceProviders, null, ['class' => 'form-control m-input m-select2 m_select2_1', 'id' => 'service_provider_id', 'style' => 'width:100%;']) !!}
        @error('service_provider_id')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<!--end-->


<!-- when select user role in [4, 5, 6, 8], then show only service_provider_type_id otherwise show all -->
<script>
    $(document).on('change', '#user_role_id', function() {
        var user_role = $("#user_role_id").val();
        var superRoles = [4, 5, 6, 8];
        var generalRoles = [2, 3, 7, 9, 10];

        if (!$.isEmptyObject(user_role)) {
            $('#show_service_provider_type').show('slow');
            if (generalRoles.includes(user_role)) {
                $('#show_service_provider').show('slow');
            } else {
                $('#show_service_provider').hide('slow');
            }
        } else {
            $('#show_service_provider_type').hide('slow');
            $('#show_service_provider').hide('slow');
        }
    });
</script>
<!--end-->


<!-- when select "user_role_id", then show only "service_provider_type_id", when select "service_provider_type_id" then show "show_service_provider" -->
<script>
    $(document).on('change', '#user_role_id, #service_provider_type_id', function() {
        var user_role = $("#user_role_id").val();
        var service_provider_type = $("#service_provider_type_id").val();
        var superRoles = [4, 5, 6, 8];
        var generalRoles = [2, 3, 7, 9, 10];

        if (!$.isEmptyObject(user_role) || !$.isEmptyObject(service_provider_type)) {
            $('#show_service_provider_type').show('slow');
            if (generalRoles.includes(parseInt(user_role))) {
                $('#show_service_provider').show('slow');
            } else {
                $('#show_service_provider').hide('slow');
            }
        } else {
            $('#show_service_provider_type').hide('slow');
            $('#show_service_provider').hide('slow');
        }
    });
</script>
<!--end-->


<!-- If user_role is not 1 and either user_role or service_provider_type is selected, show the appropriate elements-->
<script>
        $(document).on('change', '#user_role_id, #service_provider_type_id', function() {
            var user_role = $("#user_role_id").val();
            var service_provider_type = $("#service_provider_type_id").val();
            var superRoles = [4, 5, 6, 8];
            var generalRoles = [2, 3, 7, 9, 10];

            if (user_role === '1') {
                // If user_role is 1, hide all elements
                $('#show_service_provider_type').hide('slow');
                $('#show_service_provider').hide('slow');
            } else if (!$.isEmptyObject(user_role) || !$.isEmptyObject(service_provider_type)) {
                // If user_role is not 1 and either user_role or service_provider_type is selected, show the appropriate elements
                $('#show_service_provider_type').show('slow');
                if (generalRoles.includes(parseInt(user_role))) {
                    $('#show_service_provider').show('slow');
                } else {
                    $('#show_service_provider').hide('slow');
                }
            } else {
                // If neither user_role nor service_provider_type is selected, hide all elements
                $('#show_service_provider_type').hide('slow');
                $('#show_service_provider').hide('slow');
            }
        });

</script>
<!--end-->