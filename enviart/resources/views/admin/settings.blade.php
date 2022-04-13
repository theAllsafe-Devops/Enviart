@extends('admin.include.layout')
@section('mainarea')
<?php $data=DB::table('users')->where('id',Auth::user()->id)->first(); ?>
	<div class="container-fluid">
      <div class="row">
        <div class="col-lg-8 col-12 mx-auto">
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
            <form action="{{ url('admin/updateSettings') }}" method="POST" enctype="multipart/form-data">
    			@csrf
                <h6 class="mb-0"> @if(session('type')==0) 
स्थापना    @else Setting  @endif</h6>
                <hr class="horizontal dark my-3">
                <label for="projectName" class="form-label"> @if(session('type')==0) 
प्रिंट प्रकार   @else  Print Type  @endif</label>
                <select name="print_type" id="print_type" class="form-control" autocomplete="off">
			        <option value="1" @if($data->print_type==1) selected  @endif>A4</option> 
			        <option value="2" @if($data->print_type==2) selected  @endif>80 MM</option> 
			    </select>
                <label for="projectName" class="form-label"> @if(session('type')==0) लोगो अपलोड    @else Logo Upload  @endif</label>
                <input type="file" class="form-control" name="logo">
                <label for="projectName" class="form-label"> @if(session('type')==0)  दुकान का नाम    @else Shop Name  @endif</label>
                <input type="text" class="form-control" name="shop_name" value="{{$data->shop_name}}">
                <label for="projectName" class="form-label"> @if(session('type')==0)  दुकान का नाम (हिंदी)    @else Shop Name(Hindi)  @endif</label>
                <input type="text" class="form-control" name="shop_name_arabic" value="{{$data->shop_name_arabic}}">
                
                <label for="projectName" class="form-label"> @if(session('type')==0) मोबाइल नंबर    @else Mobile No @endif</label>
                <input type="text" class="form-control" name="telephone_no" value="{{$data->telephone_no}}">
                <label for="projectName" class="form-label"> @if(session('type')==0) टेलीफ़ोन नंबर   @else Telephone No @endif</label>
                <input type="text" class="form-control" name="telephone_no_arabic" value="{{$data->telephone_no_arabic}}">
                
                <label for="projectName" class="form-label">	 @if(session('type')==0)  ईमेल आईडी  @else Email Id  @endif</label>
                <input type="text" class="form-control" name="email_id_print" value="{{$data->email_id_print}}">
                <!-- <label for="projectName" class="form-label">	 @if(session('type')==0)  البريد الالكتروني   @else Email Id(Arabic)  @endif</label>
                <input type="text" class="form-control" name="email_id_print_arabic" value="{{$data->email_id_print_arabic}}">
                 -->
                <label for="projectName" class="form-label"> @if(session('type')==0)  जीएसटी संख्या    @else  GST No     @endif</label>
                <input type="text" class="form-control" name="vat_license_no" value="{{$data->vat_license_no}}">
                <label for="projectName" class="form-label"> @if(session('type')==0)  
पैन नंबर    @else  PAN No    @endif</label>
                <input type="text" class="form-control" name="vat_license_no_arabic" value="{{$data->vat_license_no_arabic}}">
                <label for="projectName" class="form-label"> @if(session('type')==0)  

टैन नंबर    @else  TAN No    @endif</label>
                <input type="text" class="form-control" name="tanno" value="{{$data->tanno}}">
                
                <label for="projectName" class="form-label"> @if(session('type')==0)  पता   @else Address @endif</label>
                <input type="text" class="form-control" name="address" value="{{$data->address}}">
                <label for="projectName" class="form-label"> @if(session('type')==0) शाखा पता    @else Branch Address @endif</label>
                <input type="text" class="form-control" name="address_arabic" value="{{$data->address_arabic}}">
                
                <label for="projectName" class="form-label"> @if(session('type')==0) 
बैंक विवरण    @else Bank Details @endif</label>
                <textarea class="form-control" name="remark">{{$data->remark}}</textarea>
                <label for="projectName" class="form-label"> @if(session('type')==0) बैंक खाता विवरण    @else Bank Account Details @endif</label>
                <textarea class="form-control" name="remark_arabic">{{$data->remark_arabic}}</textarea>
                
                <label for="projectName" class="form-label"> Footer </label>
                <textarea class="form-control" name="footer">{{$data->footer}}</textarea>
                
                <div class="d-flex justify-content-end mt-4">
                  <button type="submit" name="button" class="btn bg-gradient-info m-0 ms-2"> @if(session('type')==0)  
                  आधुनिक बनाना
   @else Update  @endif</button>
                </div>
            </form>
          </div>
        </div>
        <div class="col-lg-4 col-12 mx-auto">
            @if(session()->has('change_password_status'))
            <div class="alert alert-success" role="alert">
              <strong>Success!</strong> {{ session()->get('change_password_status') }}
          `</div>
    		@endif
    		@if(session()->has('Warning'))
    		  <div class="alert alert-danger" role="alert" style="color:white;">
                  <strong>Warning!</strong> {{ session()->get('Warning') }}
              </div>
    		@endif
          <div class="card card-body mt-4">
            <form action="{{ url('admin/changepassword') }}" method="POST" enctype="multipart/form-data">
    			@csrf
                <h6 class="mb-0"> @if(session('type')==0)   
पासवर्ड बदलें   @else Change Password @endif</h6>
                <hr class="horizontal dark my-3">
                <label for="projectName" class="form-label"> @if(session('type')==0)  
पुराना पासवर्ड    @else Old password  @endif</label>
                <input type="password" class="form-control" name="old_password">
                <label for="projectName" class="form-label"> @if(session('type')==0)  नया पासवर्ड    @else New password  @endif</label>
                <input type="password" class="form-control" name="new_password">
                <label for="projectName" class="form-label"> @if(session('type')==0)   
पासवर्ड की पुष्टि कीजिये   @else     Confirm password  @endif</label>
                <input type="password" class="form-control" name="confirm_password">
                
                <div class="d-flex justify-content-end mt-4">
                  <button type="submit" name="button" class="btn bg-gradient-info m-0 ms-2"> @if(session('type')==0) 
आधुनिक बनाना    @else Update @endif</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection