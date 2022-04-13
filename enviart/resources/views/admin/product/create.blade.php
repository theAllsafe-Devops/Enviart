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
            <form action="{{ url('admin/product/store') }}" method="POST" enctype="multipart/form-data">
    			@csrf
                <h6 class="mb-0"> @if(session('type')==0) नए वस्तु     @else New Product  @endif</h6>
                <hr class="horizontal dark my-3">
                <label for="projectName" class="form-label"> @if(session('type')==0)  वस्तु का नाम    @else Product Name  @endif</label>
                <input type="text" class="form-control" name="product_name"><br>
                <label for="projectName" class="form-label"> @if(session('type')==0) मूल्य    @else Price  @endif</label>
                <input type="text" class="form-control" name="price">
                
                <div class="d-flex justify-content-end mt-4">
                  <button type="submit" name="button" class="btn bg-gradient-info m-0 ms-2"> @if(session('type')==0)  निर्माण करना    @else Create  @endif</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection