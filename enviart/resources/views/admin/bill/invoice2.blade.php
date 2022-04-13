<?php $data=DB::table('users')->where('id','1')->first(); 
$link = $_SERVER["REQUEST_URI"];
$link_array = explode('/',$link);
$page = end($link_array);

$result = chr(1) . chr( strlen($data->shop_name) ) . $data->shop_name;
$result.= chr(2) . chr( strlen($data->vat_license_no) ) . $data->vat_license_no;
$result.= chr(3) . chr( strlen($row->created_at) ) . $row->created_at;
$result.= chr(4) . chr( strlen($row->order_total_amount_due) ) . $row->order_total_amount_due;
$result.= chr(5) . chr( strlen($row->order_tax_per) ) . $row->order_tax_per;
// echo base64_encode($result);
 $qr=QrCode::generate(base64_encode($result)); 
?>
<?php 
if(session('type')==0)
{
    $print="طباعة";
    $backToHome="العودة إلى الصفحة الرئيسية";
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
    <title>
    Gulf Bills
  </title>
<style>
.button {
  background-image: linear-gradient(
310deg
, #2152ff 0%, #21d4fd 100%);
  border: none;
  color: #fff;
  padding: 10px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
#top .logo{
  //float: left;
	height: 60px;
	width: 60px;
	background: url({{ URL::asset('public/assets/img/') }}/{{$data->logo}}) no-repeat;
	background-size: 65px 60px;
}
.clientlogo{
  float: left;
	height: 60px;
	width: 60px;
	background: url({{ URL::asset('public/assets/img/') }}/{{$data->logo}}) no-repeat;
	background-size: 60px 60px;
  border-radius: 50px;
}
.info{
  display: block;
  margin: 0;
}
  #invoice-POS{
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding:2mm;
  margin: 0 auto;
  width: 66mm;
  background: #FFF;
  
  
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
h1{
  font-size: 1.1em;
  color: #222;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
#page {
   border-collapse: collapse;
}

/* And this to your table's `td` elements. */
#page td {
   padding: 0; 
   margin: 0;
}
#top, #mid,#bot{ /* Targets all id with 'col-' */
  /*border-bottom: 1px solid #EEE;*/
}

#top{min-height: 100px;}
/*#mid{min-height: 80px;} */
#bot{ min-height: 50px;}

#top .logo{
  //float: left;
	height: 60px;
	width: 60px;
	background: url({{ URL::asset('public/assets/img/') }}/{{$data->logo}}) no-repeat;
	background-size: 60px 60px;
}
.clientlogo{
  float: left;
	height: 60px;
	width: 60px;
	background: url({{ URL::asset('public/assets/img/') }}/{{$data->logo}}) no-repeat;
	background-size: 60px 60px;
  border-radius: 50px;
}
.info{
  display: block;
  //float:left;
  margin-left: 0;
}
.title{
  float: right;
}
.title p{text-align: right;}
table{
width: 100%;
border-collapse: collapse;
}
.tabletitle{
font-size: .5em;
background: #EEE;
}
/*.service{border-bottom: 1px solid #EEE;}*/
.item{width: 24mm;}
.itemtext{font-size: .5em;}

