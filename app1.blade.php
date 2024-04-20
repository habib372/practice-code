<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get package coverage radio buttons
        var packageCoverageRadios = document.querySelectorAll('input[name="package_coverage"]');

        // Function to update $count variable and show/hide traveller sections
        function updateCountAndSections() {
            var selectedCoverage = document.querySelector('input[name="package_coverage"]:checked').value;
            var adultCount = parseInt(document.getElementById('adult').value);
            var kidCount = parseInt(document.getElementById('kid').value);
            var totalCount = 0;

            if (selectedCoverage === 'only-me' || selectedCoverage === 'family') {
                totalCount = 1;
            } else if (selectedCoverage === 'others') {
                totalCount = adultCount + kidCount;
            }

            // Update the value of $count variable
            <?php $count = "<script>document.write(totalCount);</script>" ?>

            // Show/hide traveller sections based on $count
            var travellerSections = document.querySelectorAll('.traveller');
            travellerSections.forEach(function(section, index) {
                if (index < totalCount) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        }

        // Add event listener to package coverage radio buttons
        packageCoverageRadios.forEach(function(radio) {
            radio.addEventListener('change', updateCountAndSections);
        });

        // Initial call to update traveller sections based on initial radio button selection
        updateCountAndSections();
    });
</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to update $count variable and show/hide traveller sections
        function updateCountAndSections() {
            var selectedCoverage = $('input[name="package_coverage"]:checked').val();
            var adultCount = parseInt($('#adult').val());
            var kidCount = parseInt($('#kid').val());
            var totalCount = 0;

            if (selectedCoverage === 'only-me') {
                totalCount = 1;
            } else if (selectedCoverage === 'family') {
                totalCount = 4;
            } else if(selectedCoverage === 'others'){
                totalCount = adultCount + kidCount;
            }

            // Update the value of $count variable
            <?php $count = "<script>document.write(totalCount);</script>" ?>

            // Show/hide traveller sections based on $count
            $('.traveller').each(function(index) {
                if (index < totalCount) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Add event listener to package coverage radio buttons
        $('input[name="package_coverage"]').change(updateCountAndSections);

        // Initial call to update traveller sections based on initial radio button selection
        updateCountAndSections();
    });
</script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to update $count variable and show/hide traveller sections
        function updateCountAndSections() {
            var selectedCoverage = $('input[name="package_coverage"]:checked').val();
            var adultCount = parseInt($('#adult').val());
            var kidCount = parseInt($('#kid').val());
            var totalCount = 0;

            if (selectedCoverage === 'only-me') {
                totalCount = 1;
            } else if (selectedCoverage === 'family') {
                totalCount = 4;
            } else if(selectedCoverage === 'others'){
                totalCount = adultCount + kidCount;
            }

            // Update the value of $count variable directly in JavaScript
            var countInput = $('<input>').attr('type', 'hidden').attr('name', 'count').val(totalCount);
            $('form').append(countInput);

            // Show/hide traveller sections based on $count
            $('.traveller').each(function(index) {
                if (index < totalCount) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Add event listener to package coverage radio buttons
        $('input[name="package_coverage"]').change(updateCountAndSections);

        // Initial call to update traveller sections based on initial radio button selection
        updateCountAndSections();
    });
</script>
