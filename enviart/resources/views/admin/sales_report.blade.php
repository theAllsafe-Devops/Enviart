@extends('admin.include.layout')
@section('mainarea')
<?php 
if(session('type')==0)
{     
    $email="
    ईमेल भेजें";
    $header=" बिक्री रिपोर्ट ";
    $td0="क्रमांक";
    $td1="चालान संख्या";
    $td2="चालान की तारीख";
    $td3="ग्राहक का नाम";
    // $td4="رقم الضريبة زبون ";
    // $td5="  نسبة الضريبة  ";
    // $td6=" الخصم";
    $td7="चालान राशि";
    $td8="जीएसटी राशि";
    $td9=0;
    $td10=0;
}
else  
{
    $email="Email Send";
    $header="Sale Report";
    $td0="ID";
    $td1="Invoice Number";
    $td2="Invoice Date";
    $td3="Customer Name";
    // $td4="Customer Vat No.";
    // $td5="Vat Percentage";
    // $td6="Discount(in %)";
    $td7="Invoice amount";
    $td8="GST Amount";
    $td9=0;
    $td10=0;
    $td11=0;
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ URL::asset('public/assets/js/plugins/datatables.js') }}"></script>
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
              @if(session()->has('delete'))
                    <div class="alert alert-success" role="alert">
                      <strong>Success!</strong> {{ session()->get('delete') }}
                  `</div>
            	@endif
			    <!-- Card header -->
            <div class="card-header pb-0">
              <div class="d-lg-flex">
                <div  @if(session('type')==0)   class="ms-auto my-auto mt-lg-0 mt-4"   @endif>
                  <h5 class="mb-0">{{$header}}</h5>
                  
                </div>
                <div class="@if(session('type')==0)    @else  ms-auto @endif my-auto mt-lg-0 mt-4">
                  <div class="ms-auto my-auto">
                      
                    <!--<a href="{{ url('admin/bill/create') }}" class="btn bg-gradient-info btn-sm mb-0">+&nbsp; @if(session('type')==0) مشروع قانون جديد  @else New Invoice @endif </a>-->
                    <button class="btn btn-outline-info btn-sm mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button"><a target="_blank" href="{{ url('admin/salereport') }}">@if(session('type')==0) प्रकाशित  @else Print @endif </a></button>
                    <button class="btn btn-outline-info btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">@if(session('type')==0) निर्यात  @else Export @endif </button>
                    <button class="btn btn-outline-info btn-sm export mb-0 mt-sm-0 mt-1" type="button" name="button">{{$email}}</button>
                    <input type="date" class="start_date mb-0" style="padding: 0.3rem 0.75rem; font-size: 0.875rem; font-weight: 400; line-height: 1.4rem; color: #495057; background-color: #fff; background-clip: padding-box;border: 1px solid #d2d6da;appearance: none;  border-radius: 0.5rem; transition: box-shadow 0.15s ease, border-color 0.15s ease;">
                    <input type="date" class="end_date search mb-0" style="padding: 0.3rem 0.75rem; font-size: 0.875rem; font-weight: 400; line-height: 1.4rem; color: #495057; background-color: #fff; background-clip: padding-box;border: 1px solid #d2d6da;appearance: none;  border-radius: 0.5rem; transition: box-shadow 0.15s ease, border-color 0.15s ease;">
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-0">
              <div class="table-responsive">
                <table class="table table-flush" id="products-list">
                  <thead class="thead-light">
                    <tr>
                      <th>{{$td1}}</th>
                      <th>{{$td2}}</th>
                      <th>{{$td3}}</th>
                     
                      
                      <th>{{$td7}}</th>
                      <th>{{$td8}}</th>
                    </tr>
                  </thead>
                  <tbody>@foreach($row as $key => $value)
                    <tr>
                        <td>
                        <div class="d-flex">
                        <h6 class="my-auto"><a target="_blank" href="{{ url('admin/invoice') }}/{{$value->id}}">{{$value->id}}</h6>
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
                        </div><?php  $td9=$td9+$value->order_amount_paid; $td10=$td10+$value->order_total_amount_due; $td11=$td11+$value->order_tax_per; ?>
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
                        <h6 class="my-auto">{{$td10}}</h6>
                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                        <h6 class="my-auto">{{$td11}}</h6>
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

    <script type="text/javascript">
    $(document).ready(function() {
        $('.search').on('change',function(){
            var end_date=$(".end_date").val();
            var start_date=$(".start_date").val();
            $.ajax({
                type: "get",
                url: "{{ url('admin/sreport') }}",
                data: {'start_date': start_date,'end_date': end_date},
                success: function (data) {
                    window.location.href = "{{ url('admin/sreport') }}?start_date="+start_date+"&end_date="+end_date;
                }
            });
        });
    });
</script>
    <script>
    if (document.getElementById('products-list')) {
      const dataTableSearch = new simpleDatatables.DataTable("#products-list", {
        searchable: true,
        fixedHeight: false,
        perPage: 10
      });

      document.querySelectorAll(".export").forEach(function(el) {
        el.addEventListener("click", function(e) {
          var type = el.dataset.type;

          var data = {
            type: type,
            filename: "bill-" + type,
          };

        //   if (type === "csv") {
        //     data.columnDelimiter = "|";
        //   }

          dataTableSearch.export(data);
        });
      });
    };
  </script>
 <!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">-->
<!--  Launch demo modal-->
<!--</button>-->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection