

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

<!-- type 1 -->
<script>
    $(document).on('change', '#user_role_id' , function(){
        var user_role = $("#user_role_id").val();

        if(user_role==2 || user_role==3 || user_role==7)
        {
            $('#show_service_provider').show('slow');
        }else{
            $('#show_service_provider').hide('slow');
        }
    });
</script>



<!-- when select user role in [4, 5, 6, 8], then show only service_provider_type_id otherwise show all -->
<script>
    $(document).on('change', '#user_role_id', function() {
        $('#show_service_provider_type, #show_service_provider').hide('slow').find('select').val(null);
        var user_role = $("#user_role_id").val();
        var superRoles = [4, 5, 6, 8];
        var generalRoles = [2, 3, 7];

        if (user_role !== '') {
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

            // Clear selected values
            $("#service_provider_type_id").val('');
            $("#service_provider_id").val('');

            if (user_role === '1') {
                $('#show_service_provider_type').hide('slow');
                $('#show_service_provider').hide('slow');
            } else if (user_role !== '' || service_provider_type !== '') {
                $('#show_service_provider_type').show('slow');
                    if ((service_provider_type) && (generalRoles.includes(parseInt(user_role)))) {
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


    {{-- when value change, all value must null --}}
        <script>
            $(document).on('change', '#payment_mode', function(){
                var paymentMode = $("#payment_mode").val();

                // Set values to null when hiding
                if(paymentMode != 'bkash' && paymentMode != 'rocket' && paymentMode != 'nagad' && paymentMode != 'credit-card') {
                    $('#transactionId').hide('slow').find('input').val(null);
                }
                if(paymentMode != 'bank-account') {
                    $('#account_holder_name').hide('slow').find('input').val(null);
                    $('#bank_account_info').hide('slow').find('input').val(null);
                }

                // Show or hide based on the selected payment mode
                if(paymentMode == 'bkash' || paymentMode == 'rocket' || paymentMode == 'nagad' || paymentMode == 'credit-card') {
                    $('#transactionId').show('slow');
                } else if(paymentMode == 'bank-account') {
                    $('#account_holder_name').show('slow');
                    $('#bank_account_info').show('slow');
                }
            });
        </script>

        {{-- or --}}
        <script>
            $(document).on('change', '#payment_mode', function(){
                // Hide all sections and set input values to null
                $('#transactionId, #account_holder_name, #bank_account_info').hide('slow').find('input').val(null);

                // Show the relevant section based on the selected payment mode
                var paymentMode = $("#payment_mode").val();
                if(paymentMode == 'bkash' || paymentMode == 'rocket' || paymentMode == 'nagad' || paymentMode == 'credit-card') {
                    $('#transactionId').show('slow');
                } else if(paymentMode == 'bank-account') {
                    $('#account_holder_name, #bank_account_info').show('slow');
                }
            });
        </script>