<!-- sidebar.blade.php -->
<li class="menu-item" aria-haspopup="true">
    <a href="{{ url('admin/packages-sold/report?from_date='.date('Y-m-d').'&to_date='.date('Y-m-d').'&currency='.null) }}"
        class="menu-link">
        <i class="menu-bullet menu-bullet-dot">
            <span></span>
        </i>
        <span class="menu-text">Report</span>
    </a>
</li>

<!-- route.blade.php -->
Route::get('/packages-sold/report', 'Admin\PatientController@soldPackageReport')->name('package_report');
Route::post('/packages-sold/report', 'Admin\PatientController@reportGenerate')->name('package_report_generate');


<!-- ReportController.blade.php -->
    public function soldPackageReport(Request $request)
    {
        $currencies = ['' => '  --  -- ', 'USD' => 'USD', 'AUD' => 'AUD', 'GBP' => 'GBP'];

        $query = BuyPackage::where('status', 'Complete');

        if (!empty($request->from_date)) {
            $query->whereDate('apply_date', '>=', $request->from_date);
        }

        if (!empty($request->to_date)) {
            $query->whereDate('apply_date', '<=', $request->to_date);
        }

        if ($request->filled('currency')) {
            $query->where('currency', '=', $request->currency);
        }

        $allSoldPackages = $query->orderBy('id', 'DESC')->get();

        if ($request->type == 'reportprint') {
            return view('admin.package.print', compact('allSoldPackages'));
        }


        return view('admin.package.report', compact('allSoldPackages', 'currencies'));
    }


    public function reportGenerate(Request $request)
    {
        $url = 'admin/packages-sold/report?from_date=' . $request->from_date . '&to_date=' . $request->to_date;

        if ($request->filled('currency')) {
            $url .= '&currency=' . $request->currency;
        }

        return redirect($url);
    }


{{-- view.blade.php --}}
@extends('layouts.dashboard')

@section('title')
Report Generate
@endsection

@section('packages')
menu-item-active
@endsection


@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <h6 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Report Generate</h6>
                <!--end::Actions-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Sold Packages Report</h3>
                            </div>
                            <div class="card-title">
                                <a target="_blank" href="{{ url('admin/packages-sold/report?type=reportprint&from_date='.Request::get('from_date').'&to_date='.Request::get('to_date')) }}" class="btn btn-primary btn-sm btn-info"><i class="fa fa-print"></i> Print
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <form action="{{ route('package_report_generate') }}" method="POST">
                                    @csrf
                                    <div class="form-row mb-5">
                                        <div class="col-md-2">
                                            <label for="from_date">From Date</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker" readonly placeholder="From date" name="from_date" id="from_date" value="{{ Request::get('from_date') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="to_date">To Date</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker" readonly placeholder="To date" name="to_date" id="to_date" value="{{ Request::get('to_date') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="currency">Currency</label>
                                            <div class="input-group">
                                                <select class="form-control" name="currency" id="currency">
                                                    @foreach($currencies as $key => $value)
                                                        <option value="{{ $key }}" {{ request('currency') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="package_type">Package Type</label>
                                            <div class="input-group">
                                                <select class="form-control" name="package_type" id="package_type">
                                                    @foreach($packageType as $key => $value)
                                                        <option value="{{ $key }}" {{ request('package_type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="package_coverage">Package Coverage</label>
                                            <div class="input-group">
                                                <select class="form-control" name="package_coverage" id="package_coverage">
                                                    @foreach($packageCoverage as $key => $value)
                                                        <option value="{{ $key }}" {{ request('package_coverage') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 align-self-end">
                                            <button type="submit" name="generate" class="btn btn-primary">Generate Report</button>
                                        </div>
                                    </div>
                                </form>

                                <table class="table table-bordered">
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
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

@endsection
@section('js')
    <script>
         var date = new Date();
            date.setDate(date.getDate() - 1);

            $(".datepicker").datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
                todayHighlight: true,
                minDate: new Date(),
                orientation: "bottom left",
                templates: {
                    leftArrow: '<i class="fas fa-angle-left"></i>',
                    rightArrow: '<i class="fas fa-angle-right"></i>',
                },
            });
    </script>
@endsection


