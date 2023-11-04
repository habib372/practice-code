public function index()
    {
        $this->authorize('accessDashboard',Permission::class);
         $today = Carbon::today();
         $sixMonthsAgo = Carbon::now()->subMonths(6);
         $todayspay = PropertyPayment::where('payment_status', 1)
            ->whereDate('created_at', $today)
            ->sum('price');
        $thisMonthPay = PropertyPayment::where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())->sum('price');
        $data = array
        (
            'users' => DB::table('users')->count(),
            'categories' => DB::table('categories')->where('level', 1)->count(),
            'totalpayment' => $todayspay,
            'subcategories' => DB::table('categories')->where('level', 2)->count(),
            'subchildcategories' => DB::table('categories')->where('level', 3)->count(),
            'brands' => DB::table('brands')->count(),
            'products' => DB::table('properties')->count(),

            // ads
            'pendingPaidAd' => DB::table('property_payments')->where('payment_status','0')->count(),
            'confirmedPaidAd' => DB::table('property_payments')->where('payment_status','1')->count(),
            'pendingFreeAd' => DB::table('properties')->where('status', 0)->whereNotIn('id', function ($query) {
                $query->select('property_id')->from('property_payments');
            })->count(),
            'confirmedFreeAd' => DB::table('properties')->where('status', 1)->whereNotIn('id', function ($query) {
                $query->select('property_id')->from('property_payments');
            })->count(),


            'todayOrders' => Property::latest()->whereDate('created_at', Carbon::today())->count(),
            'weekOrders' =>  Property::latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count(),
            'monthOrders' =>  Property::latest()->where('created_at', '>=', Carbon::now()->startOfMonth())->count(),
            'yearOrders' =>  Property::latest()->where('created_at', '>=', $sixMonthsAgo)->count(),
            'thisMonthPayment' => $thisMonthPay
        );

        return view('backend.dashboard',compact('data'));
    }