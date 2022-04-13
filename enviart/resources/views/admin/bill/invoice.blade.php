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
                                    <h4 style="text-align: center !important; ">TAX INVOICE</h4>
                                    <hr />
                                     
                    
                 
                                    <div class="col-5 col-md-7 text-md-end text-start"
                                        style="text-align: left !important; font-size:11px;line-height: 2;">
                                        <img class="mb-2 p-2" src="{{ URL::asset('public/assets/img/') }}/{{$data->logo}}" alt="Logo" style="
    width: 74px;
">
                                        <h6 class="d-block mt-2 mb-0" style="font-size: 13px !important;">{{$data->shop_name}} </h6>
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
<!--<tr>-->
<!--                                            <th scope="col" class="pe-2 text-start ps-2"-->
<!--                                                style="font-weight: unset;">Invoice-->
<!--                                                NO.: {{$row->id}}</th>-->
<!--                                        </tr><br>-->
<!--                                        <tr>-->
<!--                                            <th scope="col" class="pe-2 text-start ps-2"-->
<!--                                                style=" font-weight: unset;">-->
<!--                                                Date:-->
<!--                                                <?php $originalDate = $row->created_at; echo date("d-m-Y", strtotime($originalDate)); ?>-->
<!--                                            </th>-->
<!--                                        </tr><br>-->
                                        <!-- <span class="text-dark text-secondary">بريد الالكتروني:
<!--                                        </span><span>{{$data->email_id_print_arabic}}</span><br> -->
<!--                                        <span class="text-dark text-secondary">GSTIN No :-->
<!--                                        </span><span>{{$data->vat_license_no}}</span>-->
<!--                                        <br>-->
<!--                                        <span class="text-dark text-secondary">PAN No.:-->
<!--                                        </span><span>{{$data->vat_license_no_arabic}}</span>-->
<!--                                        <br>-->
<!--                                        <span class="text-dark text-secondary">TAN No.:-->
<!--                                        </span><span>{{$data->tanno}}</span>-->



                                    </div>
                                    
                                    <div class="col-5 col-md-5 text-md-end text-end" style="font-size:small;">
                                        <!-- <h6 class="d-block mt-2 mb-0">{{$data->shop_name_arabic}}</h6> -->
                                        <div class="table-responsive">
                                            <table class="table text-right">
                                                <table>
                                                 <tr>
                                                     <th style="
    padding: 7px 14px 7px 14px !important;
    text-align: center !important;
">INVOICE
                                                NO.</th>
                                                     <th style="
    padding: 7px 14px 7px 14px !important;
    text-align: center !important;
">DATE</th>
                                                     
                                                 </tr>   
                                                <tr><td style="
    padding: 7px 14px 7px 14px !important;
    text-align: center !important;
">{{$row->id}}</td>
                                                <td style="
    padding: 7px 14px 7px 14px !important;
    text-align: center !important;
"><?php $originalDate = $row->created_at; echo date("d-m-Y", strtotime($originalDate)); ?></td>
                                                </tr>
                                                <tr><th style="
    padding: 7px 14px 7px 14px !important;
    text-align: center !important;
">GSTIN No. </th>
                                                <td style="
    padding: 7px 14px 7px 14px !important;
    text-align: center !important;
">{{$data->vat_license_no}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="
    padding: 7px 14px 7px 14px !important;
    text-align: center !important;
">PAN No.</th>
                                                    <td style="
    padding: 7px 14px 7px 14px !important;
    text-align: center !important;
">{{$data->vat_license_no_arabic}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="
    padding: 7px 14px 7px 14px !important;
    text-align: center !important;
">TAN No.</th>
                                                    <td style="
    padding: 7px 14px 7px 14px !important;
    text-align: center !important;
">{{$data->tanno}}</td>
                                                </tr>
