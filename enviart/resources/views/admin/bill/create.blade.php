@extends('admin.include.layout')
@section('mainarea')
<style>
    .select2 {
        width: 205px !important;
    }
</style>
<script src="{{ URL::asset('public/assets/js/plugins/datatables.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-single').select2({
  tags: true
});

});
</script>
	<div class="container-fluid py-4">
	    @if(session()->has('status'))
        <div class="alert alert-success" role="alert">
          <strong>Success!</strong> {{ session()->get('status') }}
      `</div>
		@endif
		@if($errors->any())
		  <div class="alert alert-danger" role="alert" style="color:white;">
              <strong>Warning!</strong>  {{ implode('', $errors->all(':message')) }}
          </div>
		@endif
        <form action="{{ url('admin/bill/store') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="row">
                <div class="col-lg-8 col-12 mx-auto" style="margin-top: 21px;">
                  <div class="card">
                    <div class="card-header pb-0">
                      <div class="d-lg-flex">
                        <div @if(session('type')==0)   class="ms-auto my-auto mt-lg-0 mt-4"   @endif>
                          <h5 class="mb-0">  @if(session('type')==0) चालान    @else  Invoice @endif</h5>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                          <div class="ms-auto my-auto">
                            <button class="btn btn-info" id="addRows" type="button">+ @if(session('type')==0)  पंक्ति जोड़ें  @else Add More  @endif </button>
                            <button class="btn btn-info delete" id="removeRows" type="button">- @if(session('type')==0) पंक्ति को हटाएं   @else Delete  @endif </button>
        				  </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                      <div class="table-responsive">
                        <table class="table table-flush" id="invoiceItem">
                          <thead class="thead-light">
                            <tr>
        						<th><input id="checkAll" class="formcontrol" type="checkbox"></th>
        						<th>@if(session('type')==0) सामान का नाम  @else Product Name  @endif</th>
        						<th>@if(session('type')==0) मूल्य @else Price @endif</th>								
        						<th>@if(session('type')==0) मात्रा @else Quantity @endif</th>
        						
        						<th>@if(session('type')==0) संपूर्ण @else Total @endif</th>
        					</tr>
                          </thead>
                          <tbody>
                            <tr>
        						<td><input class="itemRow" type="checkbox" style="margin-left: 15px;"></td><td>
        						    <select name="productName[]" id="productName_1" class="js-example-basic-single select-product form-control" autocomplete="off">
        						        <option value="">@if(session('type')==0) वस्तु चुनें @else Select Product  @endif </option>  
        						        @foreach($row as $key => $value)
        						        <option value="{{$value->product_name}}">{{$value->product_name}}</option> @endforeach  
        						        <!--<option value="" >@if(session('type')==0) حدد المنتج @else Select Product  @endif </opti-->
        						    </select>
        						</td>			
        						<td><input type="text" name="price[]" style="direction: ltr !important;" id="price_1" class="form-control price" autocomplete="off"></td>
        						<td><input type="text" style="direction: ltr !important;" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
        						<td><input type="text" readonly name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
        					</tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-12 mx-auto" style="margin-top: 21px;">
                  <div class="card">
                    <div class="card-body px-0 pb-0">
                      <div class="table-responsive">
                        <table class="table table-flush">
                            <tr>
        						<td>@if(session('type')==0) ग्राहक का नाम            @else            Customer Name  @endif</td>			
        						<td><select name="customer_name" id="customer_name" onchange="getStateWiseCategory(this.value);" class="js-example-basic-single select-product form-control" style="
    width: 209px  !important;
"  autocomplete="off">
        						<option value="">@if(session('type')==0) नाम चुनें   @else Select Name  @endif </option>  
        						@foreach($customer_name as $key => $value)
        						<option value="{{$value->id}}">{{$value->customer_name}}</option> @endforeach          						    
                				</select></td>
        					</tr>
        					<tr>
        						<td>@if(session('type')==0) ग्राहक का जीएसटी नंबर    @else          Customer GST No.        @endif</td>			
        						<td><input type="text" name="customer_gstno" id="getDesignation" class="form-control"></td>
        					</tr>
                            <tr>
                                
        						<td>@if(session('type')==0) 
ग्राहक का पता   @else          Customer Address        @endif</td>			
        						<td>
        						    <input type="text" name="customer_address" id="getDesignation1" class="form-control">
        						 </td>
        					</tr>
                            <tr>
        						<td>@if(session('type')==0) 
उप कुल  @else Subtotal    @endif</td>			
        						<td><input value="" type="text" readonly style="direction: ltr !important;" class="form-control" name="subTotal" id="subTotal" placeholder="@if(session('type')==0) उप कुल  @else Subtotal    @endif"></td>
        					</tr> 
        					<tr style="
    display: none;
">
        						<td>@if(session('type')==0) خصم @else Discount % @endif  </td>			
        						<td><input value="" type="text" class="form-control" style="direction: ltr !important;" name="amountPaid" id="amountPaid" placeholder="@if(session('type')==0) خصم @else Discount  @endif "></td>
        					</tr>
        					<tr style="
    display: none;
">
        						<td>@if(session('type')==0) مقدار الخصم @else Discount  Amount  @endif  </td>			
        						<td><input id="dAmount" value="" readonly style="direction: ltr !important;" type="text" class="form-control" name="dAmount" placeholder="@if(session('type')==0) مقدار الخصم @else Discount  @endif "></td>
        					</tr>
        					<tr style="
    display: none;
">
        						<td>@if(session('type')==0) देय राशि @else Amount Due  @endif</td>			
        						<td><input value="" type="text" readonly style="direction: ltr !important;" class="form-control" name="amountDue" id="amountDue" placeholder="@if(session('type')==0) देय राशि @else Amount Due  @endif"></td>
        					</tr>
        					<tr>
        						<td>@if(session('type')==0)जीएसटी शामिल करें      @else Include GST  @endif</td>			
        						<td><input class="taxRate" readonly style="direction: ltr !important;" value="{{$tax}}" type="checkbox" name="taxRate" id="taxRate"></td>
        					</tr>
							<tr style="
    display: none;">
        						<td>@if(session('type')==0)जीएसटी शामिल करें      @else Include SGST  @endif</td>			
        						<td><input class="taxRate1" readonly style="direction: ltr !important;" value="" type="hidden" name="taxRate1" id="taxRate1"></td>
        					</tr>
        					<tr>
        						<td>@if(session('type')==0)  जीएसटी राशि         @else GST Amount  @endif</td>			
        						<td><input value="" type="text" style="direction: ltr !important;" readonly class="form-control" name="taxAmount" id="taxAmount" placeholder="@if(session('type')==0) जीएसटी राशि @else Tax Amount  @endif">
        						    <input value="" type="hidden" style="direction: ltr !important;" readonly class="form-control" name="ctaxAmount" id="ctaxAmount">
        						    <input value="" type="hidden" style="direction: ltr !important;" readonly class="form-control" name="staxAmount" id="staxAmount">
        						 </td>
        					</tr>
        					<tr>
        						<td>@if(session('type')==0) संपूर्ण @else Total  @endif</td>			
        						<td><input value="" type="text" readonly style="direction: ltr !important;" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="@if(session('type')==0) संपूर्ण @else Total  @endif"></td>
        					</tr>
        					
        					<tr>
        						<td>@if(session('type')==0) भुगतान प्रकार @else Payment type  @endif</td>			
        						<td><select class="form-control" name="payment_type">
        						        <option value="">@if(session('type')==0)  चयन      @else Select  @endif</option>
        						        <option value="Cash"> @if(session('type')==0) नकद @else    Cash      @endif</option>
        						        <option value="Online">@if(session('type')==0) ऑनलाइन भुगतान @else Online @endif</option>
        						        <option value="Credit">@if(session('type')==0) कार्ड भुगतान @else Card payment @endif</option>
        						    </select>
        						</td>
        					</tr>
        					<tr>
        						<td></td>			
        						<td><button type="submit" name="button" class="btn bg-gradient-info m-0 ms-2">@if(session('type')==0) छाप  @else Print @endif</button></td>
        					</tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </form>
    </div>
<script>
    
 $(document).ready(function(){
     
	$(document).on('change', '.select-product', function() {   
	    var product_id = $(this).val();
	    var id = $(this).attr('id');
		id = id.replace("productName_",'');
	    $.ajax({
        type: "get",
        dataType: "json",
        url: "{{ URL::asset('admin/getproduct') }}",
        data: { _token:'{{ csrf_token() }}','product_id':product_id},

        success: function (response) {
            
            // $('#price_'+id).val(response.price);
          @if(session('type')==0)
          $('#price_'+id).val(response.price);
          @else
          $('#price_'+id).val(response.price);
          @endif
           
        }
        });
	});	
	$(document).on('click', '#checkAll', function() {          	
		$(".itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow', function() {  	
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="itemRow" type="checkbox" style="margin-left: 15px;"></td>'; 
		htmlRows += '<td><select name="productName[]" id="productName_'+count+'" class="js-example-basic select-product form-control" autocomplete="off"><option value="">@if(session('type')==0) حدد المنتج @else Select Product  @endif</option> @foreach($row as $key => $value)					        <option value="{{$value->product_name}}">{{$value->product_name}}</option> @endforeach       </select></td>';	
		htmlRows += '<td><input type="text" name="price[]" style="direction: ltr !important;" id="price_'+count+'" class="form-control price" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="quantity[]" style="direction: ltr !important;" id="quantity_'+count+'" class="form-control quantity" autocomplete="off"></td>'; 		 
		htmlRows += '<td><input type="text" readonly name="total[]" id="total_'+count+'" class="form-control total" autocomplete="off"></td>';          
		htmlRows += '</tr>';
		$('#invoiceItem').append(htmlRows);
		 $('.js-example-basic').select2({
  tags: true
});
	}); 
	$(document).on('click', '#removeRows', function(){
		$(".itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});		
	$(document).on('keyup', "[id^=quantity_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=price_]", function(){
		calculateTotal();
	});	
	$(document).on('click', "#taxRate", function(){		
		calculateTotal();
	});
	$(document).on('click', "#taxRate1", function(){		
		calculateTotal();
	});	
	$(document).on('keyup', "#amountPaid", function(){
		// Price Start
	    @if(session('type')==0)
	        var amountPaid  = english_digit($(this).val()); 
		@else
		    var amountPaid = $(this).val(); 
        @endif
        @if(session('type')==0)
			var totalAftertax = english_digit($('#totalAftertax').val());
		@else
		    var totalAftertax = $('#totalAftertax').val();
        @endif	
		if(amountPaid && totalAftertax) {
			totalAftertaxDuc = ((totalAftertax*amountPaid/100).toFixed(2));
			@if(session('type')==0)
    			$('#dAmount').val(hindi_digit(totalAftertaxDuc));z
    			$('#amountDue').val(hindi_digit(totalAftertax-totalAftertaxDuc));
    		@else
    			$('#amountDue').val((totalAftertax-totalAftertaxDuc).toFixed(2));
    			$('#dAmount').val(totalAftertaxDuc);
            @endif
		} else {
		    @if(session('type')==0)
    			$('#amountDue').val(hindi_digit(totalAftertax));
    		@else
    			$('#amountDue').val((totalAftertax).toFixed(2));
            @endif
		}	
	});	
	$(document).on('click', '.deleteInvoice', function(){
		var id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this?")){
			$.ajax({
				url:"action.php",
				method:"POST",
				dataType: "json",
				data:{id:id, action:'delete_invoice'},				
				success:function(response) {
					if(response.status == 1) {
						$('#'+id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});
});	
function calculateTotal(){
	var totalAmount = 0; 
	$("[id^='price_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("price_",'');
		@if(session('type')==0)
		var quantity = $('#quantity_'+id).val();
// 		var quantityq  = $('#quantity_'+id).val();
// 		var quantity=0;
// 		for ($i = 0; $i < quantityq.length; $i++) 
// 			{
// 			    const arrayOfDigits = Array.from(String(quantityq));
//         		switch(arrayOfDigits[$i])
//         		{
//         		    case '०':
//         				quantity += "0";
//         			break;
//         			case '१':
//         				quantity += "1";
//         			break;
//         			case '२':
// 						quantity += "2";
// 					break;
//         			case '३':
// 						quantity += "3";
// 					break;
// 					case '४':
// 						quantity += "4";
// 					break;
// 					case '५':
// 						quantity += "5";
// 					break;
// 					case '६':
// 						quantity += "6";
// 					break;
// 					case '७':
// 						quantity += "7";
// 					break;
// 					case '८':
// 						quantity += "8";
// 					break;
// 					case '९':
// 						quantity += "9";
// 					break;
//         		}
// 			}
    	@else
        var quantity = $('#quantity_'+id).val();  
        @endif	
    	    // Price Start
    	    @if(session('type')==0)
    	    var price  = $('#price_'+id).val();
    	    
    // 		var price=0;
    // 		for ($i = 0; $i < aprice.length; $i++) 
    // 			{
    // 			    const arrayOfDigits = Array.from(String(aprice));
    //         		switch(arrayOfDigits[$i])
    //         		{
    //         		    case '०':
    //     				price += "0";
    //     			break;
    //     			case '१':
    //     				price += "1";
    //     			break;
    //     			case '२':
				// 		price += "2";
				// 	break;
    //     			case '३':
				// 		price += "3";
				// 	break;
				// 	case '४':
				// 		price += "4";
				// 	break;
				// 	case '५':
				// 		price += "5";
				// 	break;
				// 	case '६':
				// 		price += "6";
				// 	break;
				// 	case '७':
				// 		price += "7";
				// 	break;
				// 	case '८':
				// 		price += "8";
				// 	break;
				// 	case '९':
				// 		price += "9";
				// 	break;
    //         		}
    // 			}
        		@else
                var price = $('#price_'+id).val();  
                @endif
		if(!quantity) {
			quantity = 1;
		}
		var total = price*quantity;
		$('#total_'+id).val((parseFloat(total)).toFixed(2));
		totalAmount += total;			
	});
	@if(session('type')==0)
	    $('#subTotal').val((parseFloat(totalAmount)));
	@else
		$('#subTotal').val((parseFloat(totalAmount)).toFixed(2));
    @endif	
    // 	var taxRate = $("input[type='radio'][name='taxRate']:checked");
    // 	alert(taxRate);
    var taxRate=0;
    
	var taxRate1=0;
	if($("input[type='checkbox'].taxRate").is(':checked')) {
        var taxRate = $("input[type='checkbox'].taxRate:checked").val();
        var taxRate1 = $("#taxRate1").val();
    }
    // 	var taxRate = $("#taxRate").val();
	var amountPaid1 =$('#amountPaid').val();
	if(amountPaid1!=0) 
	{
	    @if(session('type')==0)
	        var subTotal = english_digit($('#amountDue').val());
    	@else
	        var subTotal = $('#amountDue').val();
        @endif 
	   // var amountpainBeforetax = subTotal1*amountPaid1/100;
	    var subTotal1 = parseFloat(subTotal1)-parseFloat(amountPaid1);
	}else{
	    
	    @if(session('type')==0)
    	    var subTotal = english_digit($('#subTotal').val());
    	@else
    		var subTotal = $('#subTotal').val();
        @endif
	}
	if(subTotal) {
		var taxAmount = subTotal*taxRate/100;
		var taxAmount1 = subTotal*taxRate1/100;
		subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
        $('#ctaxAmount').val(taxAmount);
    	$('#staxAmount').val(taxAmount1);
		
		subTotal = parseFloat(subTotal)+parseFloat(taxAmount1)
		
		@if(session('type')==0)
		    var taxAmount1  = ((taxAmount).toFixed(2));
		  //  var taxAmount2  = ((taxAmount1).toFixed(2));
			var taxAmount3 = parseFloat(taxAmount)+parseFloat(taxAmount1);
			console.log(taxAmount3);
		    var subTotal1   = ((subTotal).toFixed(2));
    	    $('#taxAmount1').val(taxAmount1);
    	   // $('#taxAmount2').val(taxAmount2);
    	    $('#taxAmount').val(taxAmount3);
    	    $('#totalAftertax').val(subTotal1);
    	@else
			var taxAmount3 = parseFloat(taxAmount)+parseFloat(taxAmount1);
		    $('#totalAftertax').val((subTotal).toFixed(2));
    		$('#taxAmount').val((taxAmount3).toFixed(2));
			$('#taxAmount1').val(taxAmount1);
    	    $('#taxAmount2').val(taxAmount2);
        @endif		
        @if(session('type')==0)
    		var amountPaid = english_digit($('#amountPaid').val());
    		var totalAftertax = english_digit($('#totalAftertax').val());
    	@else
    	    var amountPaid = $('#amountPaid').val();
		    var totalAftertax = $('#totalAftertax').val();
        @endif
        @if(session('type')==0)
    		if(amountPaid && totalAftertax) {
    // 			totalAftertax = totalAftertax-amountPaid;	
                totalAftertax = totalAftertax;	
			    $('#amountDue').val((hindi_digit(totalAftertax)).toFixed(2));
    		} else {		
    			$('#amountDue').val((hindi_digit(subTotal)).toFixed(2));
    		}
    	@else
    	    if(amountPaid && totalAftertax) {
    // 			totalAftertax = totalAftertax-amountPaid;	
                totalAftertax = totalAftertax;	
    			$('#amountDue').val((totalAftertax).toFixed(2));
    		} else {		
    			$('#amountDue').val((subTotal).toFixed(2));
    		}
        @endif
		
// 		console.log(totalAftertax);
	}
	// if(subTotal) {
	// 	;
		
	// 	@if(session('type')==0)
	// 	    var taxAmount1  = hindi_digit((taxAmount).toFixed(2));
	// 	    var subTotal1   = (subTotal).toFixed(2);
    // 	    $('#taxAmount').val(taxAmount2);
    // 	    $('#totalAftertax').val(hindi_digit(subTotal1));
    // 	@else
	// 	    $('#totalAftertax').val((subTotal).toFixed(2));
    // 		$('#taxAmount').val((taxAmount1).toFixed(2));
    //     @endif		
    //     @if(session('type')==0)
    // 		var amountPaid = english_digit($('#amountPaid').val());
    // 		var totalAftertax = english_digit($('#totalAftertax').val());
    // 	@else
    // 	    var amountPaid = $('#amountPaid').val();
	// 	    var totalAftertax = $('#totalAftertax').val();
    //     @endif
    //     @if(session('type')==0)
    // 		if(amountPaid && totalAftertax) {
    // 			totalAftertax = totalAftertax-amountPaid;	
        //         totalAftertax = totalAftertax;	
		// 	    $('#amountDue').val((hindi_digit(totalAftertax)).toFixed(2));
    	// 	} else {		
    	// 		$('#amountDue').val((hindi_digit(subTotal)).toFixed(2));
    	// 	}
    	// @else
    	//     if(amountPaid && totalAftertax) {
    // 			totalAftertax = totalAftertax-amountPaid;	
    //             totalAftertax = totalAftertax;	
    // 			$('#amountDue').val((totalAftertax).toFixed(2));
    // 		} else {		
    // 			$('#amountDue').val((subTotal).toFixed(2));
    // 		}
    //     @endif
		
	// 	console.log(totalAftertax);
	// }
}
function hindi_digit(input){
        var inputs = ""+input;
        new_val = inputs.replace(/0/g, '०').replace(/1/g, '१').replace(/2/g, '२').replace(/3/g, '३').replace(/4/g, '४').replace(/5/g, '५').replace(/6/g, '६').replace(/7/g, '७').replace(/8/g, '८').replace(/9/g, '९').replace(/۴/g, '٤').replace(/۵/g, '٥').replace(/۶/g, '٦');

        return new_val;
    }
function english_digit(input){
        var inputs = ""+input;        
        new_val = inputs.replace(/०/g, '0')
        .replace(/१/g, '1')
        .replace(/२/g, '2')
        .replace(/३/g, '3')
        .replace(/४/g, '4')
        .replace(/५/g, '5')
        .replace(/६/g, '6')
        .replace(/७/g, '7')
        .replace(/८/g, '8')
        .replace(/९/g, '9')
        .replace(/०/g, '0')
        .replace(/१/g, '1')
        .replace(/२/g, '2')
        .replace(/३/g, '3')
        .replace(/४/g, '4')
        .replace(/५/g, '5')
        .replace(/६/g, '6')
        .replace(/७/g, '7')
        .replace(/८/g, '8')
        .replace(/९/g, '9');
        return new_val;
    }
 
</script>
<script>
    function getStateWiseCategory(id)
    {
        var state = id;
        // alert(state);
        $.ajax({
            type: "Get",
            url: "getDesignation1",
            data: {id: state},
            success: function (response) { 
                console.log((JSON.parse(response)).address);
                $("#getDesignation1").val((JSON.parse(response)).address);
                $("#getDesignation").val((JSON.parse(response)).customer_gstno);
            }
        });
    }
</script>
@endsection