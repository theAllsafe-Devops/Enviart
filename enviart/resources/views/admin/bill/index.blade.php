@extends('admin.include.layout')
@section('mainarea')
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
                <div  @if(session('type')==0)   class="my-auto mt-lg-0 mt-4"   @endif>
                  <h5 class="mb-0">@if(session('type')==0)  चालान @else  Invoice @endif</h5>
                  
                </div>
                <div class="@if(session('type')==0)    @else  ms-auto @endif ms-auto my-auto mt-lg-0 mt-4">
                  <div class="ms-auto my-auto">
                    <!--<a href="{{ url('admin/bill/create') }}" class="btn bg-gradient-info btn-sm mb-0">+&nbsp; @if(session('type')==0) مشروع قانون جديد  @else New Invoice @endif </a>-->
                    <button class="btn btn-outline-info btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">@if(session('type')==0) निर्यात   @else Export @endif </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-0">
              <div class="table-responsive">
                <table class="table table-flush" id="products-list">
                  <thead class="thead-light">
                    <tr>
                      <th>@if(session('type')==0) क्रमांक @else ID @endif                     </th>  
                      <th>@if(session('type')==0) ग्राहक का नाम @else Customer Name @endif              </th>
                      <th>@if(session('type')==0) भुगतान प्रकार  @else Payment Type @endif              </th>
                      <th>@if(session('type')==0) कुल भुगतान  @else Total Payment @endif                   </th>
                      <th>@if(session('type')==0) तिथि और समय  @else date & time @endif                     </th>  
                      <th>@if(session('type')==0) कार्य  @else Action @endif                          </th>
                    </tr>
                  </thead>
                  <tbody>@foreach($row as $key => $value)
                    <?php $customer_name=DB::table('customer')->where('id',$value->customer_name)->first(); 
                    if($customer_name)
                      {
                        $customer_namevalue=$customer_name->customer_name;
                      }
                      else{
                        $customer_namevalue=$value->customer_name;
                      }
                    ?>
                    <tr>
                        <td><a target="_blank" href="{{ url('admin/invoice') }}/{{$value->id}}">{{++$key}}</a></td>
                        
                      <td>
                        <div class="d-flex">
                          <h6 class="my-auto">{{$customer_namevalue}}</h6>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <h6 class="my-auto">{{$value->payment_type}}</h6>
                        </div>
                      </td>
                      <td class="text-sm">{{$value->order_total_after_tax}}</td>
                      <td class="text-sm">{{$value->created_at}}</td>
                      <td class="text-sm">
                        <a href="{{ url('admin/bill/destroy') }}/{{$value->id}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Delete product" onclick="return confirm('Are you sure you want to delete this item?');" >
                          <i class="fas fa-trash text-secondary"></i>
                        </a>
                        <!--<a href="{{ url('admin/product/destroy') }}/{{$value->id}}" onclick="return confirm('Are you sure you want to delete this item?');" data-bs-toggle="tooltip" data-bs-original-title="Delete product">-->
                        <!--  <i class="fas fa-trash text-secondary"></i>-->
                        <!--</a>-->
                        <a target="_blank" href="{{ url('admin/invoice') }}/{{$value->id}}">
                          <i class="fas fa-print text-secondary"></i>
                        </a>
                      </td>
                    </tr>@endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
    if (document.getElementById('products-list')) {
      const dataTableSearch = new simpleDatatables.DataTable("#products-list", {
        searchable: true,
        fixedHeight: false,
        perPage: 7
      });

      document.querySelectorAll(".export").forEach(function(el) {
        el.addEventListener("click", function(e) {
          var type = el.dataset.type;

          var data = {
            type: type,
            filename: "soft-ui-" + type,
          };

          if (type === "csv") {
            data.columnDelimiter = "|";
          }

          dataTableSearch.export(data);
        });
      });
    };
  </script>
@endsection