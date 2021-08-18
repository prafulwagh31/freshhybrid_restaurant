<!DOCTYPE html>
<html>
   <head>
      <title>Home</title>
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
        @endphp 

<style type="text/css">
 
.add_but {
  min-height: 27px;
  background-color: #3167eb;
  width: 85px;
  border: 0;
  font-size: 10.6px;
  color: white;
  border-radius: 20px;
  position: relative;
  top: 3px;
  left: -2px;
  font-weight: 700;
 
}
.project-tab #tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #FF5A00;
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 2px solid #FF5A00 !important;
    font-size: 14px;
    font-weight: 500;
}
.project-tab .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: rgb(145, 145, 145);
    font-size: 14px;
    font-weight: 500;
}

</style>
 <style type="text/css">
           @media only screen and (max-width: 768px) {
    .checkout_cont
  {
  width: 94.4%;
  }
  .restro_nav55
  {
min-width: 100%;overflow:scroll;
  }
  .all_restmob
  {
   min-width: 400px !important;margin-left: 10px !important;
  }
  .restro_nav33
  {
min-width: 100%;overflow:scroll;
margin-top: 30px;
  }
           }
           .all_restmob
           {
width: 50%;margin-left: 170px;
           }
 </style> 

<div class="container-fluid shadow checkout_cont" >

  <div class="row">
  <div class="col-sm-12" >
   
      <p class="checkout_p99">Home  &nbsp; <i class="fas fa-chevron-right" style="color: #FF5A00;font-size: 12px;"></i> &nbsp; Al Ghuwair</p> 
    
  </div>   
</div>



<div class="row">
  <div class="col-sm-12" >
    <div class="all_restro">
      <h1 style="font-size: 22px;letter-spacing: .3px;">Restaurants in Al Ghuwair
</h1> 
    </div>
  </div>   
</div>

<div class="row" style="margin-top: 26px;">
  <div class="col-sm-3">
<form class="card card-sm shadow-sm restro_form88" method="POST">
                                <div class="card-body row no-gutters " style="margin-top: -14px;">
                                   
                                    <div class="col">
                                        <input class=" form-control-borderless allrestro_input" type="search" id="search4" placeholder="Search Product">
                                    </div>
                                    <!--end of col-->
                                    @php 
                                      $searchproduct = Request::route('id');
                                    @endphp
                                    <div class="col-auto">
                                      <span onclick="getproductthroughname('{{$searchproduct}}')">
                                         <i class="fas fa-search h4 text-body restro_i88" ></i></span>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>



                            <div class="card shadow-sm filter_pro_duct1212 product_mob_card2" style="margin-top: 15px !important;">
                  <h5 class="side_filter restro_side">Categories  </h5>
                  <div class="card-body side_price_scroll">
                     <form>
                      @foreach($category as $categoryval)
                        
                            @php $catgory_id = $categoryval->category_id; @endphp 
                            
                        <input type="checkbox" id="fruit1" name="categories[]" value="9" onclick="getcategoryproduct('{{$catgory_id }}')">
                        <label for="fruit1">
                          <span>
                            
                                    {{$categoryval->category_name}} 
                                 
                          </span>
                        </label>
                        @endforeach
                     </form>
                  </div>
               </div>


              <!--  <div class="card shadow-sm filter_pro_duct1212 product_mob_card2" style="margin-top: -10px !important;">
                  <h5 class="side_filter" style="background-color: white; margin-left: 12px;font-size: 16.5px;">Cuisines  </h5>
                  <div class="card-body side_price_scroll">
                     <form>
                        <input type="checkbox" id="fruit1" name="fruit-1" value="Apple">
                        <label for="fruit1"><span>All</span> <span style="float: right;">47</span></label>


                        <input type="checkbox" id="fruit1" name="fruit-1" value="Apple">
                        <label for="fruit1"><span>Arebic</span> <span style="float: right;">23</span></label>



                        <input type="checkbox" id="fruit1" name="fruit-1" value="Apple">
                        <label for="fruit1"><span>Ramadan Deals</span> <span style="float: right;">7</span></label>


                        <input type="checkbox" id="fruit1" name="fruit-1" value="Apple">
                        <label for="fruit1"><span>Pharmacies</span> <span style="float: right;">27</span></label>


                         <input type="checkbox" id="fruit1" name="fruit-1" value="Apple">
                        <label for="fruit1"><span>Super Saver</span> <span style="float: right;">23</span></label>



                        <input type="checkbox" id="fruit1" name="fruit-1" value="Apple">
                        <label for="fruit1"><span>Ramadan Deals</span> <span style="float: right;">7</span></label>


                        <input type="checkbox" id="fruit1" name="fruit-1" value="Apple">
                        <label for="fruit1"><span>Pharmacies</span> <span style="float: right;">27</span></label>



                         <input type="checkbox" id="fruit1" name="fruit-1" value="Apple">
                        <label for="fruit1"><span>Super Saver</span> <span style="float: right;">23</span></label>



                        <input type="checkbox" id="fruit1" name="fruit-1" value="Apple">
                        <label for="fruit1"><span>Ramadan Deals</span> <span style="float: right;">7</span></label>


                        <input type="checkbox" id="fruit1" name="fruit-1" value="Apple">
                        <label for="fruit1"><span>Pharmacies</span> <span style="float: right;">27</span></label>
                        
                     </form>
                  </div>
               </div> -->

  </div>

  <div class="col-sm-9">

