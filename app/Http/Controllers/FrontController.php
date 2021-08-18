<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use Carbon\Carbon;

class FrontController extends BaseController
{
	public function addUseraddress(Request $request)
    {
      $info = array(
            'user_id' => Auth::id(),
            'user_name' => $request->name,
            'user_number' => $request->mobile,
            'houseno'   => $request->houseno,
            'address'   =>  $request->houseno.' '. $request->street.' '.$request->state.' '.$request->pincode,
            'street'   => $request->street,
            'state'   => $request->state,
            'pincode' => $request->pincode,
            'city_id' => $request->city,
            'area_id' => $request->area

            );
        $data = DB::table('user_address')->insert($info);
       
        if($data == 1)
        {
            return redirect('checkout')->with('success_message', 'Address added successfully');
        }
        else
        {
            return redirect('checkout')->with('error_message', 'Address not added successfully');
        }
    }
    public function getArea(Request $request)
    {
        $cityadmin = DB::table('cityadmin')->where(['city_id' =>$request->city])->first();
        
        $area = DB::table('area')->where(['cityadmin_id' =>$cityadmin->cityadmin_id])->get();
        $html = '';
        foreach($area as $area)
        {
            $html .= '<option value="'.$area->area_id.'">'.$area->area_name.'</option>';
        }
        return response()->json(['html' => $html]);
    }
    public function gettimeSlot(Request $request)
    {
        $current_time = Carbon::Now();
        $date = date('Y-m-d');
        $time_slot = DB::table('time_slot')
        ->first();
        $starttime  = $time_slot->open_hour;
        $endtime  = $time_slot->close_hour;
        $duration  = $time_slot->time_slot;
        $selected_date  = $request->datedata;
        $array_of_time = array ();
        $array_of_time1 = array ();
        $currenttime = strtotime ($current_time);
        $start_time    = strtotime ($starttime); //change to strtotime
        $end_time      = strtotime ($endtime); //change to strtotime
        $add_mins  = $duration * 60;
        if(strtotime($date)==strtotime($selected_date)){
        while ($start_time <= $currenttime) // loop between time
        {
        $array_of_time[] = date ("H:i", $start_time);
        $start_time += $add_mins; // to check endtie=me
        }
        $new_array_of_time = array ();
        for($i = 0; $i < count($array_of_time) - 1; $i++)
        {
        $new_array_of_time[] = '' . $array_of_time[$i] . ' - ' . $array_of_time[$i + 1];
        }
        $items=last($new_array_of_time);
        $numbers = explode('-', $items);
        $last_Number = end($numbers);
        $lastNumber    = strtotime ($last_Number);
        if($last_Number!= NULL){
        while ($lastNumber <= $end_time) // loop between time
        {
        $array_of_time1[] = date ("H:i", $lastNumber);
        $lastNumber += $add_mins; // to check endtie=me
        }
        $new_array_of_time1 = array ();
        for($i = 2; $i < count($array_of_time1) - 1; $i++)
        {
        $new_array_of_time1[] = '' . $array_of_time1[$i] . ' - ' . $array_of_time1[$i + 1];
        }
        }
        else{
        while ($start_time <= $end_time) // loop between time
        {
        $array_of_time1[] = date ("H:i", $start_time);
        $start_time += $add_mins; // to check endtie=me
        }
        $new_array_of_time1 = array ();
        for($i = 1; $i < count($array_of_time1) - 1; $i++)
        {
        $new_array_of_time1[] = '' . $array_of_time1[$i] . ' - ' . $array_of_time1[$i + 1];
        }
        }
        }
        elseif(strtotime($date)>strtotime($selected_date)){
        $message = array('status'=>'0', 'message'=>"You can't select the back date", 'data'=>$current_time);
        return $message; 
        }
        else{
        while ($start_time <= $end_time) // loop between time
        {
        $array_of_time1[] = date ("H:i", $start_time);
        $start_time += $add_mins; // to check endtie=me
        }
        $new_array_of_time1 = array ();
        for($i = 0; $i < count($array_of_time1) - 1; $i++)
        {
        $new_array_of_time1[] = '' . $array_of_time1[$i] . ' - ' . $array_of_time1[$i + 1];
        }
        }
        if(count($new_array_of_time1)>0){
        $message = array('status'=>'1', 'message'=>'Present time Slot', 'data'=>$new_array_of_time1);
        }
        else
        {
        $message = array('status'=>'0', 'message'=>'Oops No time slot present', 'data'=>$current_time);
        }
        if($request->datedata == date('Y-m-d'))
        {
        $html = '<br><input type="hidden" name="deliverydate" value="'.$request->datedata.'">
        <p><b>Choose Time</b></p>
        ';
        foreach($new_array_of_time1 as $new_array_of_time1data)
        {
        $html .= '
        <div class="row">
           <div class="col-md-1"><input type="radio" name="timedelivery" value="'.$new_array_of_time1data.'"></div>
           <div class="col-md-3">'.$new_array_of_time1data.'</div>
          
        </div>
        ';
        }
        }
        else
        {
        // $time_slot = DB::table('time_slot')->first();
        // if($time_slot->open_hour > '12:00')
        // {
        //     $firststart = str_replace(':00','',$time_slot->open_hour);
        //     $fisrtend = $firststart + 3;
        //     $fisrttime = $firststart.'-'.$fisrtend;
        //     $secondend = $fisrtend + 3;
        //     $secondtime = $fisrtend.'-'.$secondend;
        // }
        $html = '<br><input type="hidden" name="deliverydate" value="'.$request->datedata.'">
        <p><b>Choose Time</b></p>
        <div class="row">
           <div class="col-md-1"><input type="radio" name="timedelivery" value="07:00 - 10:00"></div>
           <div class="col-md-3">07:00 - 10:00</div>
          
        </div>
        <div class="row">
           <div class="col-md-1"><input type="radio" name="timedelivery" value="10:00 - 13:00"></div>
           <div class="col-md-3">10:00 - 13:00</div>
          
        </div>
        <div class="row">
           <div class="col-md-1"><input type="radio" name="timedelivery" value="13:00 - 16:00"></div>
           <div class="col-md-3">13:00 - 16:00</div>
           
        </div>
        <div class="row">
           <div class="col-md-1"><input type="radio" name="timedelivery" value="16:00 - 19:00"></div>
           <div class="col-md-3">16:00 - 19:00</div>
           
        </div>
        <div class="row">
           <div class="col-md-1"><input type="radio" name="timedelivery" value="19:00 - 22:00"></div>
           <div class="col-md-3">19:00 - 22:00</div>
           
        </div>
        ';
        }
        echo $html;
    }
	public function home(Request $request)
	{	
	
		$vendordata = DB::table('vendor_category')->get();
		return view('web.home',['vendordata' => $vendordata]);
	}
	public function groceryStore(Request $request)
	{

		$category = DB::table('tbl_category')->get();
		$product = DB::table('product')->join('product_varient','product_varient.product_id', '=', 'product.product_id') ->select('product.*', 'product_varient.*','vendor.*')->join('vendor','vendor.vendor_id','=','product.vendor_id')->where(['vendor.vendor_category_id' => 1])->paginate(20);
		
		return view('web.grocerystore',['product' => $product,'category' => $category]);
	}
	public function addtoBag(Request $request)
	{
		$currency = DB::table('currency')->first();
      if($request->ui_type == 1)
      {
          $exist = DB::table('cart')->where(array('product_id' => $request->pid,'user_id' => $request->user_id,'varient_id' =>  $request->varient_id))->first();
     
          if(!empty($exist))
          {
               return response()->json(['success' => false ,'code' => 400]);
          }else
          {
              
              $cartref = 'CA00'.Auth::id();
              $insertarray =  array(
                              'store_id' => $request->store_id,
                              'cartref'  => $cartref,
                              'product_id' => $request->pid,
                              'user_id'    => $request->user_id,
                              'qty'        => $request->qty,
                              'varient_id' => $request->varient_id
                          );
              $insert = DB::table('cart')->insertGetID($insertarray);
              $cartdata = DB::table('cart')->join('product_varient','product_varient.varient_id', '=', 'cart.varient_id')->join('product','product.product_id', '=', 'cart.product_id')->select('cart.*', 'product_varient.*','product.*')->where(['cart.cart_id' => $insert])->first();
             
              
              $cartcount = DB::table('cart')->where(['user_id' => $request->user_id])->get();
              if($insert != 0)
              {
                    
                $cart_html =    '<div class="col-md-3 pcart"><img src="'.asset($cartdata->varient_image).'" class="ycart_img" ></div>
                    <div class="col-md-3 pcart">'.$cartdata->product_name.'</div>
                    <div class="col-md-3 pcart">
                        <div class="btn-group btn-group-sm outer_but772" role="group" aria-label="...">
                            <button class="inner_one2" ><i class="fa fa-minus inner_one_i2" ></i></button>
                            <button class="inner_two2" ><span class="inner_two_span2">'.$cartdata->qty.'</span>
                            </button>
                            <button class="inner_three2" ><i class="fa fa-plus inner_three_i2" ></i></button>
                        </div>
                    </div>
                    <div class="col-md-3 pcart">'.$currency->currency_sign.''.$cartdata->price.'</div>';
                  return response()->json(['success' => true ,'code' => 200,'cartcount' => count($cartcount),'cart_html' => $cart_html]);
              }else
              { 
                 return response()->json(['success' => false ,'code' => 401]);
              }
          }
      }
	}
	public function createCart(Request $request)
	{
		$cartdetails = DB::table('cart')->join('product_varient','product_varient.varient_id', '=', 'cart.varient_id')->join('product','product.product_id', '=', 'cart.product_id')->select('cart.*', 'product_varient.*','product.*')->where(['cart.user_id' => Auth::id()])->get();
		
		return view('web.cart',['cartdetails' => $cartdetails]);
	}
	public function checkOut(Request $request)
	{
        $cartdetails = DB::table('cart')->join('product_varient','product_varient.varient_id', '=', 'cart.varient_id')->join('product','product.product_id', '=', 'cart.product_id')->select('cart.*', 'product_varient.*','product.*')->where(['cart.user_id' => Auth::id()])->get();
       
        $address = DB::table('user_address')->where(['user_id' => Auth::id()])->get();
        $area = DB::table('area')->get();
        $city = DB::table('city')->get();
        $useraddress = DB::table('user_address')->where(array('user_id' => Auth::id()))->get();
      return view('web.checkout',['address' => $address,'cartdetails' => $cartdetails,'area' => $area,'city' => $city,'useraddress' => $useraddress]);
	}
	public function updateCart(Request $request)
    {
        
        $qty = explode(',',$request->qty);
        $price = explode(',',$request->price);

            foreach($request->cart_id as $key =>  $cart)
            {
                $update = DB::table('cart')->where(['cart_id' => $cart])->update(['qty' => $qty[$key]]);
            }

        

        return response()->json(['status' => 'success']);
    }
    public function removeCartitem(Request $request)
    {
        $cartremove = DB::table('cart')->where(array('cart_id' => $request->cartid))->delete();
        if($cartremove == 1)
        {
            echo 1;

        }else
        {
            echo 0;
        }
    }
    public function getproductThroughname(Request $request)
    {
    	if($request->ui_type == 1)
      	{
	        $products = DB::table('product') ->join('product_varient','product_varient.product_id','=','product.product_id')->where('product.product_name','LIKE', '%'.$request->productname.'%' )->get();
	        $currency = DB::table('currency')->first();
	        $html = '';
	          foreach($products as $productvalue)
	          {
	                $html  .=  '<div class="col-md-3 width-resize">
	                              <a href="" class="card card-product-grid card-padding-css">
	                                 <div class="img-wrap shop">
	                                   <img src="'.asset($productvalue->varient_image).'">
	                                  </div>
	                                 <div class="info-wrap text-center ">
	                                    <p class="title text-truncate">'.$productvalue->product_name.'</p>
	                                    <div class="star-css"></div>
	                                    <div class="price-wrap mt-2 text-center">
	                                       <del class="price price-old">'.$currency->currency_sign.'.'.$productvalue->strick_price.'</del>
	                                    </div>
	                                    <div class="price-wrap mt-2 text-center">
	                                       <span class="price">'.$currency->currency_sign.'. '.$productvalue->price.'</span>
	                                    </div>
	                                 </div>
	                              </a>
	                            </div>';
	              if($productvalue->ui_type == 1)
                    {
	             $html   .=   '<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
					          <table class="table table-hover" cellspacing="0">
					              <tbody>
					                  <tr style="border: 1px solid #DEE2E6">
					                    <td style="width: 10%;"><div style="margin-top: 20px;"><span class="restro_tr3"><img src="'. asset($productvalue->product_image).'" class="restrotr3_img"></span></div></td>
					                    <td style="width: 89%;">
					                      <h4 class="restrohfour">'.$productvalue->product_name.'</h4> 
					                      <p class="restrohfour_indian">Indian, Grills</p>

					                      <p class="restro_track">'.$currency->currency_sign.'.'.$productvalue->price.'</p>
					                      <p class="restro_min22"><s>'.$currency->currency_sign.'.'.$productvalue->strick_price.'</s></p>
					                      <button type="button" class="add_but"  onclick="addtobag('. $productvalue->vendor_id .',1,'. $productvalue->product_id .',1,1,'.$productvalue->varient_id.',1)">Add to bag</button>
					                    </td>                                          
					                  </tr>
					              </tbody>
					          </table>
					      </div>';
					  }
	          }
	           return response()->json(['html' => $html]);
      	}
    }
    public function addOrder(Request $request)
    {
          $cartdetails = DB::table('cart')->join('product_varient','product_varient.varient_id', '=', 'cart.varient_id')->join('product','product.product_id', '=', 'cart.product_id')->select('cart.*', 'product_varient.*','product.*')->where(['cart.user_id' => Auth::id()])->get();
        
          
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
                  'user_id' => Auth::id(),
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
                  'dboy_incentive' => 0
                );
        
