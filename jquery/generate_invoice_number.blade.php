
 <?php


    // DC-240123002   like 'DC-YYMMDDCCC  | YYMMDD = date ,  CCC = count total (001,002,003)
     private function generateInvoiceId()
    {
        $sl = MembershipPayment::where('created_at', 'like', '%' . date('Y-m-d') . '%')->where('status', 'Complete')->count() + 1;
        // or
        $sl = MembershipPayment::whereDate('created_at', '=', now()->toDateString())->where('status', 'Complete')->count() + 1;

        return 'OP-' . date('ymd') . str_pad($sl, 3, '0', STR_PAD_LEFT);
    }

    //rendom number generate
    $random_user = rand(111111, 999999);






?>