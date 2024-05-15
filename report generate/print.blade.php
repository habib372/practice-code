<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{asset('/dashboard_assets/img/report_fav.png')}}" />

    <title>Report Generate</title>

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
            margin: 20px;
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
                        <h1>Bill Report</h1>
                        <p> Date: {{Request::get('from_date').' to '.Request::get('to_date')}}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <table class="border" cellspacing="0" cellpadding="0">
    {{-- <table class="table table-bordered"> --}}
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Apply Date</th>
                <th>Package Name</th>
                <th>Package Coverage</th>
                <th>Customer Name</th>
                <th class="text-right">Total Amount</th>
                <th>Currency</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allSoldPackages as $item)
            <tr>
                <td>{{ $item->invoice_id }}</td>
                <td>{{ $item->apply_date }}</td>
                <td>{{ $item->package_type ?? '' }}</td>
                <td>{{ $item->package_coverage ?? '' }}</td>
                <td>{{ $item->patientInfo->name }}</td>
                <td class="text-right">{{ $item->amount }}</td>
                <td>{{ $item->currency }}</td>

            </tr>
            @endforeach
            <tr>
                <th colspan="5" class="text-right">Total:</th>
                <th class="text-right">{{ number_format($allSoldPackages->sum('amount'), 2) }}</th>
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