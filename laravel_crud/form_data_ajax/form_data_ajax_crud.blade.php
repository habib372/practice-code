Route::post('/patient/updateProfile', 'PatientController@updateProfile');

<form class="form" id="profileUpdateForm" enctype="multipart/form-data">
    <!-- Your form fields -->
</form>

<script>
    $(document).ready(function() {

        // My Profile update
        $("#profileUpdateForm").submit(function(e) {
            e.preventDefault(); // Prevent the default form submission
            var form = $(this);
            var data = new FormData(this);

            $("#profileUpdate").attr("disabled", "disabled");

            $.ajax({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                type: "POST",
                url: '/patient/updateProfile',
                dataType: 'json',
                processData: false, // Do not process the data
                contentType: false, // Set content type to false
                data: data, // Send the form data as FormData
                success: function(response) {
                    window.location = "{{ url('/patient/dashboard') }}";
                },
                error: function(data) {
                    $("#profileUpdate").removeAttr('disabled');

                    $('.invalid-response').text('');
                    var errors = data.responseJSON.errors;
                    $.each(errors, function(index, value) {
                        $('#invalid-' + index).text(value[0]);
                    });
                }
            });
        });

    });
</script>
