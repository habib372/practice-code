
<li class="menu-item {{ Request::is('admin/generate/report')?'menu-item-active':'' }}" aria-haspopup="true">
    <a href="{{ url('admin/generate/report?from_date='.date('Y-m-d').'&to_date='.date('Y-m-d')) }}" class="menu-link">
        <i class="menu-bullet menu-bullet-dot">
            <span></span>
        </i>
        <span class="menu-text"> Commission Report</span>
    </a>
</li>

<!---- route ---->
Route::get('/generate/report', 'Admin\PatientController@report')->name('agent_report');
Route::post('/generate/report', 'Admin\PatientController@reportGenerate')->name('report_generate');


<!---- Controller ---->
<?php
//agent report
    public function Report(Request $request)
    {
        $currencies = ['' => '  --  -- ', 'USD' => 'USD', 'AUD' => 'AUD', 'GBP' => 'GBP'];
        $packageType = ['' => '  --  -- ', 'Basic' => 'Basic', 'Premier' => 'Premier', 'On-Demand' => 'On-Demand'];
        $countries = Country::all();
        $allAgents = Patient::where('status', 'active')->get();

        $query = Package::whereNotNull('promo_code')->where('status', 'Complete');

        if (!empty($request->from_date)) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if (!empty($request->to_date)) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        if ($request->filled('currency')) {
            $query->where('currency', '=', $request->currency);
        }

        if ($request->filled('package_type')) {
            $query->where('package_type', '=', $request->package_type);
        }

        if ($request->filled('agent')) {
            $query->where('promo_code', '=', $request->agent);
        }

        if ($request->filled('country')) {
            $query->whereHas('agentInfo', function ($q) use ($request) {
                $q->where('country', '=', $request->country);
            });
        }

        $allSoldPackages = $query->orderBy('id', 'DESC')->get();

        if ($request->type == 'reportprint') {
            return view('admin.agent.print', compact('allSoldPackages'));
        }

        return view('admin.patient.report', compact('allSoldPackages', 'currencies', 'packageType', 'countries', 'allAgents'));
    }


    public function reportGenerate(Request $request)
    {
        $url = 'admin/generate/report?from_date=' . $request->from_date . '&to_date=' . $request->to_date;

        if ($request->filled('currency')) {
            $url .= '&currency=' . $request->currency;
        }
        if ($request->filled('package_type')) {
            $url .= '&package_type=' . $request->package_type;
        }

        if ($request->filled('agent')) {
            $url .= '&agent=' . $request->agent;
        }
        if ($request->filled('country')) {
            $url .= '&country=' . $request->country;
        }

        return redirect($url);
    }

?>














