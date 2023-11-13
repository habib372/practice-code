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