<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tax;
use Auth;

class TaxController extends Controller
{
    public function index()
    {
        $row=Tax::where('user_id',Auth::user()->id)->get();
        return view('admin.tax.index',compact('row'));
    }
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page=['page_name'=>'User'];
        return view('admin.tax.create',compact('page'));
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
            'tax_name' => 'required|max:100',
            'precentage' => 'required',
        ]);
        if(!$validated){

            return back()->with('status',$validation->errors());

        }
        $add= new Tax;
        $add->user_id=Auth::user()->id;
        $add->tax_name=$request->input('tax_name');
        $add->precentage=$request->input('precentage');
        
        
        $add->save();
    
        return back()->with('status','Tax create successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row=Tax::find($id);
        return view('admin.tax.edit',compact('row'));
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
            'tax_name' => 'required|max:100',
            'precentage' => 'required',
        ]);
        if(!$validated){

            return back()->with('status',$validation->errors());

        }
        $add= Tax::find($id);
        $add->tax_name=$request->input('tax_name');
        $add->precentage=$request->input('precentage');
        $add->update();
        return redirect('admin/tax')->with('delete','Tax update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users=Tax::findOrFail($id);
        $users->delete();
        return back()->with('delete','Tax Delete successfully');
    }
    
    public function status(Request $request)
    {
        $id=$request->input('id');
        $add= User::find($id);
        $add->login_status=$request->input('status');
        $add->update();
        echo 0;
    }
}
