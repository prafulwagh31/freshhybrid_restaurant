<!DOCTYPE html>
<html>
   <head>
      <title>Checkout</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/4ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="{{ url('frontend/owlcarousel/owl.carousel.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url('frontend/owlcarousel/owl.theme.default.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/style.css') }}">
   </head>
   <body>
      @include("web.header")
      @php
      $currency = DB::table('currency')->first();
      $cartcount = count($cartdetails);
      @endphp
      @php $finaltotal = 0; @endphp
        @foreach($cartdetails as $cartdetailsval)
          @php $finaltotal += $cartdetailsval->qty * $cartdetailsval->price @endphp
      @endforeach
      <style type="text/css">
         @media only screen and (max-width: 768px) {
         .checkout_cont
         {
         width: 94.4%;
         }
         .restro_newdf
         {
         min-width: 100%;overflow:scroll;height: auto;
         }
         .mob_sel71
         {
         left: 14px;position: relative;top: 20px;padding-bottom: 20px;
         }
         .checkout_redeem2
         {
         min-width: 30%;margin-left: 10px;
         }
         .checkout_redeem
         {
         width: 53%;
         }
         .check_placeorder
         {
         margin-bottom: 20px;
         }
         .checkout_subtt
         {
         margin-top: 20px;
         }
         .check_para
         {
         margin-top: 10px;
         }
         .ckeckout_block
         {
         margin-top: 20px;  
         }
         }
      </style>
      <div class="container-fluid shadow checkout_cont">
         <div class="row">
            <div class="col-sm-12" >
               <p class="checkout_p99">Home &nbsp; <i class="fas fa-chevron-right" style="color: #FF5A00;font-size: 12px;"></i> &nbsp; Checkout</p>
            </div>
         </div>
         <form id="OrderForm"  method="POST" action="{{ route('addorder')}}">
            {{ csrf_field() }}

              <input type="hidden" name="total" value="{{$finaltotal}}">
              <input type="hidden" name="delivery_charges" value="20">
              <input type="hidden" name="sub_total" value="{{$finaltotal}}">
              <input type="hidden" name="ui_type" value="{{ Request::route('id')}}">
               <input id="amount" type="hidden" class="form-control" name="amount" value="{{$finaltotal + 20}}" autofocus>
           <div class="row" style="margin-top: 36px;">
              <div class="col-sm-12">
                 <div class="card" style="min-height: 100px;">
                    <div class="checkout_div1">
                       <p class="checkout_psec">Order Summary</p>
                    </div>
                    <p class="checkout_head">Your Cart<span class="checkout_head24" ><span class="badge badge-secondary badge-pill">{{$cartcount}}</span></span></p>
                    <div class="restro_newdf">
                       <table class="table" style="width: 940px;margin-left: 14px;">
                          <thead>
                             <tr>
                                <th scope="col" class="check_font">#</th>
                                <th scope="col" style="width: 40%;font-size: 14px;">Item(s)</th>
                                <th scope="col" class="check_font">Qty</th>
                                <th scope="col" class="check_font">Price</th>
                             </tr>
                          </thead>
                          <tbody>
                             @php $total = 0; @endphp
                             @foreach($cartdetails as $cartdetails)
                             <tr>
                                <td class="check_font"><img src="{{ asset($cartdetails->product_image)}}" class="ycart_img"></td>
                                <td class="check_font">{{$cartdetails->product_name}}</td>
                                <td class="check_font">{{$cartdetails->qty}}</td>
                                <td class="check_font">{{$currency->currency_sign}}.{{$cartdetails->price * $cartdetails->qty }}</td>
                             </tr>
                             @php $total += $cartdetails->qty * $cartdetails->price @endphp
                             @endforeach
                          </tbody>
                       </table>
                    </div>
                    <br>
                 </div>
              </div>
           </div>
           <div class="row" style="margin-top: 20px;">
              <div class="col-sm-12">
                 <div class="card" style="min-height: 100px;">
                    <div class="checkout_div1">
                       <p class="checkout_psec">Delivery Address <span class="checkout_delivery" data-toggle="modal" data-target="#searchmap">ADD</span></p>
                    </div>
                    
                    <div class="row" style="margin-top: 10px;padding-left: 20px;">
                       @foreach($useraddress as $useraddress)
                       
                         <div class="col-sm-3 add_mob3">
                            <p class="myaccount_para22e">Name</p>
                            <p class="myaccount_para22">Mobile</p>
                            <p class="myaccount_para22">House Number</p>
                            <p class="myaccount_para22">Street</p>
                            <p class="myaccount_para22">State</p>
                            <p class="myaccount_para22">Pincode</p>
                         </div>
                         <div class="col-sm-3 name_mob3">
                           
                            <p class="myaccount_para22e">{{  $useraddress->user_name }}</p>
                            <p class="myaccount_para22new">{{  $useraddress->user_number }}</p>
                            <p class="myaccount_para22new">{{  $useraddress->houseno }}</p>
                            <p class="myaccount_para22new">{{  $useraddress->street }}</p>
                            <p class="myaccount_para22new">{{  $useraddress->state }}</p>
                            <p class="myaccount_para22new">{{  $useraddress->pincode }}</p>
                           
                         </div>
                        

                        @endforeach
                    </div>
                    
                 </div>
              </div>
           </div>
           <div class="row" style="margin-top: 20px;">
              <div class="col-sm-12">
                 <div class="card" style="min-height: 220px;">
                    <div class="checkout_div1">
                       <p class="checkout_psec">Delivery Date & Time </p>
                    </div>
                    <?php
                       $firstday = date('d',time() + 86400);
                       $firstmonth = date('M',time() + 86400);
                       $firstdate = date('D',time() + 86400);
                       $secondday = date('d',time() + 172800);
                       $secondmonth = date('M',time() + 172800);
                       $seconddate = date('D',time() + 172800);
                       $thirdday = date('d',time() + 259200);
                       $thirdmonth = date('M',time() + 259200);
                       $thirddate = date('D',time() + 259200);
                       ?>
                    <div class="" style="margin-left: 20px;margin-top: 12px;">
                       <p><b>Choose a delivery slot</b></p>
                       <div class="row">
                          <div class="col-md-3"><input type="radio" name="deliverydatetime" onclick="gettimeslot('<?php echo  date('Y-m-d'); ?>');">&nbsp;&nbsp;<b>{{ date('d') }} {{ date('M') }} ,<?php echo $dayOfWeek = date("D", strtotime(date('Y-m-d')));?></b></div>
                          <div class="col-md-3"><input type="radio"  name="deliverydatetime" onclick="gettimeslot('<?php echo date('Y-m-d',time()+86400); ?>')">&nbsp;&nbsp;<b><?php echo $firstday; ?> <?php echo  $firstmonth; ?> ,<?php echo $firstdate; ?></b></div>
                          <div class="col-md-3"><input type="radio"  name="deliverydatetime" onclick="gettimeslot('<?php echo date('Y-m-d',time()+172800);?>')">&nbsp;&nbsp;<b><?php echo $secondday; ?> <?php echo $secondmonth; ?> ,<?php echo $seconddate; ?></b></div>
                          <div class="col-md-3"><input type="radio" name="deliverydatetime" onclick="gettimeslot('<?php echo date('Y-m-d',time()+259200);?>')">&nbsp;&nbsp;<b><?php echo $thirdday; ?> <?php echo $thirdmonth; ?> ,<?php echo $thirddate; ?></b></div>
                       </div>
                       <div class="" id="timedataslot"></div>
                    </div>
                 </div>
              </div>
           </div>
           <div class="row" style="margin-top: 20px;">
              <div class="col-sm-12">
                 <div class="card" style="min-height: 400px;">
                    <div class="checkout_div1">
                       <p class="checkout_psec">Payment Summary </p>
                    </div>
                    <p style="margin-top: 16px;"><input type="" name="" id="search3" placeholder="Voucher code" class="checkout_redeem"> <button class="checkout_redeem2">REDEEM</button></p>
                    <hr style="margin-top:2px;">
                    <p class="checkout_payt">Select your payment method</p>
                    <div class="row">
                       <div class="col-sm-7">
                          <div class="shadow-sm checkout_pay2">
                             <label class="radio"><img src="{{ url('frontend/image/v2.PNG') }}" height="15"> Cash On Delivery
                             <input type="radio" checked="checked"  name="paymentMethod" value="COD">
                             <span class="checkround"></span>
                             </label>
                          </div>
                          <div class="shadow-sm checkout_visa">
                             <label class="radio"><img src="{{ url('frontend/image/v2.PNG') }}" height="15"> Razorpay
                             <input type="radio"  name="paymentMethod" value="Razorpay" onclick="getpaymentmethod('razorpay')">
                             <span class="checkround"></span>
                             </label>
                          </div>
                          <div class="shadow-sm checkout_visa22">
                             <label class="radio"><img src="{{ url('frontend/image/v2.PNG') }}" height="15"> Stripe
                             <input type="radio"  name="paymentMethod" value="Stripe" onclick="getpaymentmethod('stripe')">
                             <span class="checkround"></span>
                             </label>
                          </div>
                          <div class="shadow-sm checkout_visa22">
                             <label class="radio"><img src="{{ url('frontend/image/v2.PNG') }}" height="15"> Paypal
                             <input type="radio"  name="paymentMethod" value="Paypal" onclick="getpaymentmethod('paypal')">
                             <span class="checkround"></span>
                             </label>
                          </div>
                          <div class="shadow-sm checkout_visa22">
                             <label class="radio"><img src="{{ url('frontend/image/v2.PNG') }}" height="15"> Paystack
                             <input type="radio"  name="paymentMethod" value="Paystack" onclick="getpaymentmethod('paystack')">
                             <span class="checkround"></span>
                             </label>
                          </div>
                       </div>
                       <div class="col-sm-5">
                          <p  class="checkout_subtt">Subtotal <span style="float: right;">{{$currency->currency_sign}}. {{$total}}</span> </p>
                          <p class="checkout_subtt22">Service Charge <span class="checkout_subtt33">{{$currency->currency_sign}}. 20</span> </p>
                          <p class="checkout_tamt">Total Amount <span style="float: right;">{{$currency->currency_sign}}. {{$total + 20}}</span> </p>
                          <hr>
                          <center><button class="shadow check_placeorder" type="button" onclick="getOrderPlace()">PLACE ORDER</button></center>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
         </form>
      </div>
      <br><br>
      @include("web.footer")
      <script type="text/javascript">
         $.ajaxSetup({
                          headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
           });
           
           function getarea(the)
           {
               var city = $(the).val();
                $.ajax({
                    url: "{{ route('getarea') }}",
                    type:"POST",
                    data : {city:city},
                    success: function(result){
                       
                       $('#areadata').html(result.html);
                       $('#areadatafinal').html(result.html);
                     }
             });
           }
           function gettimeslot(date)
           {
                 $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });
                 $.ajax({
                    url: "{{ route('gettimeslot') }}",
                    type:"GET",
                    data:{datedata: date},
                    success: function(result){
                       $('#timedataslot').html(result);
                    }
                 });
             
              
           }
            function getpaymentmethod(method)
           {
               alert(method);
               if(method == 'stripe')
               {
                   $('#stripediv').css('display','block');
                   $('form').attr('action',"{{ route('stripe.post') }}");
                   $('form').attr('data-stripe-publishable-key',"{{ env('STRIPE_KEY') }}");
               }else if(method == 'razorpay')
               {
                   $('form').attr('action',"{{ route('addorder') }}");
               }else if(method == 'paypal')
               {
                   $('form').attr('action',"{!! URL::route('paypal') !!}");
               }
           }
           function getOrderPlace()
           {
               var paymentMethod = $('input[name=paymentMethod]:checked').val();
               alert(paymentMethod);
               if(paymentMethod == 'Stripe')
               {
                  alert(paymentMethod);
                         var $form = $(".require-validation");
                       
                           var $form = $(".require-validation"),
                           inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
                           $inputs = $form.find('.required').find(inputSelector),
                           $errorMessage = $form.find('div.error'),
                           valid = true;
                           $errorMessage.addClass('hide');
                           $('.has-error').removeClass('has-error');
         
                           $inputs.each(function(i, el) {
                               var $input = $(el);
                               
                               if ($input.val() === '') {
                                  
                                   $input.addClass('has-error');
                                   $errorMessage.removeClass('hide');
                                   e.preventDefault();
                               }
                           });
                           if (!$form.data('cc-on-file')) {
                             
                             Stripe.setPublishableKey("{{ env('STRIPE_KEY') }}");
                             Stripe.createToken({
                                 number: $('.card-number').val(),
                                 cvc: $('.card-cvc').val(),
                                 exp_month: $('.card-expiry-month').val(),
                                 exp_year: $('.card-expiry-year').val()
                             }, stripeResponseHandler);
                           }
                        
         
                         function stripeResponseHandler(status, response) {
                          
                             if (response.error) {
                               $('#errordiv').html('<div class="alert alert-danger text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">×</a><p>'+response.error.message+'</p><br></div>');
                                 $('.error')
                                     .removeClass('hide')
                                     .find('.alert')
                                     .text(response.error.message);
                             } else {
                                 /* token contains id, last4, and card type */
                                 var token = response['id'];
                                 $form.find('input[type=text]').empty();
                                 $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                                 $form.get(0).submit();
                             }
                         }
                       
               }else if(paymentMethod == 'Razorpay')
               {
                   
            
                    var SITEURL = '{{URL::to('')}}';
                    $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                    }); 
                    
                      var totalAmount = '{{$total + 20}}';
                      var product_id =  1;
                      var options = {
                      "key": "{{ env('RAZORPAY_KEY') }}",
                      "amount": (totalAmount*100), // 2000 paise = INR 20
                      "name": "W3Adda",
                      "description": "Payment",
                      "image": "http://w3adda.com/wp-content/uploads/2019/07/w3a-fb-dp.png",
                      "handler": function (response){
                               $('#OrderForm').submit();
                        
                      },
                     "prefill": {
                          "contact": '1234567890',
                          "email":   'xxxxxxxxx@gmail.com',
                      },
                      "theme": {
                          "color": "#528FF0"
                      }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                    e.preventDefault();
                    
                
               }else if(paymentMethod == 'COD')
               {
                   $('#OrderForm').submit();
               }      
               else if(paymentMethod ==  'Paystack')
               {
                   var handler = PaystackPop.setup({ 
                       key: 'pk_test_d734dbbececbaa4aaab0af7f5ef547940eb3e3c3', //put your public key here
                       email: 'customer@email.com', //put your customer's email here
                       amount: 20, //amount the customer is supposed to pay
                       metadata: {
                           custom_fields: [
                               {
                                   display_name: "Mobile Number",
                                   variable_name: "mobile_number",
                                   value: "+2348012345678" //customer's mobile number
                               }
                           ]
                       },
                       callback: function (response) {
                           //after the transaction have been completed
                           //make post call  to the server with to verify payment 
                           //using transaction reference as post data
                           $.post("{{ route('paystack')}}", {reference:response.reference}, function(status){
                               if(status == "success")
                                   //successful transaction
                                   window.location.href= "{{ url('/')}}";
                               else
                                   //transaction failed
                                   alert(response);
                           });
                       },
                       onClose: function () {
                           //when the user close the payment modal
                           alert('Transaction cancelled');
                       }
                   });
                   handler.openIframe();
               }
           }
      </script>
   </body>
