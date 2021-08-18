<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Pharmacy | Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	
	<!-- ================== BEGIN core-css ================== -->
<link href="{{url('assets/css/app.min.css')}}" rel="stylesheet" />
	<!-- ================== END core-css ================== -->
	
</head>
<body>
	<!-- BEGIN #app -->
	<div id="app" class="app app-full-height app-without-header">
		<!-- BEGIN login -->
		<div class="login">
			<!-- BEGIN login-content -->
			<div class="login-content">
			     @if (count($errors) > 0)
                  @if($errors->any())
                    <div class="alert alert-primary" role="alert">
                      {{$errors->first()}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                  @endif
              @endif
				<form class="user" method="post" action="{{route('checkpharmacyLogin')}}">
				     {{csrf_field()}}
					<h1 class="text-center">Pharmacy Sign In</h1>
					<div class="text-muted text-center mb-4">
						For your protection, please verify your identity.
					</div>
					<div class="form-group">
						<label>Email Address</label>
						<input type="text" class="form-control form-control-lg fs-15px" value="" name="vendor_email" placeholder="username@address.com" />
					</div>
					<div class="form-group">
						<div class="d-flex">
							<label>Password</label>
						</div>
						<input type="password" class="form-control form-control-lg fs-15px" value="" name="vendor_pass" placeholder="Enter your password" />
					</div>
					<div class="form-group">
						<div class="custom-control custom-checkbox">
							<input class="custom-control-input" type="checkbox" value="" id="customCheck1" />
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-lg btn-block fw-500 mb-3">Sign In</button>
				
				</form>
			</div>
			<!-- END login-content -->
		</div>
		<!-- END login -->
		
		<!-- BEGIN btn-scroll-top -->
		<a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
		<!-- END btn-scroll-top -->
	</div>
	<!-- END #app -->
	
	<!-- ================== BEGIN core-js ================== -->
		<script src="{{url('assets/js/app.min.js')}}"></script>
	<!-- ================== END core-js ================== -->
	
</body>
</html>
