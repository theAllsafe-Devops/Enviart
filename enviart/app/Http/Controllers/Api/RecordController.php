<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use App\Models\CallRecord;
use Hash;
use Mail;
use DB;
use Validator;

class RecordController extends Controller
{

	public function fatchnumber($id){
	    
		$user = CallRecord::where( 'uid', $id )->select('dial_number', DB::raw('count(*) as noOfcall'))->groupBy('dial_number')->get();
		
		if($user){
		    
			return response( [ 'status'=>true, 'statuscode'=> 200, 'massage'=>'data found', 'data'=>$user ]);
			
		}
		
		return response( [ 'status'=>false, 'statuscode'=> 200, 'massage'=>'id wrong' ]);
		
	}

	
}
