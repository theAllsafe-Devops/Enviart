<?php $data=DB::table('users')->where('id','1')->first();  
$qr=QrCode::generate("https://gulfbills.com".$_SERVER['REQUEST_URI']); 
$t1="تفاصيل الفاتورة";
$t2="اسم البائع";
$t3="الرقم الضريبي";
$t4="وقت/تاريخ الفاتورة";
$t5="مبلغ الفاتورة (مع الضريبة)";
$t7="ريال سعودي ";
$t6="مبلغ الضريبة";
$print="طباعة";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
table {
  border: 1px solid black !important;
  padding:0px !important;

}
.page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
            overflow: hidden;
        }
</style>
  @include('admin.include.head')
</head>

<body class="g-sidenav-show bg-gray-100">
  <main class="main-content max-height-vh-100 h-100">
    <div class="container-fluid my-3 py-3">
      <div class="row">
        <div class="col-md-4 col-sm-12 mx-auto">
          <form class="" method="post">
            <div class="card page" id="printarea">
              <div class="card-header">
                <div class="row justify-content-between">
                  <div class="col-4 col-md-4 text-md-end text-start" style="text-align: left !important;">
                    <h6 class="d-block mt-2 mb-0"> </h6>
                    <span class="text-secondary"></span><br>
                  </div>
                  <div class="col-3">
                    <!--<span class="w-100" alt="Logo" style="font-size: 102px;">&#128522;</span>-->
                  </div>
                  <div class="col-5 col-md-5 text-md-end text-end">
                    <h6 class="d-block mt-2 mb-0"></h6>
                    <span class="text-secondary">
                    </span><br>
                    <span class="text-dark text-secondary"></span>
                  </div>
                </div>
                <div class="row justify-content-between">
                  <div class="col-2 col-md-2 text-md-end text-start" style="text-align: left !important;">
                    <h6 class="d-block mt-2 mb-0"> </h6>
                    <span class="text-secondary"></span><br>
                  </div>
                  <div class="col-8 col-md-8">
                    <!--<h6 class="text-center d-block mt-2 mb-0">النواريه مكه المكرمه بجوار ماكدونالدز </h6>-->
                    <!--<h6 class="text-center d-block mb-0">النواريه مكه المكرمه بجوار ماكدونالدز </h6>-->
                  </div>
                  <div class="col-2 col-md-2 text-md-end text-end">
                    <h6 class="d-block mt-2 mb-0"></h6>
                    <span class="text-secondary">
                    </span><br>
                    <span class="text-dark text-secondary"></span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                  <div class="card">
                    <div class="card-body p-3">
                      <div class="row">
                        <div class="col-lg-12 col-12 text-end">
                          <div class="border-dashed border-1 border-secondary border-radius-md py-3">
                            <h6 class="font-weight-bolder" style="margin-right: 10px !important;">{{$t1}}</h6><hr>
                            <h6 class="font-weight-bolder" style="margin-right: 10px !important;">{{$data->shop_name}} :{{$t2}}</h6>
                            <h6 class="font-weight-bolder" style="margin-right: 10px !important;">{{$data->vat_license_no}} :{{$t3}}</h6>
                            <h6 class="font-weight-bolder" style="margin-right: 10px !important;"><?php $originalDate = $row->created_at; echo date("d-m-Y", strtotime($originalDate)); ?> :{{$t4}}</h6>
                            <h6 class="font-weight-bolder" style="margin-right: 10px !important;">SAR {{$row->order_total_amount_due}} :{{$t5}}</h6>
                            <h6 class="font-weight-bolder" style="margin-right: 10px !important;">{{$t6}} {{$row->order_tax_per}} {{$t7}}</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                <div class="row justify-content-between">
                  <div class="col-5 col-md-4 text-md-end text-start" style="text-align: left !important;">
                    <h6 class="d-block mt-2 mb-0"> </h6>
                    <span class="text-secondary"></span><br>
                  </div>
                  <div class="col-2">
                    <button id="printpagebutton" class="btn bg-gradient-info mt-lg-2 mb-0"  onclick="printpage()" type="button" name="button">{{$print}}</button>
                  </div>
                  <div class="col-5 col-md-5 text-md-end text-end">
                    <h6 class="d-block mt-2 mb-0"></h6>
                    <span class="text-secondary">
                    </span><br>
                    <span class="text-dark text-secondary"></span>
                  </div>
                </div>
             </div>
            </div>
          </form>
        </div>
      </div>
   </div>
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
 function printpage() {
     var printContents = document.getElementById("printarea").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    //  $("#printarea").print();
        //Get the print button and put it into a variable
        // var printButton = document.getElementById("printpagebutton");
        // var invoice = document.getElementById("invoice");
        //Set the print button visibility to 'hidden' 
        // printButton.style.visibility = 'hidden';
        // invoice.style.visibility = 'hidden';
        //Print the page content
        // window.print()
        // printButton.style.visibility = 'visible';
        // invoice.style.visibility = 'visible';
    }
    // var win = navigator.platform.indexOf('Win') > -1;
    // if (win && document.querySelector('#sidenav-scrollbar')) {
    //   var options = {
    //     damping: '0.5'
    //   }
    //   Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    // }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
</body>

</html>