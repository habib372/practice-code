<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Stock;
use Cart;
use App\Order;
use App\OrderItem;
use Illuminate\Support\Facades\Auth;

use vendor\uzzal\sslcommerz\src\Client;
use vendor\uzzal\sslcommerz\src\Customer;

class CheckoutController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return voidv
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Cart::total()<=0){
            abort(403, 'Unauthorized action.');
        }
        return view('checkout.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  //dd(Cart::content());
        // return redirect('http://ladiesmarket.com.bd/en');

        $data = $request->validate([
            'name' => 'required|max:191',
            'email' => 'nullable|email|max:191',
            'mobile' => ['required','regex:/(\+){0,1}(88){0,1}01(3|4|5|6|7|8|9)(\d){8}/','min:11','max:15'],
            'address' => 'required|max:10000',
            'postal_code' => 'nullable|max:191',
            'payment_method'=>'required',
            'message' => 'nullable|max:2000',
            'shipping_area' => "nullable",
            'reference' => 'nullable',
            'acc_name' => 'nullable',
            "trans_id" => 'nullable'
            // 'bkash_mobile_no' => 'required_if:payment_method,247',
            // 'transaction_id' => 'required_if:payment_method,247',
        ]);

        $ref_id = null;

        if(isset($data['reference']) && $data['reference'] != null){
            $references = \App\User::where('user_code',$data['reference'])->first();
            if($references){
                $ref_id = $references->id;
            }else{
                $ref_id = null;
            }
        }

       // return $ref_id;
       // return $data;

        $trans_id = uniqid();

        if(Cart::total()<=0){
            abort(403, 'Unauthorized action.');
        }
        $carts = Cart::content();
        $cartsTotal= Cart::total();
        $shippingCost = 0;

        $setting = \App\Setting::first();
        if($setting){
            if(isset($data['shipping_area']) && $data['shipping_area'] == 1){
                $shippingCost = $setting->dhaka_shipping_cost;
            }else{
                 $shippingCost = $setting->outside_dhaka_shipping_cost;
            }
        }else{
            $shippingCost = 0;
        }

        $customer = array(
            "name" => $data['name'],
            "email" => isset($data['email']) ? $data['email'] : null,
            "address" => $data['address'],
            "mobile"  => $data['mobile']
        );

        $order=Order::create([
            'total_product' => Cart::content()->count(),
            'total_qty' => Cart::count(),
            'total_price' => Cart::total(),
            'final_price' => Cart::total() + $shippingCost,
            'shipping_cost' => $shippingCost,
            'payment_method' => isset($data['payment_method']) ? $data['payment_method']:1,
            'email' => isset($data['email']) ? $data['email'] : null,
            'name' => $data['name'],
            'address' => $data['address'],
            // 'bkash_mobile_no' => isset($data['bkash_mobile_no']) ? $data['bkash_mobile_no'] : null,
            // 'transaction_id' => isset($data['transaction_id']) ? $data['transaction_id'] : null,
            'message' => isset($data['message']) ? $data['message'] : null,
            'mobile' => $data['mobile'],
            'pending_at' => \Carbon\Carbon::now(),
            'orderby_id' => Auth::check() ? Auth::user()->id : '1',
            'editedby_id' =>Auth::check() ? Auth::user()->id : '1',
            "trans_id" => $trans_id,
            'ref_user' => $ref_id,
            'txd_acc' => isset($data['acc_name']) ? $data['acc_name']:null,
            "txd_id"  => isset($data['trans_id']) ? $data['trans_id']:null,
        ]);

        //store invoice no.
        $updatedOrder = tap($order)->update([
            'invoice_no' => $order->created_at->format('ymd') . str_pad($order->id, 6, '0', STR_PAD_LEFT)
        ]);

        // .....................................................
        // Write to OrderItem Table //
        // .....................................................
        OrderItem::where('order_id', $order->id)->delete(); //important,add it to main checkout

        $SaleProducts = [];

        foreach($carts as $key => $cart){
            $productData = Product::find($cart->id);
            $orderItems=OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'size' => $cart->options->size ? $cart->options->size : $productData->unit_type,
                'purchase_price' => $productData->purchase_price,
                'price' => $cart->price,
                'code' => $cart->options->code,
                'url' => $cart->options->url,
                'slug' => $cart->options->slug,
                'image' => $cart->options->image,
                'sub_total' => $cart->subtotal,
                'ref_user' => $ref_id
            ]);
            


            $fqty =  $productData->total_qty - $orderItems->qty;
            $productData->update([
                "total_qty" =>  $fqty,
            ]);

            array_push($SaleProducts, array(
                "product" => $productData->title,
                "amount" => $orderItems->price,
            ));

        }

        $orderItems = \App\OrderItem::where('order_id',$order->id)->get();

        foreach($orderItems as $orderProduct){
            $product = Product::find($orderProduct->product_id);

            // $product = tap($product)->update([
            //     'total_qty' => ($product->total_qty - $orderProduct->qty)
            // ]);

            if($product->hassize){
                $stock = Stock::where('product_id',$product->id)->where('size',$orderProduct->size)->first();

                $stock = tap($stock)->update([
                    'qty' => ($stock->qty - $orderProduct->qty)
                ]);
            }
        }

        if(isset(Auth::user()->refby_id)){
            function comSetter($refbyId, $commissionGetters = []){
                $getUser =\App\User::where('id',$refbyId)->first();

                if($getUser){
                    array_push($commissionGetters,$getUser->id);
                    if(isset($getUser->refby_id)){
                        return comSetter($getUser->refby_id, $commissionGetters);
                    }
                    return $commissionGetters;
                }
                 return $commissionGetters;
            }

            $commissionGetters = comSetter(Auth::user()->refby_id);

            for($k=1;$k<=count($commissionGetters);$k++){
                $getCommission =\App\Commission::where('level',$k)->first();
                $reg_price = 1000;
                $comAmount  = ((float)$reg_price * (float)$getCommission->commission/100);
                $comAmount  = round($comAmount, 2);

                $getComUser =\App\User::where('id',$commissionGetters[$k - 1])->first();
                if(isset($getComUser)){
                    $getComUser = tap($getComUser)->update([
                        'com_pending' => (float)$getComUser->com_pending + $comAmount,
                    ]);
                }
            }
        }



        $others = array(
            "total_amount" => $cartsTotal,
            "trans_id" => $trans_id,
        );
        Cart::destroy();
        return redirect()->route('checkout.success',$order)->with('success','Order Successful');

        // if($data['payment_method']==1){
        //     Cart::destroy();
        //     \Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\ConfirmToAdmin($order,$orderItems));
        //     if(isset($data['email']) && $data['email']){
        //         \Mail::to($data['email'])->send(new \App\Mail\ConfirmToCustomer($order,$orderItems));
        //     }
        //   //  die();
        //     return redirect()->route('checkout.success',$order)->with('success','Order Successful');
        // }else{
        //     \Mail::to(env('ADMIN_EMAIL'))->send(new \App\Mail\ConfirmToAdmin($order,$orderItems));
        //     if(isset($data['email']) && $data['email']){
        //         \Mail::to($data['email'])->send(new \App\Mail\ConfirmToCustomer($order,$orderItems));
        //     }
        //      Cart::destroy();
        //     return redirect()->route('checkout.success',$order)->with('success','Order Successful');
        //    // return $this->redirectToSSL($customer,$SaleProducts,$others);
        // }

       // return view('checkout.success',compact('orderItems','order'));
    }

     public function redirectToSSL($customer = null, $SaleProducts = null, $others){

        $post_data = array();
        //Store Info

        //Demo
         $post_data['store_id'] = "testbox";
         $post_data['store_passwd'] = "qwerty";

        //Live
        // $post_data['store_id'] = "falgunishoplive";
        // $post_data['store_passwd'] = "5D9050F7806BB17435";


        // $post_data['total_amount'] = 10;
        $post_data['total_amount'] = $others['total_amount'];
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $others['trans_id'];
        $post_data['success_url'] = route("verifyPayment");
        $post_data['fail_url'] = route('errorPayment');
        $post_data['cancel_url'] = route('cancelPayment');

        //Customer INFO
        $post_data['cus_name']  = $customer['name'];
        $post_data['cus_email'] = $customer['email'];
        $post_data['cus_add1']  = $customer['address'];
        $post_data['cus_phone'] = $customer['mobile'];
        $post_data['cus_add2'] = "Dhaka";
        $post_data['cus_add2'] = "Dhaka";
        $post_data['cus_city'] = "Dhaka";
        $post_data['cus_state'] = "Dhaka";
        $post_data['cus_postcode'] = "1230";
        $post_data['cus_country'] = "Bangladesh";
        //Shipping Information
        $post_data['ship_name'] = $customer['name'];
        $post_data['ship_add1 '] = $customer['address'];
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1230";
        $post_data['ship_country'] = "Bangladesh";
        $post_data['cart'] = json_encode($SaleProducts);
        $str = null;
        // dd($SaleProducts);
        for($i = 0; $i<count($SaleProducts); $i++){
            $str.=$SaleProducts[$i]['product'].',';
        }


        $post_data['product_name']=rtrim($str,',');
        $post_data['product_category']="product";
        $post_data['product_profile'] = "physical-goods";


        $post_data['vat'] = "0";
        $post_data['discount_amount'] = "0";
        $post_data['convenience_fee'] = "0";
        $post_data['shipping_method'] = "NO";
        $post_data['product_amount'] = $others['total_amount'];
        $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v4/api.php";
        //$direct_api_url = "https://securepay.sslcommerz.com/gwprocess/v4/api.php";

       // return $post_data;

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $direct_api_url );
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1 );
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


        $content = curl_exec($handle );


        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if($code == 200 && !( curl_errno($handle))) {
            curl_close( $handle);
            $sslcommerzResponse = $content;
            //var_dump ($sslcommerzResponse);
           // die();
        } else {
            curl_close( $handle);
            echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
            exit;
        }


        $sslcz = json_decode($sslcommerzResponse, true );

        if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
                # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
            echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
            # header("Location: ". $sslcz['GatewayPageURL']);
            exit;
        } else {
            echo "JSON Data parsing error!";
        }


    }


    public function verifyPayment(){
        //dd($_POST);
       $cardType = isset($_POST['card_type']) ? $_POST['card_type']:null;
       $cardName = isset($_POST['card_issuer']) ? $_POST['card_issuer']:null;
       $accountNo = isset($_POST['card_no']) ? $_POST['card_no']:null;
       $paymentInfo = isset($_POST) ? $_POST:null;
       // var_dump ($_POST);
       //  die();
       Cart::destroy();
       $order = Order::where('trans_id',$_POST['tran_id'])->first();
        $order->update([
            "payment_status" => 3,
            "pay_via" => $cardType,
            "payment_info" => json_encode($paymentInfo),
            "val_id" => $paymentInfo['val_id'],
            "account_no"   => $accountNo
        ]);

        $orderItems = \App\OrderItem::where('order_id',$order->id)->get();

        return view('checkout.success',compact('orderItems','order'));
        // return redirect()->route('checkout.success',$order->id);

    }

    public function errorPayment(){
        Cart::destroy();
        return view('checkout.failed');
    }

    public function cancelPayment(){
        Cart::destroy();
        return view('checkout.failed');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function success(Order $order)
    {
        // echo $order->orderby_id;
        // echo  Auth::id();
        // die();
        // if($order->orderby_id != Auth::id()) {
        //     abort(403);
        // }
        $orderItems = OrderItem::where('order_id',$order->id)->get();
        return view('checkout.success',compact('orderItems','order'));
    }

}
