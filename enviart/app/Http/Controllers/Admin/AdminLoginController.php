<?php

namespace App\Http\Controllers\Admin;
use Auth;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InvoiceOrderTable;
use App\Models\Product;
use Mail;
use Validator;
use QrCode;
class AdminLoginController extends Controller
{
    public function login(Request $request)
    {
        return view('admin.login15');
    }
    public function makelogin(Request $request)
    {
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
            'login_status' => '1',
        ];
        $type=$request->type;
        if(Auth::attempt($credentials)) {
            $value = $request->session()->get('key', $credentials);
            $value1 = $request->session()->put('type',$type);
            return redirect()->route('admin.dashboard');       
        }

        return redirect('/')->with('error', 'Oppes! You have entered invalid credentials');
    }

    // ------------------ [ User Dashboard Section ] ---------------------
    public function dashboard() {
        // check if user logged in
        if(Auth::check()) {
            $product=Product::where('user_id',Auth::user()->id)->get();
            $user=InvoiceOrderTable::where('user_id',Auth::user()->id)->get();
            $row=InvoiceOrderTable::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->limit(10)->get();
            return view('admin.dashboard',compact('user','row','product'));
        }

        return redirect('/')->with('error', 'Oopps! You do not have access');
    }
    
    public function profile() 
    {
        if(Auth::check()) {
            return view('admin.profile');
        }
        return redirect('/')->with('error', 'Oopps! You do not have access');
    }
    
    public function updateprofile(Request $request) 
    {
	        if($request->hasfile('image'))
	        {
	            $file=$request->file('image');
	            $extension=$file->getClientOriginalExtension();
	            $filename=time().'.'.$extension;
	            $file->move('admin_assets/upload',$filename);
	            $data['profile_image']=$filename;
	        }
        	$data['name'] = $request->name;
        	$data['email'] = $request->email;
        	
        	if( User::where('id', Auth::user()->id)->update( $data ))
        	{
			return back()->with('status','Profile update successfully');
		}
		return back()->with('status','Not update profile');
    }
    
    public function changepassword(Request $request) 
    {
        if(Auth::check())
        {        	
            $password=Auth::user()->password;
            // $old_password = Hash::check('admin@123');
            // dd($password.$old_password);
        	$new_password = $request->new_password;
        	$confirm_password = $request->confirm_password;
        	if((Hash::check($request->post('old_password'), Auth::user()->password)))
        	{
        	    if($new_password==$confirm_password)
            	{
                	$data['password']=Hash::make($new_password);
            	    if( User::where('id', Auth::user()->id)->update( $data ))
                	{
                	    $data['password']=Hash::make($new_password);
            			return back()->with('change_password_status','Password update successfully');
            		}
            	}
            	else
            	{
            	    return back()->with('Warning','New & Confirm Password not match');
            	}
        	}
        	else
        	{
        	    return back()->with('Warning','Old Password not match');
        	}
        	
		return back()->with('Warning','Not update Password');
        }
        return redirect('/')->with('error', 'Oopps! You do not have access');
    }

    public function logout()
    {
        Auth::logout();
  
        return redirect('/')->with('error', 'You logout');
    
    }
    
    #---------------------------------------------------------------------------------------------------------
    public function forgot()
    {
        return view('admin.forgot');
    }
    
    public function forgetpassword( Request $request )
	{
		$rules = [

            'email'  =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>$validation->errors()->first() ]);

        }
		
		$password = "admin@".rand(1000,9999);
		$data['password']=Hash::make( $password );
		$user = User::where( 'email', $request->email )->where('role',1)->first();
		
		if($user){
		    $dataa = [
            'password' => $password
            ];
            $email = array('email' => $request->input('email'));
            
            Mail::send('admin/forgetmail', $dataa, function($message) use ($email){
            $message->to($email['email']);
            $message->from('dheeraj@8bittask.com','GYM');
            });
			if( User::where( 'email', $request->email )->update( $data )){
				
				return redirect('/')->with('error', 'Please check your email');
				
			}
			return redirect('/')->with('error', 'oops try again');
			
		}
		return redirect('/')->with('error', 'Wrong email Id');
		
		
	}
	
	public function settings()
    {
        return view('admin.settings');
    }
    
    public function updateSettings(Request $request) 
    {
	        if($request->hasfile('logo'))
	        {
	            $file=$request->file('logo');
	            $extension=$file->getClientOriginalExtension();
	            $filename=time().'.'.$extension;
	            $file->move('public/assets/img',$filename);
	            $data['logo']=$filename;
	        }
        	$data['shop_name'] = $request->shop_name;
        	$data['telephone_no'] = $request->telephone_no;
        	$data['email_id_print'] = $request->email_id_print;
        	$data['vat_license_no'] = $request->vat_license_no;
        	$data['address'] = $request->address;
            $data['print_type'] = $request->print_type;
        	
        	$data['shop_name_arabic'] = $request->shop_name_arabic;
        	$data['telephone_no_arabic'] = $request->telephone_no_arabic;
        	$data['email_id_print_arabic'] = $request->email_id_print_arabic;
        	$data['vat_license_no_arabic'] = $request->vat_license_no_arabic;
        	$data['tanno'] = $request->tanno;
        	$data['address_arabic'] = $request->address_arabic;
        	
        	$data['remark'] = $request->remark;
        	$data['remark_arabic'] = $request->remark_arabic;
        	$data['footer'] = $request->footer;
        	
        	if( User::where('id', Auth::user()->id)->update( $data ))
        	{
			return back()->with('status','Profile update successfully');
		}
		return back()->with('status','Not update profile');
    }
    #---------------------------------------------------------------------------------------------------------
    public function index()
    {
        $row=user::get();
        return view('admin.user.index',compact('row'));
    }
    public function create()
    {
        $page=['page_name'=>'user'];
        return view('admin.user.create',compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated =$request->validate([
            'email' => 'required|max:100',
            'password' => 'required',
        ]);
        if(!$validated){

            return back()->with('status',$validation->errors());

        }
        $add= new User;
        $add->name=$request->input('name');
        $add->email=$request->input('email');
        $add->password=Hash::make($request->input('password'));
        $add->role=2;
        
        
        $add->save();
    
        return back()->with('status','user create successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row=User::find($id);
        return view('admin.user.edit',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $add= new User;
        $add->name=$request->input('name');
        $add->email=$request->input('email');
        $add->password=Hash::make($request->input('password'));
        $add->role=2;
        $add->update();
        return redirect('admin/user')->with('delete','user update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users=User::findOrFail($id);
        $users->delete();
        return back()->with('delete','user Delete successfully');
    }
    
    

	
}
