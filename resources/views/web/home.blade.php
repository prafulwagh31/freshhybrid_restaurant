<!DOCTYPE html>
<html>
   <head>
      <title>Home</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
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
<style type="text/css">
         @media only screen and (max-width: 768px) {
  .index_div
  {
   background-color: #FFEEE5;min-height: 313px !important;overflow: hidden;margin-top: 74px; 
  }
  .image_div_img,.index_side_img
  {
    display: none;
  }
  .index_order
  {
    margin-top: 30px;
  }
  .ser_nm,.index_phead
  {
    min-width: 100%;
  }
  .index_card
  {
    margin-top: -20px;margin-bottom: 20px;
  }
  .index_letgo
  {
    min-width: 100%;margin-left: 0px;
  }
  .tata_mob
  {
    min-width: 120%;
  }
  .lib-img-show,.index_card_next,.index_card_next2,.index_card_next3,.index_card_next4,.index_partner
  {
    min-width: 100%;
  }
  .lib-desc
  {
    margin-bottom: 20px;
  }
    .index_discover
  {
  width: 75%;margin-top: 100px;padding-top: 30px;height: 850px;
  }
  .secmob_img
  {
    display: none;
  }
  .secmob_img2
  {
    margin-top: 30px;margin-left: -28px;
  }
  #black_logo
  {
    margin-left: 40px;margin-bottom: 10px;
  }

         }
</style>
<div class="index_div">
 <div class="container-fluid">
    <div class="row">
       <div class="col-sm-2">
       <img src="{{ url('frontend/image/ban1.png') }}" class="image_div_img">
    </div>

    <div class="col-sm-8">
      <center>
          <h1 class="index_order">Order food online in UAE</h1>

    <div class="row justify-content-center ser_nm" style="margin-top: 34px;width: 90%;">
                        <div class="col-12 col-sm-10">
                            <form class="card index_card card-sm">
                                <div class="card-body row no-gutters align-items-center" style="margin-top: -7px;">
                                    <div class="col-auto">
                                        <i class="fas fa-map-marker-alt h4 text-body index_i12"></i>
                                    </div>
                                    <!--end of col-->
                                    <div class="col">
                                        <input class=" form-control-borderless index_input55" type="search" id="search3" placeholder="Search for area, street name, landmark...">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                         <i class="fab fa-centercode h4 text-body index_i90"></i>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-2"><button class="index_letgo">Let's go</button></div>
                        <!--end of col-->
                    </div>
      </center>
    </div>

    <div class="col-sm-2" style="">
       <img src="{{ url('frontend/image/ban2.png') }}" class="index_side_img">
    </div>
    </div>
 </div> 
</div>



<div class="container">
   <div class="row">
      <div class="col-sm-12">
         <h1 class="index_heading">Your everyday, right away</h1>

    <p class="index_phead">Order food and grocery delivery online from hundreds of restaurants and shops nearby.</p>


   <center> <img src="{{ url('frontend/image/a1.png') }}" height="48" style="margin-right: 10px;width: 150px;"> <img src="{{ url('frontend/image/g1.png') }}" height="48" style="width: 150px;"></center>
      </div>
   </div>
</div>


<div class="container" style="width: 73%;margin-top: 50px;">
   <div class="row">
     @foreach($vendordata as $vendordata)
       <div class="col-md-6 lib-item index_card_div2" data-category="view">
                <div class="lib-panel">
                    <div class="row box-shadow tata_mob">
                        <div class="col-md-6 index_card_next">
                          <a href="{{ route('grocerystore',$vendordata->ui_type) }}">
                            <img class="lib-img-show" src="{{ $vendordata->category_image }}">
                            </a>
                        </div>
                        <div class="col-md-6">
                            <div class="lib-row lib-header">
                                {{  $vendordata->category_name }}
                                <div class="lib-header-seperator"></div>
                            </div>
                            <div class="lib-row lib-desc">
                               Find deals, free delivery, and more from our partners.
                            </div>
                        </div>
                    </div>
                </div>
                
        </div>
     @endforeach
   </div>
</div>





<div class="container" style="margin-top: 50px;">
   <div class="row">
      <div class="col-sm-12">
         <h1 class="index_heading">Join us
</h1>

    <p class="index_phead">Be a part of the talabat story

</p>


      </div>
   </div>
</div>


<div class="container" style="width: 73%;margin-top: 10px;">
   <div class="row">


       <div class="col-md-6 lib-item index_card_div2"  data-category="view">
                <div class="lib-panel">
                    <div class="row box-shadow tata_mob">
                        <div class="col-md-6 index_partner">
                            <img class="lib-img-show" src="{{ url('frontend/image/f1.PNG') }}">
                        </div>
                        <div class="col-md-6">
                            <div class="lib-row lib-header">
                               Become a partner
                                <div class="lib-header-seperator"></div>
                            </div>
                            <div class="lib-row lib-desc">
                               Reach more customers and achieve growth with us

                               <button class="index_partner_button">Find out more</button>
                            </div>


                        </div>
                    </div>
                </div>
            </div>



       <div class="col-md-6 lib-item index_card_div2" data-category="view">
                <div class="lib-panel">
                    <div class="row box-shadow tata_mob">
                        <div class="col-md-6 index_partner" >
                            <img class="lib-img-show" src="{{ url('frontend/image/f2.PNG') }}">
                        </div>
                        <div class="col-md-6">
                            <div class="lib-row lib-header">
                               Build your career
                                <div class="lib-header-seperator"></div>
                            </div>
                            <div class="lib-row lib-desc">
                                Join the dynamic team that makes it all happen<br>
                                <button class="index_partner_button">Find jobs</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
   </div>
</div>

<div class="container index_discover">
<div class="row">
   <div class="col-sm-6">
 <h1 class="index_newh1">Discover the new talabat app</h1>
    <p class="index_newp16">Get what you need, when you need it.</p>


<img src="{{ url('frontend/image/a1.png') }}" height="48" id="black_logo" style="margin-right: 10px;width: 150px;"> <img src="{{ url('frontend/image/g1.png') }}" id="black_logo" height="48" style="width: 150px;">


   </div>


   <div class="col-sm-3 secmob_img2" style="z-index: 999;">
               <img src="{{ url('frontend/image/phone2.png') }}" class="phonetwo2">
               <img src="{{ url('frontend/image/3.jpg') }}" class="main_image_sec2" id="image_one">
            </div>
            <div class="col-sm-3 secmob_img" style="margin-left: -45px;">
               <img src="{{ url('frontend/image/phone2.png') }}" class="phonetwo">
               <img src="{{ url('frontend/image/1.jpg') }}" class="main_image_sec" id="image_one">
            </div>
</div>

</div>



  @include("web.footer")
   </body>
</html>