
<?php
public function index()
    {


        $this->authorize('accessDashboard',Permission::class);
         $today = Carbon::today();
         $sixMonthsAgo = Carbon::now()->subMonths(6);
         
         $todayspay = PropertyPayment::where('payment_status', 1)
            ->whereDate('created_at', $today)
            ->sum('price');
        $thisMonthPay = PropertyPayment::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('price');
        $lastMonthPay = PropertyPayment::where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())->sum('price');
        $sixMonthPay = PropertyPayment::where('created_at', '>=', $sixMonthsAgo)->sum('price');
        $data = array
        (
            'categories' => DB::table('categories')->where('level', 1)->count(),
            'subcategories' => DB::table('categories')->where('level', 2)->count(),
            'subchildcategories' => DB::table('categories')->where('level', 3)->count(),
            'brands' => DB::table('brands')->count(),
             // all users
             'users' => DB::table('users')->count(),
            //total ads
            'allPropertyAds' => DB::table('properties')->count(),

            //revenue
            'totalpayment' => $todayspay,
            'thisMonthPay' => $thisMonthPay,
            'lastMonthPay' => $lastMonthPay,
            'sixMonthPay' => $sixMonthPay,

            // Free and Paid ads
            'pendingPaidAd' => DB::table('property_payments')->where('payment_status','0')->count(),
            'confirmedPaidAd' => DB::table('property_payments')->where('payment_status','1')->count(),
            'pendingFreeAd' => DB::table('properties')->where('status', 0)->whereNotIn('id', function ($query) {
                $query->select('property_id')->from('property_payments');
            })->count(),
            'confirmedFreeAd' => DB::table('properties')->where('status', 1)->whereNotIn('id', function ($query) {
                $query->select('property_id')->from('property_payments');
            })->count(),

            //Total Ads
            'todayAds' => Property::latest()->whereDate('created_at', Carbon::today())->count(),
            'weekAds' =>  Property::latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count(),
            'monthAds' =>  Property::latest()->where('created_at', '>=', Carbon::now()->startOfMonth())->count(),
            'yearAds' =>  Property::latest()->where('created_at', '>=', $sixMonthsAgo)->count()
            
        );

        return view('backend.dashboard',compact('data'));
    }