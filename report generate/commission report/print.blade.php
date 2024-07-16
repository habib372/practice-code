<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{asset('/dashboard_assets/img/report_fav.png')}}" />

    <title>Agent Commission Report</title>

    <style>
        html,
        body {
            height: 100%;
            margin: 15px;
        }

        table {
            width: 100%;
            margin-bottom: 5px;
        }

        .table td, .table th {
            vertical-align: top;
        }

        table.border,
        table.border th,
        table.border td {
            border: 1px solid black;
            border-collapse: collapse;
            vertical-align: middle;
            padding: 3px;
            font-size: 15px;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        p {
            display: inline;
        }

        table.info-header tr td {
            padding: 5px;
            background-color: #ddd;
            border-top: 1px solid black;
            border-collapse: collapse;
            vertical-align: middle;
        }

        table.info-header tr.last-one td {
            border-bottom: 1px solid black;
        }

        table.info-header tr.prescription-info td {
            border-top: none !important;
            border-bottom: 1px solid black;
            background-color: #bbb;
        }
         table td h1{
            margin: 15px 20px 20px;
        }
        thead.thead-dark {
            background: #e6e6e6;
        }
    </style>

</head>

<body>

    <div class="header">
        <table>
            <tbody>
                <tr>
                    {{-- <td width="50%">
                        <img id="fcbLogo" src="{{asset('images/serviceprovider/thumb_')}}">
                    </td> --}}
                    <td class="text-center">
                        <img alt="Logo" width="150" src="{{asset('uploads/header/5.png')}}" />
                        <h1>Agent Commission Report</h1>
                        <p> Date: {{Request::get('from_date').' to '.Request::get('to_date')}}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <table class="border" cellspacing="0" cellpadding="0">
    {{-- <table class="table table-bordered"> --}}
        <thead class="thead-dark">
            <tr>
                <th>Invoice ID</th>
                <th>Apply Date</th>
                <th>Package Name</th>
                <th>Customer Name</th>
                <th>Agent Name</th>
                <th>Agent Country</th>
                <th>Promo Code</th>
                <th>Total Amount</th>
                <th>Commission (%)</th>
                <th class="text-right">Total Amount</th>
                <th>Currency</th>
            </tr>
        </thead>
        <tbody>
              @php
                $totalCommissionAmount = 0;
              @endphp
            @foreach($allSoldPackages as $item)
              @php
                $commissionAmount = isset($item->agentInfo) ? ($item->amount * $item->agentInfo->commission_for_agent) / 100 : 0;
                $totalCommissionAmount += $commissionAmount;
              @endphp
            <tr>
                <td>{{ $item->invoice_id }}</td>
                <td>{{ $item->apply_date }}</td>
                <td>{{ $item->package_type ?? '-' }}</td>
                <td>{{ $item->patientInfo->name??'-' }}</td>
                <td>{{ $item->agentInfo->business_name??'-' }}</td>
                <td>{{ $item->agentInfo->country??'-' }}</td>
                <td>{{ $item->agent_promo_code??'-' }}</td>
                <td class="text-right">{{ number_format($item->amount, 2) ?? '-' }}</td>
                <td class="text-right">{{ isset($item->agentInfo->commission_for_agent) ? $item->agentInfo->commission_for_agent . '%' : '-' }}</td>
                <td class="text-right">{{ $commissionAmount != 0 ? number_format($commissionAmount, 2) : '-' }}</td>
                <td>{{ $item->currency }}</td>
            </tr>
            @endforeach
            <tr>
                <th colspan="9" class="text-right">Total:</th>
                <th class="text-right">{{ number_format($totalCommissionAmount, 2) }}</th>
                <th></th>
            </tr>
        </tbody>
    </table>

    <script>
        window.onload = function () {
            window.print();
        }
    </script>


</body>

</html>