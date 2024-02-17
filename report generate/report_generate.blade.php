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
        $membershipPaymentBills = Patient::with(['serviceProvider', 'district', 'country', 'disease', 'stage'])->where('status', 0)->orderBy('id', 'desc')->get();

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

