@extends('admin.include.layout')
@section('mainarea')
	<div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-9 col-12 mx-auto">
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
          <div class="card card-body mt-4">
            <form action="{{ url('admin/customer/store') }}" method="POST" enctype="multipart/form-data">
    			@csrf
                <h6 class="mb-0">  @if(session('type')==0) नया 
ग्राहक    @else New Customer   @endif</h6>
                <hr class="horizontal dark my-3">
                <label for="projectName" class="form-label"> @if(session('type')==0) ग्राहक नाम     @else  Customer Name  @endif</label>
                <input type="text" class="form-control" name="customer_name"><br>
                <label for="projectName" class="form-label"> @if(session('type')==0)  ग्राहक का पता    @else Customer Address  @endif</label>
                <input type="text" class="form-control" name="customer_address"><br>
                <label for="projectName" class="form-label"> @if(session('type')==0) ग्राहक  मोबाइल नंबर  @else  Customer Mobile No.  @endif</label>
                <input type="text" class="form-control" name="customer_mobileno"><br>
                <label for="projectName" class="form-label"> @if(session('type')==0)  ग्राहक ईमेल आईडी  @else Customer Email Id @endif</label>
                <input type="text" class="form-control" name="customer_emailid"><br>
                <label for="projectName" class="form-label"> @if(session('type')==0) 
ग्राहक जीएसटी नंबर  @else  Customer GST No.  @endif</label>
                <input type="text" class="form-control" name="customer_gstno"><br>
                <label for="projectName" class="form-label"> @if(session('type')==0)  ग्राहक पैन नंबर   @else Customer PAN No.  @endif</label>
                <input type="text" class="form-control" name="customer_panno"><br>
                <div class="d-flex justify-content-end mt-4">
                  <button type="submit" name="button" class="btn bg-gradient-info m-0 ms-2"> @if(session('type')==0) बनाएं     @else Create  @endif</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection