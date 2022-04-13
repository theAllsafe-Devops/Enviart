<?php $data=DB::table('users')->where('id',Auth::user()->id)->first(); 
$link = $_SERVER["REQUEST_URI"];
$link_array = explode('/',$link);
$page = end($link_array);

// $result = chr(1) . chr( strlen($data->shop_name) ) . $data->shop_name;
// $result.= chr(2) . chr( strlen($data->vat_license_no) ) . $data->vat_license_no;
// $result.= chr(3) . chr( strlen($row->created_at) ) . $row->created_at;
// $result.= chr(4) . chr( strlen($row->order_total_amount_due) ) . $row->order_total_amount_due;
// $result.= chr(5) . chr( strlen($row->order_tax_per) ) . $row->order_tax_per;
// echo base64_encode($result);
// $qr=QrCode::generate(base64_encode($result)); 
?>
<?php 
if(session('type')==0)
{     
    $td6=0;
    $td7=0;
}
else  
{
    
    $td6=0;
    $td7=0;
}
?>
<?php 
if(session('type')==0)
{
    $print="छाप";
    $backToHome="
    मुख्य पृष्ठ पर वापस जाएं";
}
else  
{
    $print="Print";
    $backToHome="Back To Home";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    th {
        padding: 4px !important;
    }
    </style>
    <style>
    table,
    th,
    td {
        border: 1px solid black !important;
        padding: 0px !important;

    }
    </style>
    @include('admin.include.head')
</head>

<body class="g-sidenav-show bg-gray-100">
    <main class="main-content max-height-vh-100 h-100">
        <div class="container-fluid my-3 py-3">
            <div class="row">
                <div class="col-md-8 col-sm-12 mx-auto">
                    <form class="" method="post">
                        <div class="card" id="printarea">
                            <div class="card-header">
                                <div class="row justify-content-between">
                                    <h4 style="text-align: center !important;">GST REPORT</h4>
                                    <hr />
                                    <div class="col-5 col-md-4 text-md-end text-start"
                                        style="text-align: left !important;">
                                        <h6 class="d-block mt-2 mb-0">{{$data->shop_name}} </h6>
                                        <span class="text-secondary">{{$data->address}}
                                        </span><br>
                                        <span class="text-secondary">{{$data->address_arabic}}
                                        </span><br>
                                        <span class="text-dark text-secondary"> PHONE:
                                        </span><span>{{$data->telephone_no_arabic}}</span><br>
                                        <span class="text-dark text-secondary">Contact:
                                        </span><span>{{$data->telephone_no}}</span><br>
                                        <span class="text-dark text-secondary">Email Address:
                                        </span><span>{{$data->email_id_print}}</span><br>



                                    </div>
                                     <div class="col-2 col-md-2 text-md-end text-start">
                    <img class="mb-2 w-100 p-2" src="{{ URL::asset('public/assets/img/') }}/{{$data->logo}}" alt="Logo">
                  </div> 
                                    <div class="col-5 col-md-4 text-md-end text-end">
                                        <!-- <h6 class="d-block mt-2 mb-0">{{$data->shop_name_arabic}}</h6> -->
                                        
                                            
                                        <tr>
                                            <th scope="col" class="pe-2 text-start ps-2"
                                                style="font-size: 0.875rem !important; font-weight: unset;">
                                                Date:

                                            </th>
                                        </tr><br>
                                        <!-- <span class="text-dark text-secondary">بريد الالكتروني:
                                        </span><span>{{$data->email_id_print_arabic}}</span><br> -->
                                        <span class="text-dark text-secondary">GSTIN No :
                                        </span><span>{{$data->vat_license_no}}</span>
                                        <br>
                                        <span class="text-dark text-secondary">PAN No.:
                                        </span><span>{{$data->vat_license_no_arabic}}</span>

                                    </div>
                                </div>
                                <br /><br />
                                <!-- <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table text-right">
                                                <thead>
                                                    <tr>
                                                        <th style="font-weight:bold; color:black;padding: 5px !important;"
                                                            scope="col" class="pe-2 ps-2" colspan="3">BILL TO:</th>
                                                    </tr>


                                                    <th scope="col" class="pe-2 text-end ps-2">رقم الفاتورة </th> -->

                                <!-- <tr> -->
                                <!-- <th scope="col" class="pe-2 text-end ps-2">تاريخ اصدار الفاتورة</th> -->
                                <!--  </tr>
                                                    <tr>
                                                        <th scope="col" class="pe-2 ps-2" colspan="3"
                                                            style="font-size: 0.875rem !important; font-weight: unset;">
                                                            </th>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col" class="pe-2 text-start ps-2" colspan="3"
                                                            style="font-size: 0.875rem !important; font-weight: unset;">
                                                            <b>GSTIN No : </b>
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table text-right" border="2">
                                                <thead class="bg-default">
                                                    <tr style="background: #E2E2E2;">
                                                        <th scope="col" class="pe-2 text-start ps-2"
                                                            style="width: 1% !important;">S.NO.<br>

                                                        </th>
                                                        <th scope="col" class="pe-2 text-start ps-2"
                                                            style="width: 35% !important;">Customer Name

                                                        </th>
                                                        <th scope="col" class="pe-2 text-start ps-2"
                                                            style="width: 17% !important;">Invoice No.
                                                        </th>
                                                        <th scope="col" class="pe-2 text-start ps-2"
                                                            style="width: 30% !important;">Invoice Created Date </th>
                                                        <!-- <th scope="col" class="pe-2 text-start ps-2"
                                                            style="width: 7% !important;">UNIT
                                                        </th> -->
                                                        <th scope="col" class="pe-2 text-start ps-2"
                                                            style="width: 30% !important;">GST Amount</th>
                                                        <th scope="col" class="pe-2 text-start ps-2"
                                                            style="width: 10% !important;">AMOUNT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $item=DB::table('tbl_invoiceordertable')->where('user_id',Auth::user()->id)->get(); ?>
                                                    @foreach($item as $key => $value)
                                                    <tr>

                                                        <td class="text-left">
                                                            {{++$key}}</td>
                                                        <td class="text-left" style="white-space:inherit;">
                                                            {{$value->customer_name}}</td>


                                                        <td class="text-center">{{$value->id}}</td>
                                                        <td class="ps-4 text-center">{{$value->created_at}}</td>
                                                        <?php 
                        if($value->order_tax_per!="NaN" && $value->order_tax_per!=Null){
                            $td7=$td7+($value->order_tax_per);
                        }
                        if($value->order_total_after_tax!="NaN" && $value->order_total_after_tax!=Null){
                            $td6=$td6+($value->order_total_after_tax); 
                        }
                        ?>
                                                        <td class="ps-4 text-center">{{$value->order_tax_per}}</td>
                                                        <td class="ps-4 text-end"
                                                            style=" padding-right: 7px !important;">

                                                            {{$value->order_total_after_tax}}

                                                        </td>

                                                    </tr>@endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        <!-- <th><pre class="mx-2 text-sm">BANK DETAILS:"ENVIART PVT. LTD
INDIAN BANK,STAFF COLLEGE,INDIRA NAGAR LUCKNOW</pre></th> -->

                                                        
                                                        <th class="text-end h6" colspan="3"
                                                            style="padding-right: 8px !important;font-size: 0.875rem !important; font-weight: unset;">
                                                            Total </th>
                                                            <th class="text-end h6" 
                                                            style="padding-right: 31px !important;font-size: 1rem !important; font-weight: unset;">{{$td7}}</th>
                                                        <th class="text-end h6" 
                                                            style="padding-right: 5px !important;font-size: 1rem !important; font-weight: unset;">{{$td6}}</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5 text-left">

                                        <p class="text-secondary text-sm">{!!$data->remark!!}</p>
                                        <p class="text-secondary text-sm">{{$data->remark_arabic}}</p>
                                        <p class="text-secondary text-sm"> </p>
                                        <span class="text-secondary mb-0" style="font-size: small;">
                                            {{$data->footer}}

                                        </span>
                                    </div>
                                    <div class="col-4 text-left">
                                    </div>
                                    <div class="col-3  text-md-end text-end">


                                        <span class="text-secondary mb-0" style="font-size: small;">
                                            For ENVIART PRIVATE LIMITED

                                        </span>
                                        <div style="padding-top: 67px;">
                                        </div>
                                        <span class="text-secondary mb-0" style="font-size: small;">AUTHORISED
                                            SIGNATORY</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <button id="printpagebutton" class="btn bg-gradient-info mt-lg-7 mb-0" onclick="printpage()" type="button"
                name="button">{{$print}}</button>
            <a href="{{ url('admin/dashboard') }}" id="invoice" class="btn bg-gradient-info mt-lg-7 mb-0"
                name="button">{{$backToHome}}</a>
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