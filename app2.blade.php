<script>

$(document).ready(function() {

    function buyPackageCountTraveller() {
        var selectedCoverage = $('input[name="package_coverage"]:checked').val();
        var adultCount = parseInt($('#adult').val());
        var kidCount = parseInt($('#kid').val());
        var travellerNumber = 1;
        var patientId = {{ auth('patient')->id() }};
        var countries = @json($countries);

        
        for (let indexNumber = 0; indexNumber < totalTraveller; indexNumber++) {

            var randUser = 'traveller@'+patientId+ Math.floor(Math.random() * (999999 - 111111 + 1));

            var html ='<div  id="traveller-'+indexNumber +'" class="traveller_info">'+
                        '<h5>Traveller (' + travellerNumber++ + ') : <span class="text-danger">*</span></h5>'+
                        '<div class="row g-2">'+
                            '<div class="col-md-6 col-12">'+
                                '<label for="name" class="form-label">Name <span class="text-danger">*</span></label>'+
                                '<input type="text" name="traveller[' + indexNumber + '][name]" class="form-control" placeholder="" aria-label="name" value="{{ old("traveller[' + indexNumber + '][name]") }}" required>'+
                                '@error('name')'+
                                '<span class="small text-danger">{{$message}}</span>'+
                                '@enderror'+
                            '</div>'+
                          
                            '<div class="col-md-6 col-12">'+
                                '<label for="phone" class="form-label">Country <span class="text-danger">*</span></label>'+
                                '<select name="traveller[' + indexNumber + '][country]" id="country" class="form-select" aria-label="form-select-sm example" required >'+
                                    $.each(countries, function(index, country) {
                                                '<option value="' + country + '">' + country + '</option>';
                                            });
                                '</select>'+
                            '</div>'+
                        '</div>'+
                    '</div>';

            $('#addMoreTravellerForm').append(html);

            initializeDatepicker();
        }
    }
     $('input[name="package_coverage"]').change(buyPackageCountTraveller);
    $('#adult, #kid').change(buyPackageCountTraveller);

});

</script>