<?php
 // Get active packages
    public function getTravellers($packageInvoiceId)
    {
        $myPackageTravellers = Traveller::where('invoice_id', $packageInvoiceId)
            ->where('patient_id', auth('patient')->id())->get();

        $myPackageDetails = BuyPackage::where('invoice_id', $packageInvoiceId)
            ->where('patient_id', auth('patient')->id())->first();

        if ($myPackageDetails != null) {
            $packageStartDate = Carbon::parse($myPackageDetails->package_start_date)->format('d F, Y');
            $packageExpiredDate = Carbon::parse($myPackageDetails->package_start_date)->addDays(30)->format('d F, Y');
        }

        return response()->json(['packageTravellers' => $myPackageTravellers, 'packageDetails' =>$myPackageDetails, 'packageStartDate' => $packageStartDate, 'packageExpiredDate' =>$packageExpiredDate], 200);
    }


///view

<script>
        // disease type wise show
        $('#myActivePackages').change(function(){
            var packageInvoiceId = $(this).val();

            if(packageInvoiceId){
                $.ajax({
                type:"GET",
                url:"{{url('get-package-travellers') }}"+"/"+packageInvoiceId,
                data : {"_token":"{{ csrf_token() }}"},
                dataType: "json",
                success:function(res){
                    console.log(res);
                if(res){
                    //Traveller Info
                    $("#traveller_id").empty();
                    $("#traveller_id").append('<option value=""> Select a traveller </option>');
                    $.each(res.packageTravellers, function(key, value){
                        $("#traveller_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                    // package info
                    $("#selectedPackageInfo").empty();
                    $("#selectedPackageInfo").append('<p> <i class="fas fa-genderless"></i> Active Package : <span>'+res.packageDetails.package_type+'</span></p>');
                    $("#selectedPackageInfo").append('<p> <i class="fas fa-genderless"></i> Package Coverage: <span> '+res.packageDetails.package_coverage+'</span></p>');
                    $("#selectedPackageInfo").append('<p> <i class="fas fa-genderless"></i> Package Start Date : <span> '+res.packageStartDate+'</span></p>');
                    $("#selectedPackageInfo").append('<p> <i class="fas fa-genderless"></i> Package Expired Date : <span> '+res.packageExpiredDate+'</span></p>');
                }else{
                    $("#traveller_id").empty();
                }
                }
                });
            }else{
                $("#traveller_id").empty();
                $("#traveller_id").append('<option value=""> Select a traveller</option>');

            }
        });
    </script>