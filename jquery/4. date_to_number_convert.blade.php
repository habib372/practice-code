<?php

public function sponsorshipApply()
{
    $sponsorshipData = Sponsorship::with(['district', 'country', 'patient', 'disease', 'stage'])->where('patient_id', auth('patient')->id())->latest()->first();
    $daysDifference = $this->calculateDaysDifference($sponsorshipData->created_at);
    $verification = SponsorshipVerify::where('sponsorship_id', $sponsorshipData->id)->first();

    return view('frontend.patient.sponsorship_form', compact('sponsorshipData', 'verification', 'daysDifference'));
}

// 2023-10-25 - 2023-10-27 = 2
function calculateDaysDifference($specifiedDate)
{
    // Convert the specified date to a Carbon instance
    $specifiedDate = Carbon::parse($specifiedDate);

    // Get today's date as a Carbon instance
    $todayDate = now();

    // Calculate the number of days
    $daysDifference = $specifiedDate->diffInDays($todayDate);

    return $daysDifference;
}



// next 30 days data = 2024-05-10
$nextDate = date('Y-m-d', strtotime('+30 days'));

// previous 30 days data = 2024-04-10
$previousDate = date('Y-m-d', strtotime('-30 days'));

// Get today's date as a Carbon instance
 $todayDate = now();



 // Date to age convert
public static function calculateAgeToday($date){

    //Take patient's dob and return age today
    if(empty($date)){
        return '';
    }

    $datetime1 = new DateTime($date);
    $datetime2 = new DateTime(date('Y-m-d'));
    $interval = $datetime1->diff($datetime2);

    return $interval->format('%yY %mM');

}


if (auth('doctor')->check() && $row->doctor_id == auth('doctor')->id()) {
                    $createTime = strtotime($row->created_at);
                    $now = strtotime(date('Y-m-d H:i:s'));
                    $timeDiff = round(abs($now - $createTime) / (60 * 60));
                    if ($timeDiff <= 6) {
                        $html .= '<a href="' . url("doctor/appointments/visit") . '/' . $row->appointment_id . '" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit Session"><i class="fa fa-stethoscope"></i></a>';
                    }
                }




 @php
    $buyPackage  = App\Models\BuyPackage::where('patient_id', auth('patient')->id())->latest()->first();
    $expiredDate  = date($buyPackage->created_at, strtotime('+30 days'));
    $buyPackageExpired  = App\Models\BuyPackage::where('patient_id', auth('patient')->id())->where('created_at', '<', now())->latest()->first()->count();
    $travellers  = App\Models\Traveller::where('patient_id', auth('patient')->id())->where('invoice_id',  $buyPackage->invoice_id)->count();
@endphp

{{ $buyPackageExpired  }}