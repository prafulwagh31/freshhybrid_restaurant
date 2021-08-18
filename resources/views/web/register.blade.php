<!DOCTYPE html>
<html>
   <head>
      <title>Register</title>
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
  <style type="text/css">
            @media only screen and (max-width: 768px) {
    .contact_head
  {
  width: 94.4%;
  }
   .signup_terms
  {
 width: 80%;position: relative;left: 0px; 
  }
    .signup_gender212
  {
    width: 100%;left: -49px;position: relative;
  }

}
  </style>
      @include("web.header")


<div class="container-fluid shadow contact_head">
  @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
          @endif
          @if(session()->has('message'))
          <div class="alert alert-success">
              {{ session()->get('message') }}
          </div>
          @endif
<div class="row">
  <div class="col-sm-12" >
    <div class="all_restro">
      <h1 style="font-size: 22px;letter-spacing: .3px;">Create an Account</h1> 
    </div>
  </div>   
</div>


<div class="row">
  <div class="col-sm-12">
<center>
    <button class="shadow-sm signup_google"><img src="{{ url('frontend/image/g2.PNG') }}" height="26" style="float: left;"> Continue with Google</button>


         <button class="shadow signup_facebook"><i class="fab fa-facebook" style="font-size: 24px;float: left;padding-left: 3px;"></i> Continue with Facebook</button>
<p class="web_heading_p"><span style="background-color: white;padding: 0 10px;">OR</span></p>
        
   <form style="margin-top: 30px;" method="POST" action="{{ route('registerdata') }}">
    {{ csrf_field() }}
  <div class="form-group" style="width: 80%;">
    <label for="exampleInputEmail1" class="signup_input99">Name <span style="color: #FF5A00;">*</span></label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user_name" placeholder="Enter Name">
    <span style="color:red;">{{ $errors->first('user_name') }}</span>
  </div>
  <div class="form-group" style="width: 80%;">
    <label for="exampleInputEmail1" class="signup_input99">Email <span style="color: #FF5A00;">*</span></label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user_email" placeholder="Enter Email">
    <span style="color:red;">{{ $errors->first('user_email') }}</span>
  </div>
  <div class="form-group" style="width: 80%;">
    <label for="exampleInputEmail1" class="signup_input99">Mobile <span style="color: #FF5A00;">*</span></label>
    <input type="mobile" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user_phone" placeholder="Enter Mobile Number">
    <span style="color:red;">{{ $errors->first('user_phone') }}</span>
  </div>
  <div class="form-group" style="width: 80%;">
    <label for="exampleInputEmail1" class="signup_input99">Password <span style="color: #FF5A00;">*</span></label>
   <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user_password" placeholder="Enter Password">
   <span style="color:red;">{{ $errors->first('user_password') }}</span>
  </div>
  <!-- <div class="form-group" style="width: 80%;">
    <label for="exampleInputEmail1" class="signup_input99">Confirm Password <span style="color: #FF5A00;">*</span></label>
   <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Confirm Password">
  </div>
  <div class="form-group signup_gender212">
      <label for="exampleInputEmail1" >Gender <span style="color: #FF5A00;">*</span></label><br>
      <div class="form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="optradio">Male
        </label>
      </div>
      <div class="form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="optradio">Female
        </label>
      </div>
  </div>
  <div class="form-group" style="width: 80%;">
    <label for="exampleInputEmail1" class="signup_input99">Date of Birth <span style="color: #FF5A00;">*</span></label>
   <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Mobile">
  </div> -->

  <p class="signup_terms">By creating an account you agree to the privacy policy and to the <span style="color: #FF5A00;">terms of use</span></p>

<button type="submit" class="shadow signup_button">Create your account</button>

 <p class="signup_login">Already have an account? <span style="color: #FF5A00;cursor: pointer;" data-toggle="modal" data-target="#login99">Login</span></p>


</form>
</center>
  </div>

</div>

 </div>
<br><br>
  @include("web.footer")
 </body>
</html>