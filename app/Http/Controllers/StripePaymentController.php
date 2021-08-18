<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Session;
use Stripe;
use DB;

   
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $data = Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "INR",
                "source" => $request->stripeToken,
                "description" => "Test payment from Grofers" 
        ]);
  
        if($data->status == 'succeeded')
        {
            
            if($request->ui_type == 1)
            {
              $cartdetails = DB::table('cart')->join('product_varient','product_varient.varient_id', '=', 'cart.varient_id')->join('product','product.product_id', '=', 'cart.product_id')->select('cart.*', 'product_varient.*','product.*')->where(['cart.user_id' => session('user_id')])->get();
            }else if($request->ui_type == 3)
            {
              $cartdetails = DB::table('pharmacy_cart')->join('resturant_variant','resturant_variant.variant_id', '=', 'pharmacy_cart.varient_id')->join('resturant_product','resturant_product.product_id', '=', 'pharmacy_cart.product_id')->select('pharmacy_cart.*', 'resturant_variant.*','resturant_product.*')->where(['pharmacy_cart.user_id' => session('user_id')])->get();
            }else if($request->ui_type == 2)
            {
              $cartdetails = DB::table('cart')->join('resturant_variant','resturant_variant.variant_id', '=', 'cart.varient_id')->join('resturant_product','resturant_product.product_id', '=', 'cart.product_id')->select('cart.*', 'resturant_variant.*','resturant_product.*')->where(['cart.user_id' => session('user_id')])->get();
            }
            if(isset($cartdetails))
            {
              $vendor_id = $cartdetails[0]->vendor_id;
            }else
            {
               $vendor_id = 0;
            }
            
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $cart_id = substr(str_shuffle($str_result), 0, 8);
            
            
            $info = array(
                      'user_id' => session('user_id'),
                      'vendor_id' => $vendor_id,
                      'address_id' => $request->addressselection,
                      'cart_id'  => $cart_id,
                      'total_price' => $request->total,
                      'price_without_delivery' =>  $request->total - $request->delivery_charges,
                      'total_products_mrp' => 0,
                      'payment_method' => $request->paymentMethod,
                      'order_date'  => date('Y-m-d'),
                      'delivery_date' => $request->deliverydate,
                      'delivery_charge' => $request->delivery_charges,
                      'time_slot'     =>  $request->timedelivery,
                      'order_status' => 'pending',
                      'ui_type'   => $request->ui_type,
                      'dboy_incentive' => 0,
                      'payment_status' => 'success'
                    );
            $order = DB::table('orders')->insert($info);

            foreach($cartdetails as $cartdetail)
            {
                if($request->ui_type == 1)
                {
                  $varient_image = $cartdetail->varient_image;
                  $variant_id = $cartdetail->varient_id;
                }else if($request->ui_type == 3 || $request->ui_type == 2)
                {
                  $varient_image = $cartdetail->product_image;
                  $variant_id = $cartdetail->variant_id;
                }
                $infodata = array(
                      'product_name' => $cartdetail->product_name,
                      'quantity' => $cartdetail->quantity,
                      'unit' => $cartdetail->unit,
                      'varient_id'  => $variant_id,
                      'qty' => $cartdetail->qty,
                      'price' =>  $cartdetail->price,
                      'total_mrp' => $cartdetail->strick_price,
                      'order_cart_id'  => $cart_id,
                      'order_date' => date('Y-m-d'),
                      'varient_image'     => $varient_image,
                      'addon_price' => '0',
                    );
                $orderdetail = DB::table('order_details')->insert($infodata);
            }

            if($request->ui_type == 1 || $request->ui_type == 2)
            {
              $emptycart = DB::table('cart')->where(['user_id' => session('user_id')])->delete();
            }else if($request->ui_type == 3 )
            {
              $emptycart = DB::table('pharmacy_cart')->where(['user_id' => session('user_id')])->delete();
            }

            if($request->ui_type == 2)
            {
              return redirect('/restaurant/resthome/'.$request->ui_type)->with('success_message', 'Order Place Successfully !!!');
            }else
            {
              return redirect('/')->with('success_message', 'Order Place Successfully !!!');
            }
        }else
        {
            Session::flash('error', 'Something went wrong');
            return back();
        }
    
    }
    
     public function paystack()
    {
        if(!$_SERVER['REQUEST_METHOD'] == 'POST' || !isset($_POST['reference'])){  
              die("Transaction reference not found");
            }

            //set reference to a variable @ref
            $reference = $_POST['reference'];

            //The parameter after verify/ is the transaction reference to be verified
            $url = 'https://api.paystack.co/transaction/verify/'.$reference;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt(
              $ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer secret_key']
            );

            //send request
            $request = curl_exec($ch);
            //close connection
            curl_close($ch);
            //declare an array that will contain the result 
            $result = array();

            if ($request) {
              $result = json_decode($request, true);
            }

            if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {
             
                if($request->ui_type == 1)
                {
                  $cartdetails = DB::table('cart')->join('product_varient','product_varient.varient_id', '=', 'cart.varient_id')->join('product','product.product_id', '=', 'cart.product_id')->select('cart.*', 'product_varient.*','product.*')->where(['cart.user_id' => session('user_id')])->get();
                }else if($request->ui_type == 3)
                {
                  $cartdetails = DB::table('pharmacy_cart')->join('resturant_variant','resturant_variant.variant_id', '=', 'pharmacy_cart.varient_id')->join('resturant_product','resturant_product.product_id', '=', 'pharmacy_cart.product_id')->select('pharmacy_cart.*', 'resturant_variant.*','resturant_product.*')->where(['pharmacy_cart.user_id' => session('user_id')])->get();
                }else if($request->ui_type == 2)
                {
                  $cartdetails = DB::table('cart')->join('resturant_variant','resturant_variant.variant_id', '=', 'cart.varient_id')->join('resturant_product','resturant_product.product_id', '=', 'cart.product_id')->select('cart.*', 'resturant_variant.*','resturant_product.*')->where(['cart.user_id' => session('user_id')])->get();
                }
                if(isset($cartdetails))
                {
                  $vendor_id = $cartdetails[0]->vendor_id;
                }else
                {
                   $vendor_id = 0;
                }
                
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $cart_id = substr(str_shuffle($str_result), 0, 8);
                
                
                $info = array(
                          'user_id' => session('user_id'),
                          'vendor_id' => $vendor_id,
                          'address_id' => $request->addressselection,
                          'cart_id'  => $cart_id,
                          'total_price' => $request->total,
                          'price_without_delivery' =>  $request->total - $request->delivery_charges,
                          'total_products_mrp' => 0,
                          'payment_method' => $request->paymentMethod,
                          'order_date'  => date('Y-m-d'),
                          'delivery_date' => $request->deliverydate,
                          'delivery_charge' => $request->delivery_charges,
                          'time_slot'     =>  $request->timedelivery,
                          'order_status' => 'pending',
                          'ui_type'   => $request->ui_type,
                          'dboy_incentive' => 0,
                          'payment_status' => 'success'
                        );
                $order = DB::table('orders')->insert($info);
    
                foreach($cartdetails as $cartdetail)
                {
                    if($request->ui_type == 1)
                    {
                      $varient_image = $cartdetail->varient_image;
                      $variant_id = $cartdetail->varient_id;
                    }else if($request->ui_type == 3 || $request->ui_type == 2)
                    {
                      $varient_image = $cartdetail->product_image;
                      $variant_id = $cartdetail->variant_id;
                    }
                    $infodata = array(
                          'product_name' => $cartdetail->product_name,
                          'quantity' => $cartdetail->quantity,
                          'unit' => $cartdetail->unit,
                          'varient_id'  => $variant_id,
                          'qty' => $cartdetail->qty,
                          'price' =>  $cartdetail->price,
                          'total_mrp' => $cartdetail->strick_price,
                          'order_cart_id'  => $cart_id,
                          'order_date' => date('Y-m-d'),
                          'varient_image'     => $varient_image,
                          'addon_price' => '0',
                        );
                    $orderdetail = DB::table('order_details')->insert($infodata);
                }
    
                if($request->ui_type == 1 || $request->ui_type == 2)
                {
                  $emptycart = DB::table('cart')->where(['user_id' => session('user_id')])->delete();
                }else if($request->ui_type == 3 )
                {
                  $emptycart = DB::table('pharmacy_cart')->where(['user_id' => session('user_id')])->delete();
                }
    
                if($request->ui_type == 2)
                {
                   echo "success";
                }else
                {
                   echo "success";
                }
             
                //Perform necessary action
            }else{
              echo "Transaction was unsuccessful";
            }
            
             return redirect('/')->with('success_message', 'Order Place Successfully !!!');
    }
}