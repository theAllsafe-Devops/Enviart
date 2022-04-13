@extends('admin.include.layout')
@section('mainarea')
<script src="{{ URL::asset('public/assets/js/plugins/datatables.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).on('click', '.get_id', function() {   
    var product_id = $(this).val();
    var id = $(this).attr('id');
    $("#v_id").val(id);
});
Print طباعة
العودة إلى الصفحة الرئيسيةback to home page 


function addOption() 
{
    optionText = $("#p_id").val();
    v_id = $("#v_id").val();
    
    id = v_id.replace("add_productName_",'');
    $('#productName_'+id).append(`<option>${optionText}</option>`);
}
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
                <div class="col-8">
                  <div class="card">
                    <div class="card-header pb-0">
                      <div class="d-lg-flex">
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                          <h5 class="mb-0">  @if(session('type')==0)  كل بيل    @else All Bill  @endif</h5>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                          <div class="ms-auto my-auto">
                            <button class="btn btn-danger delete" id="removeRows" type="button">- @if(session('type')==0) حذف   @else Delete  @endif </button>
				        	<button class="btn btn-success" id="addRows" type="button">+ @if(session('type')==0) أضف المزيد   @else Add More  @endif </button>
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
        						<th>+Add product</th>
        						<th>@if(session('type')==0) اسم المنتج @else Product Name  @endif</th>
        						<th>@if(session('type')==0) كمية @else Quantity @endif</th>
        						<th>@if(session('type')==0) سعر @else Price @endif</th>								
        						<th>@if(session('type')==0) المجموع @else Total @endif</th>
        					</tr>
                          </thead>
                          <tbody>
                            <tr>
        						<td><input class="itemRow" type="checkbox" style="margin-left: 15px;"></td>
        						<td><button type="button" class="btn bg-gradient-primary get_id" id="add_productName_1" data-bs-toggle="modal" data-bs-target="#exampleModal">Add</button></td>
        						<td>
        						    <select type="text" name="productName[]" id="productName_1" class="select-product form-control" autocomplete="off">
        						        <option value="">@if(session('type')==0) حدد المنتج @else Select Product  @endif </option>  
        						        @foreach($row as $key => $value)
        						        <option value="{{$value->product_name}}">{{$value->product_name}}</option> @endforeach  
        						        <!--<option value="" >@if(session('type')==0) حدد المنتج @else Select Product  @endif </opti-->
        						    </select>
        						</td>			
        						<td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
        						<td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
        						<td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
        					</tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="card">
                    <div class="card-body px-0 pb-0">
                      <div class="table-responsive">
                        <table class="table table-flush">
                            <tr>
        						<td>@if(session('type')==0) اسم الزبون @else Customer Name  @endif</td>			
        						<td><input value="" type="text" class="form-control" name="customer_name" placeholder="@if(session('type')==0) اسم الزبون @else Customer Name  @endif"></td>
        					</tr>
                            <tr>
        						<td>@if(session('type')==0) المجموع الفرعي  @else Subtotal    @endif</td>			
        						<td><input value="" type="text" class="form-control" name="subTotal" id="subTotal" placeholder="@if(session('type')==0) المجموع الفرعي  @else Subtotal    @endif"></td>
        					</tr>
        					<tr>
        						<td>@if(session('type')==0) تشمل الضريبة @else Include Tax  @endif</td>			
        						<td><input class="taxRate" value="{{$tax->precentage}}" type="checkbox" name="taxRate" id="taxRate"></td>
        					</tr>
        					<tr>
        						<td>@if(session('type')==0) قيمة الضريبة @else Tax Amount  @endif</td>			
        						<td><input value="" type="text" class="form-control" name="taxAmount" id="taxAmount" placeholder="@if(session('type')==0) قيمة الضريبة @else Tax Amount  @endif"></td>
        					</tr>
        					<tr>
        						<td>@if(session('type')==0) المجموع @else Total  @endif</td>			
        						<td><input value="" type="text" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="@if(session('type')==0) المجموع @else Total  @endif"></td>
        					</tr>
        					<tr>
        						<td>@if(session('type')==0) خصم @else Discount  @endif  </td>			
        						<td><input value="" type="text" class="form-control" name="amountPaid" id="amountPaid" placeholder="@if(session('type')==0) خصم @else Discount  @endif "></td>
        					</tr>
        					<tr>
        						<td>@if(session('type')==0) المبلغ المستحق @else Amount Due  @endif</td>			
        						<td><input value="" type="text" class="form-control" name="amountDue" id="amountDue" placeholder="@if(session('type')==0) المبلغ المستحق @else Amount Due  @endif"></td>
        					</tr>
        					<tr>
        						<td>@if(session('type')==0) نوع الدفع @else Payment type  @endif</td>			
        						<td><select class="form-control" name="payment_type">
        						        <option value="">@if(session('type')==0)  يختار      @else Select  @endif</option>
        						        <option> @if(session('type')==0) السيولة النقدية @else    Cash      @endif</option>
        						        <option>@if(session('type')==0) متصل @else Online @endif</option>
        						    </select>
        						</td>
        					</tr>
        					<tr>
        						<td></td>			
        						<td><button type="submit" name="button" class="btn bg-gradient-primary m-0 ms-2">Print</button></td>
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
           $('#price_'+id).val(response.price);
           
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
		htmlRows += '<td><button type="button" class="btn bg-gradient-primary get_id" id="add_productName_'+count+'" data-bs-toggle="modal" data-bs-target="#exampleModal">Add</button></td>';
		htmlRows += '<td><select type="text" name="productName[]" id="productName_'+count+'" class="select-product form-control" autocomplete="off"><option value="">Select Product</option> @foreach($row as $key => $value)					        <option value="{{$value->product_name}}">{{$value->product_name}}</option> @endforeach       </select></td>';	
		htmlRows += '<td><input type="number" name="quantity[]" id="quantity_'+count+'" class="form-control quantity" autocomplete="off"></td>';   		
		htmlRows += '<td><input type="number" name="price[]" id="price_'+count+'" class="form-control price" autocomplete="off"></td>';		 
		htmlRows += '<td><input type="number" name="total[]" id="total_'+count+'" class="form-control total" autocomplete="off"></td>';          
		htmlRows += '</tr>';
		$('#invoiceItem').append(htmlRows);
	}); 
	$(document).on('click', '#removeRows', function(){
		$(".itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});		
	$(document).on('blur', "[id^=quantity_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=price_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "#taxRate", function(){		
		calculateTotal();
	});	
	$(document).on('blur', "#amountPaid", function(){
		var amountPaid = $(this).val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {
			$('#amountDue').val(totalAftertax);
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
		var price = $('#price_'+id).val();
		var quantity  = $('#quantity_'+id).val();
		if(!quantity) {
			quantity = 1;
		}
		var total = price*quantity;
		$('#total_'+id).val(parseFloat(total));
		totalAmount += total;			
	});
	$('#subTotal').val(parseFloat(totalAmount));	
    // 	var taxRate = $("input[type='radio'][name='taxRate']:checked");
    // 	alert(taxRate);
    var taxRate=0;
	if($("input[type='checkbox'].taxRate").is(':checked')) {
        var taxRate = $("input[type='checkbox'].taxRate:checked").val();
    }
    // 	var taxRate = $("#taxRate").val();
	var subTotal = $('#subTotal').val();	
	if(subTotal) {
		var taxAmount = subTotal*taxRate/100;
		$('#taxAmount').val(taxAmount);
		subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
		$('#totalAftertax').val(subTotal);		
		var amountPaid = $('#amountPaid').val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {		
			$('#amountDue').val(subTotal);
		}
	}
}

 
</script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" class="form-control" id="v_id">
        <input type="text" class="form-control" id="p_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-primary"  data-bs-dismiss="modal" onclick="addOption()">Save</button>
      </div>
    </div>
  </div>
</div>
@endsection