</table>
</table>
</div>
                                        
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table text-right">
                                                <thead>
                                                    


                                                   <tr>
                                                        <th style="font-weight:bold; color:black;padding: 5px !important;font-size: 0.875rem !important;"
                                                            scope="col" class="pe-2 ps-2" colspan="3">BILL TO:</th>
                                                    </tr>
                                                    <?php $customer_name=DB::table('customer')->where('id',$row->customer_name)->first(); 
                    if($customer_name)
                      {
                        $customer_namevalue=$customer_name->customer_name;
                      }
                      else{
                        $customer_namevalue=$row->customer_name;
                      }
                    ?>
                                                     <tr>
                                                        <th scope="col" class="pe-2 ps-2" colspan="3"
                                                            style="font-size: 0.875rem !important; font-weight: unset;">
                                                            {{$customer_namevalue}}</th>
                                                    </tr>
                                                    
                                                    <br>
                                                    <?php $customer_address=DB::table('customer')->where('id',$row->customer_address)->first(); 
                    if($customer_address)
                      {
                        $customer_addressvalue=$customer_address->customer_address;
                      }
                      else{
                        $customer_addressvalue=$row->customer_address;
                      }
                    ?>
                                                    <tr>
                                                        <th scope="col" class="pe-2 text-start ps-2" colspan="3"
                                                            style="font-size: 0.875rem !important; font-weight: unset;">
                                                            <b> {{$customer_addressvalue}}</b>
                                                        </th>
                                                    </tr>
                                                    <br>
                                                     
                                                    <tr>
                                                        <th scope="col" class="pe-2 text-start ps-2" colspan="3"
                                                            style="font-size: 0.875rem !important; font-weight: unset;">
                                                            <b>Customer GSTIN No : {{$row->customer_gstno}}</b>
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table text-right" border="2">
                                                <thead class="bg-default">
                                                    <tr style="background: #E2E2E2;">
                                                        <th scope="col" class="pe-2 text-start ps-2"
                                                            style="width: 5% !important; font-size: 0.875rem !important;">S.NO.<br>

                                                        </th>
                                                        <th scope="col" class="pe-2 text-start ps-2"
                                                            style="width: 52% !important; font-size: 0.875rem !important;">DESCRIPTION

                                                        </th>
                                                        <!--<th scope="col" class="pe-2 text-start ps-2"-->
                                                        <!--    style="width: 7% !important;">SIZE-->
                                                        <!--</th>-->
                                                        <th scope="col" class="pe-2 text-start ps-2"
                                                            style="width: 7% !important; font-size: 0.875rem !important;">QTY </th>
                                                        <!--<th scope="col" class="pe-2 text-start ps-2"-->
                                                        <!--    style="width: 7% !important;">UNIT-->
                                                        <!--</th>-->
                                                        <th scope="col" class="pe-2 text-start ps-2"
                                                            style="width: 15% !important; font-size: 0.875rem !important;">RATE</th>
                                                        <th scope="col" class="pe-2 text-start ps-2"
                                                            style="width: 15% !important; font-size: 0.875rem !important;">AMOUNT</th>
                                                    </tr>
                                                </thead>
                                                <div>
                                                    <?php $item=DB::table('tbl_invoiceorderitemtable')->where('tbl_invoiceorderitemtable.order_id',$row->id)->get(); ?>
                                                    @foreach($item as $key => $value)
                                                    <tr>

                                                        <td class="text-left"
                                                            > 
                                                            {{++$key}}</td>
                                                        <td class="text-left" style="white-space:inherit; font-size:13px;"
                                                            >
                                                            {{$value->item_id}}</td>
                                                        <!--<td class="ps-4 text-center"></td>-->

                                                        <td class="text-center text-xs">{{$value->order_item_quantity}}</td>
                                                        <!--<td class="ps-4 text-center"></td>-->
                                                        <td class="ps-4 text-center text-xs">{{$value->price}}</td>
                                                        <td class="ps-4 text-end text-xs"
                                                            style=" padding-right: 7px !important;">
                                                            
                                                            {{$value->order_item_final_amount}}
                                                            
                                                        </td>
                                                    </tr>@endforeach
                                                </div>
                                                <div>
                                                    <tr>
                                                        <th  rowspan="3"></th>
                                                         <th  style="white-space:inherit; font-size:11px;" rowspan="3">
                                                             <b>BANK DETAILS:</b> {!!$data->remark!!}
                                                         <br>{!!$data->remark_arabic!!}
                                                         
                                                         </th> 

                                                        <th class="text-end h6 text-xs" colspan="2"
                                                            style="padding-right: 8px !important; font-weight: unset;">
                                                            Total </th>
                                                        <th class="text-end h6 text-xs" style="padding-right: 8px !important;">

                                                            {{$row->order_total_before_tax}}

                                                        </th>
                                                    </tr>
                                                    @foreach($tax as $key => $taxvalue)
                                                    <tr>
                                                        <!--<th></th>-->
                                                        <!--<th></th>-->
                                                        <th class="text-end h6 text-xs" colspan="2" style="padding-right: 8px !important; font-weight: unset;">                                                            
                                                        {{$taxvalue->tax_name}}<code style="font-size: 16px; padding-left: 5px; padding-right: 3px;color: black;">@</code>{{$taxvalue->precentage}}% </th>
                                                        <th class="text-end h6 ps-4 text-xs" style="padding-right: 8px !important;">
                                                            {{number_format(($row->order_total_before_tax*$taxvalue->precentage/100),2)}}
                                                        </th>
                                                    </tr>
                                                    @endforeach
                                                     
                                                    <tr><?php $row=DB::table('tbl_invoiceordertable')->where('tbl_invoiceordertable.id',$row->id)->get(); ?>
                                                    @foreach($row as $key => $value)
                                                    <th></th>
                                                    <th class="text-xs mx-2"><!-- call the function here -->
                                                    <i class="fa fa-inr mx-2" aria-hidden="true"></i>
 <?php $amt_words=(($value->order_total_after_tax));
  // nummeric value in variable
 
 $get_amount= AmountInWords($amt_words);
 echo $get_amount;
 ?></th>
                                                    
                                                    <th></th>
                                                    <th class="text-end h6 text-xs" 
                                                        style="padding-right: 8px !important;">Grand Total
                                                    </th>
                                                    <th class="text-end h6 ps-4 text-xs" style="padding-right: 8px !important;">
                                                       {{$value->order_total_after_tax}}

                                                    </th>
                                                    </tr>
                                                    @endforeach
                                                </div>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5 text-left">

                                       
                                        <p class="text-secondary mb-0 " style="
    font-size: 9px;
">
                                            {{$data->footer}}

                                        </p>
                                        <p class="text-secondary mb-0" style="
    font-size: 9px;
">
                                            This is a Computer Generated Bill

                                        </p>
                                    </div>
                                    <div class="col-4 text-left">
                                    </div>
                                    <div class="col-3  text-md-end text-end">
                                        <p class="text-secondary mb-0 " style="
    font-size: 9px;
">
                                            For ENVIART PRIVATE LIMITED

                                        </p>

                                        <div style="padding-top: 27px;">
                                        </div>
                                        <span class="text-secondary mb-0 text-xs">AUTHORISED
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
    <?php
// Create a function for converting the amount in words
function AmountInWords(float $amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
   else $string[] = null;
   }
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees Only. ' : '') . $get_paise;
}
?>


</body>

</html>