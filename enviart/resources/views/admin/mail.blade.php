<!DOCTYPE html>
<html lang="ar" @if(session('type')==0) dir="rtl"  @endif>

<head>
    <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('public/assets/img/apple-icon.png') }}') }}">
  <link rel="icon" type="image/png" href="{{ URL::asset('public/assets/img/favicon.png') }}">
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

<body class="g-sidenav-show  bg-gray-100  @if(session('type')==0) rtl  @endif">
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
<?php 
if(session('type')==0)
{     
    $td0="ID";
    $td1="Invoice number";
    $td2="Invoice date";
    $td3="Customer name";
    $td4="Invoice amount";
    $td5="VAT amount";
}
else  
{
    $td0="ID";
    $td1="Invoice number";
    $td2="Invoice date";
    $td3="Customer name";
    $td4="Invoice amount";
    $td5="VAT amount";
    $td6=0;
    $td7=0;
}
?>
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
			    <!-- Card header -->
            <div class="card-body px-0 pb-0">
              <div class="table-responsive">
                <table class="table table-flush" id="products-list">
                  <thead class="thead-light">
                    <tr>
                      <th>{{$td1}}</th>
                      <th>{{$td2}}</th>
                      <th>{{$td3}}</th>
                      <th>{{$td4}}</th>
                      <th>{{$td5}}</th>
                    </tr>
                  </thead>
                  <tbody>@foreach($row as $key => $value)
                    <tr>
                        <td>
                        <div class="d-flex">
                        <h6 class="my-auto">{{$value->id}}</h6>
                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                        <h6 class="my-auto">{{$value->created_at}}</h6>
                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                        <h6 class="my-auto">{{$value->customer_name}}</h6>
                        </div><?php $td6=$td6+$value->order_total_amount_due; $td7=$td7+$value->order_tax_per; ?>
                        </td>
                        <td class="text-sm">{{$value->order_total_amount_due}}</td>
                        <td class="text-sm">{{$value->order_tax_per}}</td>
                    </tr>@endforeach
                  </tbody>
                  <tbody>
                    <tr>
                        <td class="text-sm"></td>
                        <td class="text-sm"></td>
                        <td class="text-sm"></td>
                        <td>
                        <div class="d-flex">
                        <h6 class="my-auto">{{$td6}}</h6>
                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                        <h6 class="my-auto">{{$td7}}</h6>
                        </div>
                        </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 </main>
    @include('admin.include.footer')
    @include('admin.include.script') 

</body>

</html>