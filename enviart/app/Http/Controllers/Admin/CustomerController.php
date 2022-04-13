<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $row=Customer::get();
        return view('admin.customer.index',compact('row'));
    }
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page=['page_name'=>'customer'];
        return view('admin.customer.create',compact('page'));
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
            'customer_name' => 'required|max:100',
            'customer_address' => 'required',
            'customer_mobileno' => 'required',
        ]);
        if(!$validated){

            return back()->with('status',$validation->errors());

        }
        $add= new Customer;
        // $add->user_id=Auth::user()->id;
        $add->customer_name=$request->input('customer_name');
        $add->customer_address=$request->input('customer_address');
        $add->customer_mobileno=$request->input('customer_mobileno');
        $add->customer_emailid=$request->input('customer_emailid');
        $add->customer_gstno=$request->input('customer_gstno');
        $add->customer_panno=$request->input('customer_panno');
        
        
        $add->save();
    
        return back()->with('status','Customer create successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row=Customer::find($id);
        return view('admin.customer.edit',compact('row'));
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
        $validated =$request->validate([
            'customer_name' => 'required|max:100',
            'customer_address' => 'required',
            'customer_mobileno' => 'required',
        ]);
        if(!$validated){

            return back()->with('status',$validation->errors());

        }
        $add= new Customer;
        // $add->user_id=Auth::user()->id;
        $add->customer_name=$request->input('customer_name');
        $add->customer_address=$request->input('customer_address');
        $add->customer_mobileno=$request->input('customer_mobileno');
        $add->customer_emailid=$request->input('customer_emailid');
        $add->customer_gstno=$request->input('customer_gstno');
        $add->customer_panno=$request->input('customer_panno');
        
        $add->update();
        return redirect('admin/customer')->with('delete','Customer update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer_name=Customer::findOrFail($id);
        $customer_name->delete();
        return back()->with('delete','Customer Delete successfully');
    }
    
}
