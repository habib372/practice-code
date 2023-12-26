{{$blog->created_at->format('d M Y')}}

{{ $data->created_at->format('j F, Y') }} <!---20 Feb, 2023--->

$temp['date'] = \Carbon\Carbon::parse($item->visit_date)->format('j F, y'); //21 September, 23
$temp['date'] = \Carbon\Carbon::parse($item->visit_date)->format('j M, y'); //21 Sept, 23

<td>Trans Date: {{$invoice->created_at->toFormattedDateString()}} ({{$invoice->created_at->diffForHumans()}})</td> <!---20 Feb, 2023 (3 hours from now )--->


<!--*** date time format ***-->

<!-- Updated by: Habibur Rahman  -->
<strong>Last Updated By</strong> : {{ $user->updatedBy->name??'' }}<br />

<strong>Last updated on</strong> : {{ date("h:i A \o\\n d F Y", strtotime($user->updated_at)) }}
<!-- Last Updated On: 06:20 PM on 11 September 2023  -->

<p>Date : {{date("jS M, Y", strtotime($lastVisit->visit_date))}}</p>
<!-- Date : 4th Oct, 2023 -->

{{ date('Y-m-d h:i A', strtotime($appointment->appointment_start_time)) }}
<!-- 2023-10-15 07:00 PM -->


<!--** number format **-->
{{ number_format($data->total_treatment_cost, 0, '.', ',') ?? '' }}
<!-- 00,000,000 -->

<strong>Total Estimate Cost of Treatment: </strong>: <br />
{{ formatNumber($data->total_treatment_cost) ?? '' }}


<!--  app/helpers.php -->
if (!function_exists('formatNumber')) {
function formatNumber($number) {
return number_format($number, 0, '.', ',');
}
}

<!-- composer.json -->
"autoload": {
"files": ["app/helpers.php"]
}

convert 2023-11-01 - today date = number


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



public function sponsorshipApply()
{
$sponsorshipData = Sponsorship::with(['district', 'country', 'patient', 'disease', 'stage'])->where('patient_id', auth('patient')->id())->latest()->first();
$daysDifference = $this->calculateDaysDifference($sponsorshipData->created_at);
$verification = SponsorshipVerify::where('sponsorship_id', $sponsorshipData->id)->first();

return view('frontend.patient.sponsorship_form', compact('sponsorshipData', 'verification', 'daysDifference'));
}


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


    {{ $daysDifference > 7 ? 'is-active' : 'done' }}