        $order = DB::table('orders')->insert($info);

        foreach($cartdetails as $cartdetail)
        {
            
              
              $varient_image = $cartdetail->product_image;
              $variant_id = $cartdetail->variant_id;
            
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

        
          $emptycart = DB::table('cart')->where(['user_id' => Auth::id()])->delete();
        

        if($request->ui_type == 1)
        {
          return redirect('/'.$request->ui_type)->with('success_message', 'Order Place Successfully !!!');
        }else
        {
          return redirect('/')->with('success_message', 'Order Place Successfully !!!');
        }
    }
	public function getcategoryProduct(Request $request)
    {
      if($request->ui_type == 1)
      {
          $html = '';
          $productarray = [];
          $categories = DB::table('subcat')->where(['category_id' => $request->category_id])->get();
          $currency = DB::table('currency')->first();
          foreach($categories as $category)
          {
            $products = DB::table('product') ->join('product_varient','product_varient.product_id','=','product.product_id')->where('product.subcat_id','=', $category->subcat_id )->get();
            foreach($products as $product)
            {
                $info = array(
                          'product_id' => $product->product_id,
                          'varient_id' => $product->varient_id,
                          'varient_image' => $product->varient_image,
                          'product_name' => $product->product_name,
                          'strick_price' => $product->strick_price,
                          'price' => $product->price
                        );
                if(array_search($product->product_id, array_column($productarray, 'product_id')) !== false) 
                {
                   
                }else
                {
                   array_push($productarray,$info);
                }
                
            }
          }
         
          foreach($productarray as $productvalue)
          {
                $html  .=  '<div class="col-md-3 width-resize">
                              <a href="'.route('product_detail',[$productvalue['product_id'],$request->ui_type]).'" class="card card-product-grid card-padding-css">
                                 <div class="img-wrap shop">
                                   <img src="'.asset($productvalue['varient_image']).'">
                                  </div>
                                 <div class="info-wrap text-center ">
                                    <p class="title text-truncate">'.$productvalue['product_name'].'</p>
                                    <div class="star-css"></div>
                                    <div class="price-wrap mt-2 text-center">
                                       <del class="price price-old">'.$currency->currency_sign.'.'.$productvalue['strick_price'].'</del>
                                    </div>
                                    <div class="price-wrap mt-2 text-center">
                                       <span class="price">'.$currency->currency_sign.'. '.$productvalue['price'].'</span>
                                    </div>
                                 </div>
                              </a>
                            </div>';
          }
          
        return response()->json(['html' => $html]);
      }else if($request->ui_type == 3)
      {
          $products = DB::table('resturant_product') ->join('resturant_variant','resturant_variant.product_id','=','resturant_product.product_id')->where('resturant_product.subcat_id','=', $request->category_id )->get();
          $currency = DB::table('currency')->first();
          $html = '';
          foreach($products as $productvalue)
          {
                
                $html  .=  '<div class="col-md-3 width-resize">
                              <a href="'.route('product_detail',[$productvalue->product_id,$request->ui_type]).'" class="card card-product-grid card-padding-css">
                                 <div class="img-wrap shop">
                                   <img src="'.asset($productvalue->product_image).'">
                                  </div>
                                 <div class="info-wrap text-center ">
                                    <p class="title text-truncate">'.$productvalue->product_name.'</p>
                                    <div class="star-css"></div>
                                    <div class="price-wrap mt-2 text-center">
                                       <del class="price price-old">'.$currency->currency_sign.'.'.$productvalue->strick_price.'</del>
                                    </div>
                                    <div class="price-wrap mt-2 text-center">
                                       <span class="price">'.$currency->currency_sign.'. '.$productvalue->price.'</span>
                                    </div>
                                 </div>
                              </a>
                            </div>';
          }
          return response()->json(['html' => $html]);
      }
      
    }

}