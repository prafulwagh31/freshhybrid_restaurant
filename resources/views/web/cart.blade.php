<!DOCTYPE html>
<html>
   <head>
      <title>Cart</title>
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
   
      <p class="checkout_p99">Home  &nbsp; <i class="fas fa-chevron-right" style="color: #FF5A00;font-size: 12px;"></i>  &nbsp; Cart</p> 
    
  </div>   
</div>
<div id="msgdiv"></div>
    <div class="row" style="margin-top: 31px;">
          <aside class="col-lg-8">
            <form id="updatecartform">
              <div class="card">
                  <table class="table table-borderless table-shopping-cart table-responsive">
                      <thead class="text-muted">
                          <tr class="small text-uppercase">
                              <th scope="col" style="width: 300px;">Product</th>
                              <th scope="col" style="width: 120px;">Quantity</th>
                              <th scope="col" style="width: 120px;">Price</th>
                              <th scope="col" style="width: 120px;">Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @php $total = 0; @endphp
                                @foreach($cartdetails as $i =>  $cartdetails)
                                  <tr>
                                      <th scope="row ycart_th">
                                           <img src="{{ asset($cartdetails->product_image)}}" class="ycart_img">
                                        <input type="hidden" name="cart_id[]" value="{{$cartdetails->cart_id}}">
                                        
                                        <input type="hidden" name="product_id[]" value="{{$cartdetails->product_id}}">
                                        
                                         <div style="display: inline-block;margin-left: 15px;">
                                            <p style="font-size: 17px;">{{$cartdetails->product_name}}</p>
                                            
                                         </div>
                                      </th>
                                      <td>
                                           <div class="btn-group btn-group-sm outer_but772" style="padding-top:12px;left: -10px;" role="group" aria-label="...">
                                                          <button  type="button" class="inner_one2 inner_data_one<?php echo $i; ?>" onclick="getminus('<?php echo $i; ?>',{{$cartdetails->price}})"><i class="fa fa-minus inner_one_i2" ></i></button>
                                                          <button  type="button" class="inner_two2" ><span class="inner_two_span2 inner_two_span_data<?php echo $i; ?>">{{$cartdetails->qty}}</span>
                                                          </button>
                                                          <button   type="button" class="inner_three2 inner_data_two<?php echo $i; ?>" onclick="getplus('<?php echo $i; ?>',{{$cartdetails->price}})"><i class="fa fa-plus inner_three_i2" ></i></button>
                                                      </div>
                                      </td>
                                      <td style="padding-top: 27px;">
                                         <p class="ycart_price" id="baseprice<?php echo $i; ?>">{{$currency->currency_sign}}. {{$cartdetails->price * $cartdetails->qty}}</p>
                                      </td>
                                      <td><i class="fas fa-trash-alt" onclick="groceryremovecartitem('{{ $cartdetails->cart_id}}')" style="margin-top: 20px;margin-left: 14px;cursor: pointer;"></i></td>
                                   </tr>
                                   <input type="hidden" id="basepricehidden<?php echo $i; ?>">
                                   @php $total += $cartdetails->price * $cartdetails->qty @endphp
                                   @endforeach
                    </tbody>
                  </table>
                   <div class="row"><div class="col-lg-10"></div>
                          <div class="col-lg-2"><button class="btn btn-primary" type="button" style="margin-left: -50px;margin-bottom: 15px;" onclick="updatecart('{{$cartcount}}')">Update Cart</button></div></div>
                  <div class="card-body border-top">
                      <p class="icontext"><i class="icon text-success fa fa-truck"></i> Free Delivery within 1-2 weeks</p>
                  </div>
                  <!-- card-body.// -->
              </div>
            </form>
          </aside>
          <!-- col.// -->
          <div class="col-sm-4">
    <div class="card shadow-sm restrodet_card_cart" id="target">
        <div class="restrodet_ycart"><p class="restrodet_ycart2">Your Cart </p></div>
          <div class="restrocart_al"><p class="restrocart_al2">Total</p></div>
          
      <div class="restro_back2u">
        <p  class="restro_stotal">Subtotal <span style="float: right;">{{$currency->currency_sign}}. {{$total}}</span> </p>
        <p class="restro_charge">Service Charge <span class="restro_charge_float">{{$currency->currency_sign}}. 20</span></p>
        <p class="restrodet_df">Total Amount <span style="float: right;">{{$currency->currency_sign}}. {{$total + 20}}
        </span> </p>
        <center><a href="{{ route('checkout',1) }}"><button class="shadow restro_proceed">PROCEED TO CHECKOUT</button></a></center>
      </div>
  </div>
</div>
          <!-- col.// -->
      </div>
 </div>
<br><br>
  @include("web.footer")
  <script type="text/javascript">
$.ajaxSetup({
               headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
  });
    function groceryremovecartitem(cartid)
  {
    $.ajax({
         url: "{{ route('removecartitem') }}",
         type:"POST",
         data:{cartid: cartid},
         success: function(result){
              if(result == 1)
              {
                alert('Item Remove From Cart Successfully');
                location.reload();
              }else
              {
                alert('Somthing Went Wrong');
                location.reload();
              }
          }
    });
  }
    function getminus(count,baseprice)
  {
    var data = $('.inner_two_span_data'+count).html();
    
    
    if(data > 0)
    {
       var minusdata = parseInt(data) - 1;
       $('.inner_two_span_data'+count).html(minusdata);
       var total = parseFloat(baseprice) * parseFloat(minusdata);
       $('#baseprice'+count).html('{{$currency->currency_sign}}. '+total);
       $('#basepricehidden'+count).val(total);
       
    }else 
    {
       $('.inner_two_span_data'+count).html(0);
        var total = parseFloat(baseprice) * 0;
       $('#baseprice'+count).html('{{$currency->currency_sign}}. '+total);
       $('#basepricehidden'+count).val(total);
    }
   
  }
  function getplus(count,baseprice)
  {
    var data = $('.inner_two_span_data'+count).html();
    
    var plusdata = parseInt(data) + 1;
    $('.inner_two_span_data'+count).html(plusdata);
    var total = parseFloat(baseprice) * parseFloat(plusdata);
    $('#baseprice'+count).html('{{$currency->currency_sign}}. '+total);
    $('#basepricehidden'+count).val(total);
  }
    function updatecart(count)
  {
      var qtyarray = [];
      var pricearray = [];
      var total = 0;
      for(var i=0;i < count;i++)
      {
          var qty = $('.inner_two_span_data'+i).html();
          var price = $('#basepricehidden'+i).val();
          qtyarray.push(qty);
          pricearray.push(price);
          var totprice = $('#baseprice'+i+'').html();
          
          total = parseFloat(total) + parseFloat(totprice.slice(3)) ;
      }
     
      var Finaltotal = parseFloat(total) + parseFloat(20)
      $.ajax({
             url: "{{ route('updatecart') }}",
             type:"POST",
             data : $('#updatecartform').serialize() + "&qty="+qtyarray+"&price="+pricearray,
             success: function(result){
                 if(result.status == 'success')
                 {
                    $('#msgdiv').html('<div class="alert alert-success col-md-3">Cart updated successfully !!!</div>');
                    $('.total-price-js').html('{{$currency->currency_sign}}. '+ total);
                    $('.total-js').html('{{$currency->currency_sign}}. '+ Finaltotal );
                 }
              }
      });
      
  }
  </script>
 </body>
</html>