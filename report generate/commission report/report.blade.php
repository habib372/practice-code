@extends('layouts.dashboard')

@section('title')
Agent Commission Report
@endsection

@section('agent')
menu-item-active menu-item-open
@endsection

@section('css')
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
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
                <h6 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Agent Commission Report Generate</h6>
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
                                <h3 class="card-label">Agent Commission Report  Report</h3>
                            </div>
                            <div class="card-title">
                                <a target="_blank" href="{{ url('admin/generate/report?type=reportprint&from_date='.Request::get('from_date').'&to_date='.Request::get('to_date').'&currency='.Request::get('currency').'&package_type='.Request::get('package_type').'&agent='.Request::get('agent').'&country='.Request::get('country')) }}" class="btn btn-primary btn-sm btn-info"><i class="fa fa-print"></i> Print
                                </a>
                            </div>
                        </div>
                            <div class="card-body">
                                <form action="{{ route('report_generate') }}" method="POST">
                                    @csrf
                                    <div class="form-row mb-3">
                                        <div class="col-md-3">
                                            <label for="from_date">From Date</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker" readonly placeholder="From date" name="from_date" id="from_date" value="{{ Request::get('from_date') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="to_date">To Date</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker" readonly placeholder="To date" name="to_date" id="to_date" value="{{ Request::get('to_date') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="agent">Agent</label>
                                            <div class="input-group">
                                                <select class="form-control" name="agent" id="agent">
                                                    <option value="" selected>-- --</option>
                                                    @foreach($allAgents as $data)
                                                        <option value="{{ $data->agent_promo_code }}" {{ request('agent') == $data->agent_promo_code ? 'selected' : '' }}>{{ $data->business_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="country">Country</label>
                                            <div class="input-group">
                                                <select class="form-control" name="country" id="country">
                                                    <option value="" selected>-- --</option>
                                                    @foreach($countries as $data)
                                                        <option value="{{ $data->name }}" {{ request('country') == $data->name ? 'selected' : '' }}>{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-row mb-5">

                                        <div class="col-md-3">
                                            <label for="currency">Currency</label>
                                            <div class="input-group">
                                                <select class="form-control" name="currency" id="currency">
                                                    @foreach($currencies as $key => $value)
                                                        <option value="{{ $key }}" {{ request('currency') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="package_type">Package Type</label>
                                            <div class="input-group">
                                                <select class="form-control" name="package_type" id="package_type">
                                                    @foreach($packageType as $key => $value)
                                                        <option value="{{ $key }}" {{ request('package_type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 align-self-end">
                                            <button type="submit" name="generate" class="btn btn-primary">Generate Report</button>
                                        </div>
                                    </div>
                                </form>

                                <table id="usertables" class="table table-bordered table-striped">
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
                                            <th>Commission Amount</th>
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

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

    <script>
        $(function() {
            $("#usertable").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>

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


