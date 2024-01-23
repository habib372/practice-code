
 <?php


    // DC-240123002   like 'DC-YYMMDDCCC  | YYMMDD = date ,  CCC = count total (001,002,003)
    private function generateInvoiceId(){

        $sl = AppointmentBill::where('created_at', 'like', '%'.date('Y-m-d').'%')->count() + 1;
        return 'DC-'.date('ymd').str_pad($sl,3,'0', STR_PAD_LEFT);

    }

    //rendom number generate
    $random_user = rand(111111, 999999);





?>