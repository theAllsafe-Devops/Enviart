<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use App\Models\CallRecord;
use Hash;
use Mail;
use Validator;

class AuthController extends Controller
{

	public function signin( Request $request ){
		
		$rules = [

            'mobile_no'          =>'required',

            'password'          =>'required'

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>$validation->errors()->first() ]);

        }
		
		$user = User::Where( 'mobile_no', $request->mobile_no )->first();
		if( $user && Hash::check( $request->password, $user->password ) ){
			$token = $user->createToken( env( 'ACCESS_TOKEN' ) )->accessToken;
			
			Cookie::queue('_token', $token, 10);
			
			return response( [ 'status'=>true, 'statuscode'=> 200, 'massage'=> 'Login successful', 'data'=>$user, '_access_token'=>$token ] );
			
		}
		
		return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>'Wrong mobile number and password combination' ]);
		
	}
	
	public function change_password( Request $request ){
		
		$rules = [
		
			'id'				=>'required',

            'old_password'      =>'required',

            'password'          =>'required',
			
			'confirm_password'  =>'required|same:password'

        ];
		
        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>$validation->errors() ] , 200 );

        }
		
		$data['password'] = Hash::make( $request->password );
		
		$user = User::where( 'id', $request->id )->first();
		
		if( Hash::check( $request->old_password, $user->password ) ){
		
			if( User::where( 'id', $request->id )->update( $data )){
				
				return response( [ 'status'=>true, 'statuscode'=> 200, 'massage'=>'Password updated successfully' ] , 200 );
				
			}
			return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>'Sorry try again' ] , 200 );
			
		}
		
		return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>'Wrong old password' ] , 200 );
		
	}
	
	public function profiledata($id){
	    
		$user = User::where( 'id', $id )->first();
		
		if($user){
		    
			return response( [ 'status'=>true, 'statuscode'=> 200, 'massage'=>'data found', 'data'=>$user ]);
			
		}
		
		return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>'id wrong' ]);
		
	}
	
	public function update_profile( Request $request ){
		
		$rules = [
		
			'id'			=>'required',

            'name'          =>'required',

            'email'         =>'required',
			
			'mobile_no'     =>'required'

        ];
		
        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>$validation->errors() ] , 200 );

        }
		
		$user = User::where( 'id', $request->id )->first();
		
		if($user){
		
		    $data['name'] = $request->name;
    		$data['email'] = $request->email;
    		$data['mobile_no'] = $request->mobile_no;
			if( User::where( 'id', $request->id )->update( $data )){
				
				return response( [ 'status'=>true, 'statuscode'=> 200, 'massage'=>'Profile updated successfully' ] , 200 );
				
			}
			return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>'Sorry try again' ] , 200 );
			
		}
		
		return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>'Wrong id' ] , 200 );
		
	}
	
	public function store_call_recording( Request $request ){
		
		$rules = [
		
			'id'			=>'required',

            'latitude'      =>'required',
            
            'longitude'      =>'required',

            'dial_number'   =>'required',
			
			'audio_file'    =>'required'

        ];
		
        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>$validation->errors() ] , 200 );

        }
        $data = [];
		$data['uid'] = $request->id;
	    $data['latitude'] = $request->latitude;
	    $data['longitude'] = $request->longitude;
		$data['dial_number'] = $request->dial_number;
		if($request->hasfile('audio_file'))
        {
            $file=$request->file('audio_file');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('admin_assets/audio',$filename);
            $data['audio_file']=url('')."/admin_assets/audio/".$filename;
        }
		if(CallRecord::create($data)){
			
			return response( [ 'status'=>true, 'statuscode'=> 200, 'massage'=>'Record store successfully' ] , 200 );
			
		}
			return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>'Record not store' ] , 200 );
		
	}
	
	
	public function logout(){

        $tokens = auth()->user()->tokens;

        $logout_status = false;

        foreach( $tokens as $token ){

            $token->delete();

            $logout_status = true;

        }

        if( $logout_status ){
        
            return response( [ 'status'=>true, 'statuscode'=>200, 'massage'=>'Logout successful' ], 200 );

        }
        else{

            return response( [ 'status'=>false, 'statuscode'=>200, 'massage'=>'Logout successful' ], 400 );

        }

    } 
	
	public function forget( Request $request )
	{
		
		$rules = [

            'email'  =>'required',

        ];

        $validation = Validator::make( $request->all(), $rules );

        if( $validation->fails() ){

            return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>$validation->errors()->first() ]);

        }
		
		$password = "gym".rand(1000,9999);
		$data['password']=Hash::make( $password );
		$user = User::where( 'email', $request->email )->first();
		
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
				
				return response( ['status'=>true, 'statuscode'=> 200, 'massage'=>'Please check your email' ]);
				
			}
			return response( [  'status'=>false, 'statuscode'=> 200, 'massage'=>'oops try again' ]);
			
		}
		return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>'Wrong email Id' ]);
		
		
	}
	
}
