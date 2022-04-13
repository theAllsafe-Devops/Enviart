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
                <div class="ms-auto my-auto mt-lg-0 mt-4">
                  <h5 class="mb-0"> @if(session('type')==0)   सभी ग्राहक @else All Customer  @endif</h5>
                  
                </div>
                <div class="@if(session('type')==0)    @else  ms-auto @endif my-auto mt-lg-0 mt-4">
                  <div class="ms-auto my-auto">
                    <a href="{{ url('admin/customer/create') }}" class="btn bg-gradient-info btn-sm mb-0">+&nbsp;  @if(session('type')==0)  नया  ग्राहक   @else  New Customer @endif</a>
                    <button class="btn btn-outline-info btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button"> @if(session('type')==0) निर्यात      @else Export @endif</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-0">
              <div class="table-responsive">
                <table class="table table-flush" id="products-list">
                  <thead class="thead-light">
                    <tr>
                      <th> @if(session('type')==0)  क्रमांक    @else ID  @endif</th>
                      <th> @if(session('type')==0) ग्राहक नाम     @else  Customer Name  @endif</th>
                      <th> @if(session('type')==0)  ग्राहक का पता    @else Customer Address  @endif</th>
                      <th> @if(session('type')==0) ग्राहक  मोबाइल नंबर  @else  Customer Mobile No.  @endif</th>
                      <th> @if(session('type')==0)  ग्राहक ईमेल आईडी  @else Customer Email Id @endif</th>
                      <th> @if(session('type')==0) 
ग्राहक जीएसटी नंबर  @else  Customer GST No.  @endif</th>
                      <th> @if(session('type')==0)  ग्राहक पैन नंबर   @else Customer PAN No.  @endif</th>
                      <th> @if(session('type')==0) कार्य     @else Action @endif</th>
                    </tr>
                  </thead>
                  <tbody>@foreach($row as $key => $value)
                    <tr>
                        <td>{{++$key}}</td>
                      <td>
                        <div class="d-flex">
                          <h6 class="ms-3 my-auto">{{$value->customer_name}}</h6>
                        </div>
                      </td>
                      <td class="text-sm">{{$value->customer_address}}</td>
                      <td class="text-sm">{{$value->customer_mobileno}}</td>
                      <td class="text-sm">{{$value->customer_emailid}}</td>
                      <td class="text-sm">{{$value->customer_gstno}}</td>
                      <td class="text-sm">{{$value->customer_panno}}</td> 
                      <td class="text-sm">
                        <a href="{{ url('admin/customer/edit') }}/{{$value->id}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
                          <i class="fas fa-user-edit text-secondary"></i>
                        </a>
                        <a href="{{ url('admin/customer/destroy') }}/{{$value->id}}" onclick="return confirm('Are you sure you want to delete this item?');" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
                          <i class="fas fa-trash text-secondary"></i>
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