
<input type="hidden" name="package_type" value="{{ $selectedPackage->package_name }}" >

<script>
$(document).ready(function () {
            function handlePackageTypeChange() {
            var type = $('input[name=package_type]').val();

                if (type === 'On-Demand') {
                    $('#family').prop('checked', false).prop('disabled', true);
                    $('#others').prop('checked', false).prop('disabled', true);
                    $('#adult').val(0).prop('disabled', true);
                    $('#kid').val(0).prop('disabled', true);
                    $('#onlyme').prop('checked', false);
                } else {
                    $('#family').prop('disabled', false);
                    $('#others').prop('disabled', false);
                }
            }

            $('input[name=package_type]').change(handlePackageTypeChange);

            handlePackageTypeChange();
        });
</script>