</html>
<div class="modal fade" id="searchmap"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
   <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 46%;">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Address</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11880.492291371422!2d12.4922309!3d41.8902102!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x28f1c82e908503c4!2sColosseo!5e0!3m2!1sit!2sit!4v1524815927977" width="100%" height="370" frameborder="0" style="border:0" allowfullscreen></iframe>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addnew" data-dismiss="modal">CONFIRM</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="addnew"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 46%;">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add New Address
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form class="" method="POST" action="{{ route('adduseraddress') }}"  enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-body">
               <p style="font-size: 14px;margin-top: -5px;font-weight: 500">Contact Details</p>
               <div class="row">
                  <div class="col-sm-6">
                     <input type="text" name="name" id="search3" class="myaccount_input" placeholder="Enter Name">
                  </div>
                  <div class="col-sm-6">
                     <p>
                        <select class="myaccount_select99new">
                           <option>+91</option>
                        </select>
                        <input type="mobile" name="mobile" id="search3" class="myaccount_number" placeholder="Mobile Number">
                     </p>
                  </div>
               </div>
               <p style="font-size: 14px;margin-top: -5px;font-weight: 500">Address Details</p>
               <div class="row">
                  <div class="col-sm-6" style="margin-bottom: 15px;">
                     <input type="text" name="houseno" id="search3" class="myaccount_input" placeholder="Enter House No">
                  </div>
                  <div class="col-sm-6" style="margin-bottom: 15px;">
                     <input type="text" name="street" id="search3" class="myaccount_input" placeholder="Enter Street">
                  </div>
                  <div class="col-sm-6">
                     <p>
                        <select class="myaccount_select99" name="city" onchange="getarea(this)">
                           @foreach($city as $citydata)
                           <option value="{{ $citydata->city_id}}">{{ $citydata->city_name}}</option>
                           @endforeach
                        </select>
                     </p>
                  </div>
                  <div class="col-sm-6">
                     <select class="myaccount_select99" name="area" id="areadata">
                     </select>
                  </div>
                  <!-- <div class="col-sm-6" style="margin-bottom: 15px;">
                     <div class="frb frb-success" style="min-width: 32%;display: inline-block;">
                       <input type="radio" id="radio-button-6" checked="checked" name="radio-button" value="2">
                       <label for="radio-button-6" style="line-height: 14px;">
                          <i class="far fa-building" style="font-size: 10px;margin-left: 38px;"></i><br>
                         <span class="frb-title" >Apartment</span>
                       </label>
                     </div>
                     
                     <div class="frb frb-success" style="min-width: 32%;display: inline-block;">
                     <input type="radio" id="radio-button-5" name="radio-button" value="3">
                     <label for="radio-button-5" style="line-height: 14px;">
                     <i class="fas fa-home" style="font-size: 10px;margin-left: 38px;"></i><br>
                       <span class="frb-title" style="margin-left: 26px;">House</span>
                     </label>
                     </div>
                     
                     <div class="frb frb-success" style="min-width: 32%;display: inline-block;">
                     <input type="radio" id="radio-button-4" name="radio-button" value="4" style="display: none;">
                     <label for="radio-button-4" style="line-height: 14px;">
                       <i class="fas fa-industry" style="font-size: 10px;margin-left: 38px;"></i><br>
                       <span class="frb-title" style="margin-left: 27px;">Office</span>            </label>
                     </div>
                     
                     </div> -->
                  <!-- <div class="col-sm-6" style="margin-bottom: 15px;">
                     <input type="" name="" id="search3" class="myaccount_input" placeholder="Address Title (Optional)">
                     </div> -->
                  <div class="col-sm-6" style="margin-bottom: 15px;">
                     <input type="text" name="state" id="search3" class="myaccount_input" placeholder="Enter State">
                  </div>
                  <div class="col-sm-6" style="margin-bottom: 15px;">
                     <input type="text" name="pincode" id="search3" class="myaccount_input" placeholder="Enter Pincode">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-success" style="font-size: 14px !important;">SAVE ADDRESS</button>
            </div>
         </form>
      </div>
   </div>
</div>