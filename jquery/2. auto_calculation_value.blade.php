
<!DOCTYPE html>
<html>
<head>
    <title>Donation Calculation</title>
    <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="patient_info">
        <div class="form-group m-form__group ">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <label for="TotalTreatmentCost">
                        Total Cost For Treatment <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control m-input" name="total_treatment_cost" id="TotalTreatmentCost" aria-describedby="total_treatment_cost" placeholder="" value="{{ old('total_treatment_cost') }}">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="YourContribution">
                        Your Contribution (You have) <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control m-input" name="your_contribution" id="YourContribution" aria-describedby="your_contribution" placeholder="" value="{{ old('your_contribution') }}">
                </div>
                <div class="col-md-4 col-sm-12">
                    <label for="donationRequest">
                        Donation Requested <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control m-input" name="donation_request" id="donationRequest" aria-describedby="donation_request" readonly="" placeholder="" value="{{ old('donation_request') }}">
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery code to calculate and update Donation Request -->
    <script>
    $(document).ready(function() {
        // Function to calculate and update the donation request
        function updateDonationRequest() {
            var totalCost = parseFloat($("#TotalTreatmentCost").val()) || 0;
            var yourContribution = parseFloat($("#YourContribution").val()) || 0;
            var donationRequest = totalCost - yourContribution;

            // Update the Donation Request field
            $("#donationRequest").val(donationRequest);
        }

        // Attach the event listener to TotalTreatmentCost and YourContribution
        $("#TotalTreatmentCost, #YourContribution").on("input", function() {
            updateDonationRequest();
        });

        // Initial calculation
        updateDonationRequest();
    });
    </script>
</body>
</html>