<section id="tabs" class="project-tab" style="border-top:1px solid #E0E0E0;">
            <div class="container" >
                <div class="row">
                    <div class="col-md-12">
                        <nav class="restro_nav33">
                            <div class="nav nav-tabs nav-fill all_restmob" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-shopping-basket"></i> &nbsp;PRODUCTS</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-bicycle"></i>  &nbsp;WEBSITE GO</a>
                                
                            </div>
                     </nav>

<div class="restro_nav55">
  
  <table class="table" style="width: 720px;">
    
    <tbody>
      <tr style="font-size: 13px;">
        <td><b style="font-size: 15px;">Sort By:</b></td>
        <td>Recommended</td>
        <td>Rating</td>
        <td>Newest</td>
        <td>A to Z</td>
        <td>Min.Order Amount</td>
        <td>Fastest Delivery</td>
      </tr>
     
    </tbody>
  </table>

</div>


<div id="msgdiv"></div>
  <div class="tab-content restro_tabmount" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <table class="table table-hover" cellspacing="0">
              <tbody>
                @foreach($product as $productval)
                  <tr style="border: 1px solid #DEE2E6">
                    <td style="width: 10%;"><div style="margin-top: 20px;"><span class="restro_tr3"><img src="{{ asset($productval->product_image)}}" class="restrotr3_img"></span></div></td>
                    <td style="width: 89%;">
                      <h4 class="restrohfour">{{$productval->product_name}}</h4> 
                      <p class="restrohfour_indian">Indian, Grills</p>

                      <p class="restro_track">{{$currency->currency_sign}}.{{$productval->price}}</p>
                      <p class="restro_min22"><s>{{$currency->currency_sign}}.{{$productval->strick_price}}</s></p>
                      <button type="button" class="add_but"  onclick="addtobag('{{ $productval->vendor_id }}','{{ Auth::id() }}','{{ $productval->product_id }}',1,1,'{{$productval->varient_id}}','{{$productval->ui_type}}')">Add to bag</button>
                    </td>                                          
                  </tr>
                @endforeach
              </tbody>
          </table>
      </div>
      <div class="tab-pane fade" style="margin-top: 20px;" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          <div class="row">
            <div class="col-sm-6">
              <img src="{{ url('frontend/image/n1.jpg') }}" class="restro_imgn1">
              <h4 class="restro_imghrr">Calicut Park Restaurant <span class="restro_imghrr22"><i class="fas fa-bicycle"></i>Within 32 mins</span></h4> 
              <p class="restrohfour_indian">Indian, Grills</p>
              <p class="restro_pam"><span class="restro_spannew">NEW</span> <img src="{{ url('frontend/image/sm.PNG') }}" height="20"> Amazing &nbsp;Service: Free   &nbsp;Min: 0.00</p>
              <p style="margin-bottom: 14px;" class="restro_track">Live Tracking &nbsp; Contactless drop-off</p>
            </div>
            <div class="col-sm-6">
              <img src="{{ url('frontend/image/n2.jpg') }}" class="restro_imgn1">
              <h4 class="restro_imghrr">Calicut Park Restaurant <span class="restro_imghrr22"><i class="fas fa-bicycle"></i>Within 32 mins</span></h4> 
              <p class="restrohfour_indian">Indian, Grills</p>
              <p class="restro_pam"><span class="restro_spannew">NEW</span> <img src="{{ url('frontend/image/sm.PNG') }}" height="20"> Amazing &nbsp;Service: Free   &nbsp;Min: 0.00</p>
              <p style="margin-bottom: 14px;" class="restro_track">Live Tracking &nbsp; Contactless drop-off</p>
            </div>
            <div class="col-sm-6">
              <img src="{{ url('frontend/image/n1.jpg') }}" class="restro_imgn1">
              <h4 class="restro_imghrr">Calicut Park Restaurant <span class="restro_imghrr22"><i class="fas fa-bicycle"></i>Within 32 mins</span></h4> 
              <p class="restrohfour_indian">Indian, Grills</p>
              <p class="restro_pam"><span class="restro_spannew">NEW</span> <img src="{{ url('frontend/image/sm.PNG') }}" height="20"> Amazing &nbsp;Service: Free   &nbsp;Min: 0.00</p>
              <p style="margin-bottom: 14px;" class="restro_track">Live Tracking &nbsp; Contactless drop-off</p>
            </div>
            <div class="col-sm-6">
              <img src="{{ url('frontend/image/n2.jpg') }}" class="restro_imgn1">
              <h4 class="restro_imghrr">Calicut Park Restaurant <span class="restro_imghrr22"><i class="fas fa-bicycle"></i>Within 32 mins</span></h4> 
              <p class="restrohfour_indian">Indian, Grills</p>
              <p class="restro_pam"><span class="restro_spannew">NEW</span> <img src="{{ url('frontend/image/sm.PNG') }}" height="20"> Amazing &nbsp;Service: Free   &nbsp;Min: 0.00</p>
              <p style="margin-bottom: 14px;" class="restro_track">Live Tracking &nbsp; Contactless drop-off</p>
            </div>
            <div class="col-sm-6">
              <img src="{{ url('frontend/image/n2.jpg') }}" class="restro_imgn1">
              <h4 class="restro_imghrr">Calicut Park Restaurant <span class="restro_imghrr22"><i class="fas fa-bicycle"></i>Within 32 mins</span></h4> 
              <p class="restrohfour_indian">Indian, Grills</p>
              <p class="restro_pam"><span class="restro_spannew">NEW</span> <img src="{{ url('frontend/image/sm.PNG') }}" height="20"> Amazing &nbsp;Service: Free   &nbsp;Min: 0.00</p>
              <p style="margin-bottom: 14px;" class="restro_track">Live Tracking &nbsp; Contactless drop-off</p>
            </div>
          </div>
      </div>
  </div>
                    </div>
                </div>
            </div>
        </section>

  </div>
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
  function addtobag(storeid,user_id,pid,count,qty,varientid,ui_type)
    { 
        
        
        if(user_id == 0)
        {
           $('#msgdiv').html('<div class="alert alert-danger">Please Login !!! </div>');
        }else
        {
           $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
           });
           $.ajax({
              url: "{{ route('addtobag') }}",
              type:"POST",
              data:{store_id:storeid,user_id:user_id,pid:pid,qty:qty,varient_id:varientid,ui_type:ui_type},
              success: function(result){
                 // var obj = JSON.parse(result);
                 if(result.code == 200)
                 {
                    
                    $('#msgdiv').html('<div class="alert alert-success">Product added to cart successfully</div>');
                    $('#cart-count').html(result.cartcount);
                     $('#groceryhtml').append(result.cart_html);
 
                 }else if(result.code == 400){
                    $('#msgdiv').html('<div class="alert alert-danger">Product allready added to cart </div>');
                   
                 }else
                 {
                   $('#msgdiv').html('<div class="alert alert-danger">Something went wrong</div>');
                   
                 }
 
              }
           });
        }
    }
    function getcategoryproduct(ui_type,category_id)
        {
            $.ajax({
                 url: "{{ route('getcategoryproduct') }}",
                 type:"POST",
                 data:{ui_type: ui_type,category_id:category_id},
                 success: function(result){
                      $('#productdatadiv').html(result.html);
                      $('#pagination').css('display','none');
                  }
            });
        }
        function getproductthroughname(ui_type)
        {
            var productname = $('#productname').val();
            var vendorid = $('#vendorid').val();
            $.ajax({
                 url: "{{ route('getproductthroughname') }}",
                 type:"POST",
                 data:{ui_type: ui_type,productname:productname,vendorid:vendorid},
                 success: function(result){
                      $('#productdatadiv').html(result.html);
                      $('#pagination').css('display','none');
                  }
            });
        }
</script>
 </body>
</html>