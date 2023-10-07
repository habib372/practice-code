{{$blog->created_at->format('d M Y')}}

{{ $data->created_at->format('j F, Y') }} <!---20 Feb, 2023--->

$temp['date'] = \Carbon\Carbon::parse($item->visit_date)->format('j F, Y'); //21 September, 23
$temp['date'] = \Carbon\Carbon::parse($item->visit_date)->format('j M, Y'); //21 Sept, 23

<td>Trans Date: {{$invoice->created_at->toFormattedDateString()}} ({{$invoice->created_at->diffForHumans()}})</td> <!---20 Feb, 2023 (3 hours from now )--->


<!-- date time format -->

<!-- Updated by: Habibur Rahman  -->
<strong>Last Updated By</strong> : {{ $user->updatedBy->name??'' }}<br />

<strong>Last updated on</strong> : {{ date("h:i A \o\\n d F Y", strtotime($user->updated_at)) }}
<!-- Last Updated On: 06:20 PM on 11 September 2023  -->

<p>Date : {{date("jS M, Y", strtotime($lastVisit->visit_date))}}</p>
<!-- Date : 4th Oct, 2023 -->