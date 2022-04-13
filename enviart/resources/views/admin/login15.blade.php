<?php

$data=DB::table('users')->where('id','1')->first();  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../../assets/img/favicon.png">
  <title>
   Admin
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ URL::asset('public/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('public/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ URL::asset('public/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ URL::asset('public/assets/css/soft-ui-dashboard.css?v=1.0.4') }}" rel="stylesheet" />
</head>

<body class="bg-gray-100">
  <!-- Navbar -->
  <!--<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent mt-4">-->
  <!--  <div class="container">-->
  <!--    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">-->
  <!--      <span class="navbar-toggler-icon mt-2">-->
  <!--        <span class="navbar-toggler-bar bar1"></span>-->
  <!--        <span class="navbar-toggler-bar bar2"></span>-->
  <!--        <span class="navbar-toggler-bar bar3"></span>-->
  <!--      </span>-->
  <!--    </button>-->
  <!--  </div>-->
  <!--</nav>-->
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{ URL::asset('public/assets/img/curved-images/curved9.jpg') }}');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Welcome! <br><span> 
स्वागत</span></h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Sign in <br> 
साइन इन करें     </h5>
            </div>
            <div class="card-body">@if(session()->has('error'))
                    			<div class="alert alert-danger">
                    					{{ session()->get('error') }}
                    				</div>
                    			@endif
              <form role="form" class="text-start" action="{{ url('makelogin') }}" method="post">
                  @csrf
                <div class="mb-3">
                  <select name="type" class="form-control" aria-label="Password" style="font-weight: bold;">
                  	<option value="1">English</option>
					<option value="0">Hindi</option>
				</select>
                </div>
                <div class="mb-3">
                  <input name="email" type="email" class="form-control" placeholder="Email" aria-label="Email">
                </div>
                <div class="mb-3">
                  <input name="password" type="password" class="form-control" placeholder="Password" aria-label="Password">
                </div>
                <!--<div class="form-check form-switch">-->
                <!--  <input class="form-check-input" type="checkbox" id="rememberMe" value="1" name="lang_change">-->
                <!--  <label class="form-check-label" for="rememberMe">Remember me</label>-->
                <!--</div>-->
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-info w-100 my-4 mb-2">Sign in</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  
  <footer class="footer py-5">
    </footer>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--  -->
  <!--  <div class="container">-->
  <!--    <div class="row">-->
  <!--      <div class="col-8 mx-auto text-center mt-1">-->
  <!--        <p class="mb-0 text-secondary">-->
  <!--          Copyright © theAllsafe<script>-->
  <!--            document.write(new Date().getFullYear())-->
  <!--          </script> -->
  <!--        </p>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!---->
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="{{ URL::asset('public/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ URL::asset('public/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ URL::asset('public/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ URL::asset('public/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <!-- Kanban scripts -->
  <script src="../../../assets/js/plugins/dragula/dragula.min.js') }}"></script>
  <script src="{{ URL::asset('public/assets/js/plugins/jkanban/jkanban.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ URL::asset('public/assets/js/soft-ui-dashboard.min.js?v=1.0.4') }}"></script>
</body>

</html>
