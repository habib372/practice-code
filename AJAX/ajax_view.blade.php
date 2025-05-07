    <script>
        $('#patient_id').change(function(){
                var patientID = $(this).val();
                if(patientID){
                    $.ajax({
                        type:"GET",
                        url:'/tsr-admin/get-patient-data/'+patientID,
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success: function(res) {
                             console.log(res);
                            if (res) {
                                $("#name").val(res.name);
                                $("#email").val(res.email);
                                $("#phone").val(res.mobile);
                                $("#address").val(res.address);
                                $("#country_id").val(res.country_id).trigger('change'); // Assuming this is a select2 field
                                $("#district_id").val(res.district_id).trigger('change'); // Assuming this is a select2 field
                            } else {
                                $("#name").val('');
                                $("#email").val('');
                                $("#phone").val('');
                                $("#address").val('');
                                $("#country_id").val('').trigger('change'); // Assuming this is a select2 field
                                $("#district_id").val('').trigger('change'); // Assuming this is a select2 field
                            }
                        }
                    });
                } else {
                    // Reset all fields if no patient is selected
                    $("#name").val('');
                    $("#email").val('');
                    $("#phone").val('');
                    $("#address").val('');
                    $("#country_id").val('').trigger('change'); // Assuming this is a select2 field
                    $("#district_id").val('').trigger('change'); // Assuming this is a select2 field
                }
            });
        </script>

        <!--find Membership ajax -->
        <script type="text/javascript">
            $('#membership_id').change(function(){
                var membershipID = $(this).val();
                if(membershipID){
                    $.ajax({
                        type:"GET",
                        url:'/tsr-admin/get-memberhip-data/'+membershipID,
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success: function(res) {
                             console.log(res);
                            if (res) {
                                $("#membership_type").val(res.name_en);
                                $("#amount").val(res.membership_fee_en);
                                $("#duration").val(res.duration_en);
                            } else {
                                $("#membership_type").val('');
                                $("#amount").val('');
                                $("#duration").val('');
                            }
                        }
                    });
                } else {
                    // Reset all fields if no patient is selected
                    $("#membership_type").val('');
                    $("#amount").val('');
                    $("#duration").val('');
                }
            });
        </script>
