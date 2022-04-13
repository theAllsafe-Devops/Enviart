<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://ekan-admin-templates.multipurposethemes.com/images/favicon.ico">

    <title>Admin - Log in </title>
  
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="{{ URL::asset('admin_assets/assets/vendor_components/bootstrap/dist/css/bootstrap.min.css') }}">
	
	<!-- Bootstrap extend-->
	<link rel="stylesheet" href="{{ URL::asset('admin_assets/css/bootstrap-extend.css') }}">
	
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ URL::asset('admin_assets/css/master_style.css') }}">

	<!-- Ekan Admin skins -->
	<link rel="stylesheet" href="{{ URL::asset('admin_assets/css/skins/_all-skins.css') }}">	


</head>
<body class="hold-transition dark bg-img" style="background-image: url({{ URL::asset('admin_assets/images/auth-bg/bg.jpg') }})" data-overlay="3">
	
	<div class="auth-2-outer row align-items-center h-p100 m-0">
		<div class="auth-2">
		    <div class="text-center text-dark">
    		</div>
    		<!-- /.social-auth-links -->
    
    		<div class="margin-top-30 text-center">
    		</div>
		  <div class="auth-logo font-size-30">
			<b>Admin</b>
		  </div>
		  <!-- /.login-logo -->
		  <div class="auth-body">
			<p class="auth-msg"></p>

			<form action="{{ url('admin/forgot/password') }}" method="post" class="form-element">
			    @csrf
			     @if(session()->has('error'))
    			<div class="alert alert-danger">
    					{{ session()->get('error') }}
    				</div>
    			@endif
			  <div class="form-group has-feedback">
				<input type="email" class="form-control" placeholder="Email" name="email">
				<span class="ion ion-email form-control-feedback"></span>
			  </div>
			  
			  <div class="row">
				<!-- /.col -->
				<div class="col-6">
				 <div class="fog-pwd">
				     <p><i class="ion ion-locked"></i>  <a href="{{ URL::asset('/') }}" class="text-info m-l-5">Sign in</a></p>
				  </div>
				</div>
				<!-- /.col -->
				<div class="col-12 text-center">
				  <button type="submit" class="btn btn-block mt-10 btn-success">Submit</button>
				</div>
				<!-- /.col -->
			  </div>
			</form>
		  </div>
		</div>
	
	</div>
	

	<!-- jQuery 3 -->
	<script src="{{ URL::asset('admin_assets/assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js') }}"></script>
	
	<!-- popper -->
	<script src="{{ URL::asset('admin_assets/assets/vendor_components/popper/dist/popper.min.js') }}"></script>
	
	<!-- Bootstrap 4.0-->
	<script src="{{ URL::asset('admin_assets/assets/vendor_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

</body>
</html>
