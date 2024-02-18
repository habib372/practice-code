<!-- sidebar.blade.php -->
<li class="m-menu__item {{ Request::is('tsr-admin/patients/report')? 'm-menu__item--active' : '' }}" aria-haspopup="true">
    <a href="{{ url('tsr-admin/patients/report?from_date='.date('Y-m-d').'&to_date='.date('Y-m-d').'&payment_mode='.null) }}" class="m-menu__link ">
        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
            <span></span>
        </i>
        <span class="m-menu__link-text">Patient Report</span>
    </a>
</li>

if(auth('doctor')->check()){
			$url = route('doctor.patient-visits.index', $queryString);
		}else{
			$url = route('tsr-admin.patient-visits.index', $queryString);
		}


<!-- route.blade.php -->
Route::get('/patients/report', ['as' => 'patients/report', 'uses' => 'ReportController@patientReport']);
Route::post('/patients/report', ['as' => 'patients/report/filter', 'uses' => 'ReportController@patientFilter']);


<!-- ReportController.blade.php -->
    public function patientReport(Request $request)
    {

        $paymentMode = ['' => '  --  -- ', 'cash' => 'Cash', 'bkash' => 'Bkash', 'rocket' => 'Rocket', 'nagad' => 'Nagad', 'credit-card' => 'Credit Card', 'bank-account' =>'Bank Account', 'online-payment' => 'Online Payment'];
        $membershipPaymentBills = MembershipPayment::whereIn('status', ['Complete', 'Paid'])->orderBy('id', 'desc');

        if (!empty($request->from_date)) {
            $membershipPaymentBills = $membershipPaymentBills->whereDate('apply_date', '>=', $request->from_date);
        }
        if (!empty($request->to_date)) {
            $membershipPaymentBills = $membershipPaymentBills->whereDate('apply_date', '<=', $request->to_date);
        }

        if ($request->filled('payment_mode')) {
            $membershipPaymentBills = $membershipPaymentBills->where('payment_mode', '=', $request->payment_mode);
        }

        // if (in_array(auth()->user()->user_role_id, [2, 3, 7])) {
        //     $membershipPaymentBills = $membershipPaymentBills->whereHas('created_by', function ($query) {
        //         $query->where('service_provider_id', auth()->user()->service_provider_id);
        //     });
        // }

        $membershipPaymentBills = $membershipPaymentBills->get();

        if ($request->type == 'reportprint') {
            return view('admin.membership_payment.report.print', compact('membershipPaymentBills'));
        }

        return view('admin.patient.report.patient_report', compact('membershipPaymentBills', 'paymentMode'));
    }

    public function patientFilter(Request $request)
    {
        $url = 'tsr-admin/paid-member/report/bill?from_date=' . $request->from_date . '&to_date=' . $request->to_date;

        if ($request->filled('payment_mode')) {
            $url .= '&payment_mode=' . $request->payment_mode;
        }

        return redirect($url);
    }


    {{-- view.blade.php --}}
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">Bill Report</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">

			<form class="m-form m-form--fit m-form--label-align-right" action="{{url('tsr-admin/report/bill')}}" method="POST">
					@csrf
					<div class="row mb-4">
						<div class="col-md-3">
							<label for="from_date">From Date</label>
							<div class="input-group date">
								<input type="text" class="form-control m-input datepicker" readonly placeholder="From date" name="from_date" id="from_date" value="{{ Request::get('from_date') }}">
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<label for="from_date">To Date</label>
							<div class="input-group date">
								<input type="text" class="form-control m-input datepicker" readonly placeholder="To date" name="to_date" id="to_date" value="{{ Request::get('to_date') }}">
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<label>&nbsp;</label>
							<div class="input-group">
								<button type="submit" name="generate" class="btn btn-primary">Generate Report</button>
							</div>
						</div>
					</div>

				</form>


				@if($appointmentBills->count() + $chemotherapyBills->count() > 0)
				<div class="row">
					<div class="col-12 text-right">
						<a target="_blank" href="{{url('tsr-admin/report/bill?type=print&from_date='.Request::get('from_date').'&to_date='.Request::get('to_date'))}}" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
					</div>
				</div>
				@endif
				<!--begin: Search Form -->
				<table class="table table-bordered m-table">
					<tbody>
						<tr>
							<th>Invoice ID</th>
							<th>Date Time</th>
							<th>Received By</th>
							<th>Patient Name</th>
							<th>Bill Amount</th>
							<th>Payment Method</th>
							<th>Remarks</th>
						</tr>

						@foreach($appointmentBills as $item)
						<tr>
							<td>{{$item->invoice_id}}</td>
							<td>{{$item->created_at}}</td>
							<td>{{$item->createdBy->name??''}}</td>
							<td>{{$item->appointment->patient->name??''}}</td>
							<td class="text-right">{{$item->amount}}</td>
							<td>{{$item->payment_method}}</td>
							<td>{{$item->remarks}}</td>
						</tr>
						@endforeach

						@foreach($chemotherapyBills as $item)
						<tr>
							<td>{{$item->invoice_id}}</td>
							<td>{{$item->created_at}}</td>
							<td>{{$item->createdBy->name??''}}</td>
							<td>{{$item->chemotherapy->patient->name??''}}</td>
							<td class="text-right">{{$item->amount}}</td>
							<td>{{$item->payment_method}}</td>
							<td>{{$item->remarks}}</td>
						</tr>
						@endforeach
						<tr>
							<th colspan="4" class="text-right">Total:</th>
							<th class="text-right">{{number_format($appointmentBills->sum('amount') + $chemotherapyBills->sum('amount'),2)}}</th>
						</tr>


					</tbody>
				</table>
			</div>
		</div>
	</div>

