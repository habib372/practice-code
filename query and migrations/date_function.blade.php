public function sponsorshipApply()
{

    $sponsorshipData = Sponsorship::with(['district', 'country', 'patient', 'disease', 'stage'])->where('patient_id', auth('patient')->id())->latest()->first();
    $daysDifference = $this->calculateDaysDifference ($sponsorshipData->created_at);

    return view('frontend.patient.sponsorship_form', compact('sponsorshipData', 'daysDifference'))
}


<!-- date to number convert -->
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

<!--output:-->
<!-- 2023-11-01 - 2023-11-05 = 4 -->




<!-- convert number to next 1 year -->
<?php
    $currentDateTime = new DateTime();
    $nextYearDateTime = $currentDateTime->add(new DateInterval('P1Y'));

    echo 'Today: ' . $currentDateTime->format('Y-m-d H:i:s') . PHP_EOL;
    echo 'Next year: ' . $nextYearDateTime->format('Y-m-d H:i:s') . PHP_EOL;
?>


<!-- convert number to next months -->
<?php
    $numberOfMonths = 3; // Change this to your desired number of months

    $currentDateTime = new DateTime();
    $nextDateTime = $currentDateTime->add(new DateInterval("P{$numberOfMonths}M"));

    echo 'Current date and time: ' . $currentDateTime->format('Y-m-d H:i:s') . PHP_EOL;
    echo "Next {$numberOfMonths} months: " . $nextDateTime->format('Y-m-d H:i:s') . PHP_EOL;
?>


<?php

    $membership_payment_data = App\Models\MembershipPayment::with('membership')->where('patient_id', auth('patient')->id())->where('status', 'Processing')->orderBy('id', 'DESC')->first();

    $numberOfMonths = $membership_payment_data->duration ; // Change this to your desired number of months

    $currentDateTime = new DateTime();

    $nextDateTime = $currentDateTime->add(new DateInterval("P{$numberOfMonths}M"));
    $expire_date = $nextDateTime->format('Y-m-d H:i:s');

    echo "Next {$numberOfMonths} months: " . $expire_date;

?>

{{-- number to month conversion --}}
@if(auth('patient')->check())
    @php
        $membership_payment_data = App\Models\MembershipPayment::with('membership')
            ->where('patient_id', auth('patient')->id())
            ->where('status', 'Processing')
            ->orderBy('id', 'DESC')
            ->first();

        $numberOfMonths = $membership_payment_data->duration;
        $apply_dateTime = \Carbon\Carbon::parse($membership_payment_data->apply_date);
        $expire_date = $apply_dateTime->addMonths($numberOfMonths)->format('Y-m-d H:i:s');

        $currentDateTime = new \DateTime();
        $todayDateTime = $currentDateTime->format('Y-m-d H:i:s');

        if ($todayDateTime < $expire_date) {
            $icon = $membership_payment_data->membership->icon;
            $membership_type = $membership_payment_data->membership_type;
        } else {
            $icon = 'fa fa-user';
            $membership_type = 'Free';
        }

    @endphp
@endif
