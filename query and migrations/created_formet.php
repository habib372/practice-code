{{$blog->created_at->format('d M Y')}}

{{ $data->created_at->format('j F, Y') }} <!---20 Feb, 2023--->

<td>Trans Date: {{$invoice->created_at->toFormattedDateString()}} ({{$invoice->created_at->diffForHumans()}})</td> <!---20 Feb, 2023 (3 hours from now )--->