#legalcopy{
  /*margin-top: 5mm;*/
}
  
}
td
{
    font-size: 10px;
}
.item{
    font-size: 13px;
    border-bottom: 1px dashed #EEE !important;
    border-top: 1px dashed #EEE !important;
    padding: 6px !important;
}
.Sub{
    border-bottom: 1px dashed #EEE !important;
    border-top: 1px dashed #EEE !important;
}
</style>
<style>
table, th, td {
  border: 0px dashed black !important;
  padding:0px !important;

}
</style>
</head>
<body>
 <div id="invoice-POS">
    
    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <!--<h2>SBISTechs Inc</h2>-->
      </div><!--End Info-->
    <!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <!--<h2>Contact Info</h2>-->
        <span style="font-size: 13px;"> 
            <b>{{$data->shop_name_arabic}}</b></br>
            Address: {{$data->address}}</br>
            Phone: {{$data->telephone_no}}</br>
            Email: {{$data->email_id_print}}</br>
            VAT No: {{$data->vat_license_no}}</br>
            @if($data->telephone_no_arabic) 
            {{$data->telephone_no_arabic}}</br>
            @endif
            @if($data->email_id_print_arabic) 
            {{$data->email_id_print_arabic}}</br>
            @endif
            @if($data->vat_license_no_arabic) 
            {{$data->vat_license_no_arabic}}</br>
            @endif
            <!--<span style="border-top: 1px dashed #EEE !important;"></span>--><hr>
            Customer Name: {{$row->customer_name}}</br>
            Customer VAT No: {{$row->customer_vat_no}}</br>
        </span>
      </div>
    </div><!--End Invoice Mid-->
    
	   </center>
	   <br>
	<div id="mid">
      <div class="info">
        <!--<h2>Contact Info</h2>-->
        <span style="float: left;font-size: 12px;"> 
            Invoice Number   : {{$row->id}}
        </span>
        <span style="float: right;font-size: 12px;"> 
            Date   : <?php $originalDate = $row->created_at; echo date("d-m-Y", strtotime($originalDate)); ?>
        </span>
      </div>
    </div>
    <div>

					<div>
						<table id="page" width="100%" border="0" cellspacing="0" cellpadding="0">
						    <thead>
							<tr>
								<th class="item"><span>Item</span></th>
								<th class="item"><span>Qty</span></th>
								<th class="item"><span>Amt</span></th>
							</tr>
							</thead>
							<tbody>
                            @php 
                                $item=DB::table('tbl_invoiceOrderItemTable')->where('tbl_invoiceOrderItemTable.order_id',$row->id)->get(); 
                                $quantity=0;
                            @endphp
                            @foreach($item as $value)
							<tr class="service">
								<td class="tableitem"><p class="itemtext">{{$value->item_id}}</p></td>
								<td class="tableitem" style="text-align: center;"><p class="itemtext">{{$value->order_item_quantity}}</p></td>
								<td class="tableitem" style="text-align: center;"><p class="itemtext">{{$value->order_item_final_amount}}</p></td>
							</tr>
                            @endforeach
                            </tbody>

							<tr class="Sub">
								<td class="Sub" colspan="2"><h3>Sub Total <br> المجموع الفرعي</h2></td>
								<td class="Sub"><h3 style="text-align: center;">{{$row->order_total_before_tax}}</h2></td>
							</tr>
							<tr class="tabletitle">
								<td></td>
								<td class="Rate" style="padding: 8px !important;"><span>Discount الخصم  </span></td>
								<td class="payment" style="text-align: center;"><span>{{$row->dAmount}}</span></td>
							</tr>
							<tr class="tabletitle">
								<td></td>
								<td class="Rate" style="padding: 8px !important;"><span>VAT-{{$row->order_total_tax}}% ضريبة</span></td>
								<td class="payment" style="text-align: center;"><span>{{$row->order_tax_per}}</span></td>
							</tr>

							<tr class="tabletitle">
								<td class="Sub" colspan="2"><h3>Grand Total <br> المجموع الإجمالي </h2></td>
								<td class="Sub"><h3 style="text-align: center;">SAR @if(empty($row->order_total_tax)) 
                                            {{$row->order_total_amount_due}} 
                                        @else 
                                            {{$row->order_total_after_tax}} 
                                        @endif</h2></td>
							</tr>

						</table>
					</div><!--End Table-->
                   
					<div id="legalcopy" style="font-size: 10px;">
						<p class="legal"><b>Remarks</b> 
						</p>
						<p class="legal">{!! $data->remark !!}  
						</p>
						<p class="legal"><strong>{{$data->remark_arabic}}</strong>  
						</p>
					</div>
				    <div id="legalcopy" style="text-align: center;">
						<p class="legal">{{$qr}} 
						</p>
					</div>
					 <div id="legalcopy" style="text-align: center;">
						<p class="legal"><strong>Thank You</strong>  
						<br>شكرا لكم
						</p>
					</div>

				</div><!--End InvoiceBot-->
  </div><!--End Invoice-->
      <button id="printpagebutton" class="button"  onclick="printpage()" type="button" name="button">{{$print}}</button>
        <a href="{{ url('admin/dashboard') }}" id="invoice" class="button"  name="button">{{$backToHome}}</a>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
 function printpage() {
     var printContents = document.getElementById("invoice-POS").innerHTML;
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