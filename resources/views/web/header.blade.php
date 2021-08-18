 <style type="text/css">
       @media only screen and (max-width: 768px) {
       .main_logo77
       {
        left: -165px;position: relative;
       }
       .but_tin
       {
       margin-left: 260px;margin-top: -44px;
       }
       .nav-item
       {
        margin-top: -10px;
       }
       .My_acc
       {
        left: -15px;position: relative;
       }
       .dropdown-content
       {
        margin-left: 0px;
       }

       }
       .main_logo77
       {
        margin-left: 162px;margin-right: 110px;
       }
       .icon-sm
       {
        width: 48px;height: 48px;line-height: 48px !important;font-size: 20px;
        display: inline-block;
        text-align: center;
        flex-shrink: 0;
        flex-grow: 0;
        margin-top: 6px;
       }
       .rounded-circle {
        border-radius: 50% !important;
        }
   </style>
@php

  $vendordata = DB::table('vendor_category')->get();
  $cartdetails = DB::table('cart')->join('product_varient','product_varient.varient_id', '=', 'cart.varient_id')->join('product','product.product_id', '=', 'cart.product_id')->select('cart.*', 'product_varient.*','product.*')->where(['cart.user_id' => Auth::id()])->get();
@endphp
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #FF5A00;border:0;">
  <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ url('frontend/image/logo.PNG') }}" height="48" class="main_logo77"></a>
  <button class="navbar-toggler but_tin" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto" >
      @foreach($vendordata as $vendordata)
      <li class="nav-item active">
        <a class="nav-link nav_menu2" href="{{ route('grocerystore',$vendordata->ui_type) }}">{{  $vendordata->category_name }}</a>
      </li>
      @endforeach
     
      @if(is_null(Auth::id()))
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#login99"><button class="nav_button2">Login</button></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}"><button class="nav_button2">Register</button></a>
      </li>
      @else
      <li class="nav-item pl-6">
        <a href="{{ route('cart',3) }}" class="icon icon-sm rounded-circle border" style="color: #ffffff;">
          <i class="fas fa-shopping-cart"></i>
        </a>
        <span class="badge badge-pill badge-danger notify" id="cart-count" style="position: absolute;top: 12px;margin-left: -13px;color: #fff;background-color: #000000;">{{ count($cartdetails)}}</span>
      </li>  
      <li class="nav-item My_acc" style="margin-left:16px;">
          <div class="dropdown" style="height: 32px;">
            <p style="margin-top: -5px;color: white;font-size: 16px; font-weight: 500;">My Account&nbsp; <i class="far fa-user-circle"></i></p>
            <div class="dropdown-content" >
                <a href="my_account.php" class="drop_anchor"><i class="fab fa-opencart" style="color: #FF5A00;"></i> &nbsp; My Orders</a>
                <a href="my_account.php" class="drop_anchor"><i class="far fa-user-circle" style="color: #FF5A00;"></i> &nbsp; &nbsp;Account info</a>
                <a href="my_account.php" class="drop_anchor"><i class="fas fa-map-marked-alt" style="color: #FF5A00;"></i>&nbsp;&nbsp;&nbsp; Saved Address</a>
                <a href="#"><i class="fas fa-sign-out-alt" style="color: #FF5A00;"></i>&nbsp; &nbsp; Logout</a>
            </div>
          </div>
      </li>
      @endif
  </ul>
    
  </div>
</nav>

<div class="modal fade" id="login99" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog login_modal" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom:0;">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
      <div class="modal-body">
        <center>
          <p class="login_modal_p">Login</p>
         

        <button class="shadow-sm login_modal_google"><img src="{{ url('frontend/image/g2.PNG') }}" height="26" style="float: left;"> Continue with Google</button>


         <button class="shadow login_modal_facebook"><i class="fab fa-facebook con_with"></i> Continue with Facebook</button>

         <p style="text-align: center;margin-top: 23px;">OR</p>

         <form method="POST" action="{{ route('front.login') }}">
          {{ csrf_field() }}
          <div class="form-group">
           <input type="mobile" name="user_phone" class="login_modal_input" placeholder="Mobile">
          </div> 
          <span style="color:red;">{{ $errors->first('user_phone') }}</span>
          <div class="form-group">
            <input type="password" name="password" class="login_modal_input2" placeholder="Password">
          </div>  
          <span style="color:red;">{{ $errors->first('password') }}</span>
          <a href="forgot_pass.php" data-toggle="modal" data-target="#forgot" data-dismiss="modal"> <p class="login_forgot">Forgot password?</p></a>


         <button type="submit" class="shadow login_butt99">Login</button>
         </form>

<p class="index_create">Don't have an account? <a href="signup.php" style="color: #FF5A00;text-decoration: none;">Create an account</a></p>


         </center>    
      </div>
      
    </div>
  </div>
</div>




<div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="min-width: 35%;margin-top: 40px;">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom:0;">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <center>
          <p class="login_modal_p">Forgotten Password</p>
         <input type="" name="" class="index_fo_input55" placeholder="Email">
         <button class="shadow index_forgotbut33">RESET YOUR PASSWORD</button>
      <p class="index_forgotbut33_p">Enter your email address and we’ll send a link to change your password</p>

         </center>    
      </div>
    </div>
  </div>
</div>