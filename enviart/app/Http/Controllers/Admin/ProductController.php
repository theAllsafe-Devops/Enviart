<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Mail;
use App\Models\CallRecord;
use Auth;
class ProductController extends Controller
{
    public function index()
    {
        $row=Product::where('user_id',Auth::user()->id)->get();
        return view('admin.product.index',compact('row'));
    }
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page=['page_name'=>'User'];
        return view('admin.product.create',compact('page'));
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
            'product_name' => 'required|max:200',
            'price' => 'required|max:30',
        ]);
        if(!$validated){

            return back()->with('status',$validation->errors());

        }
        $add= new Product;
        $add->user_id=Auth::user()->id;
        $add->product_name=$request->input('product_name');
        $add->price=$request->input('price');
        // if(session('type')==0)
        // {
        //     $add->price=\Helper::ArabicToEnglish($request->input('price'));
        //     // dd(\Helper::ArabicToEnglish($request->input('price')));
        //     $add->arbic_price=$request->input('price');
        // }
        // else{
        //     $add->price=$request->input('price');
        //     $add->arbic_price=\Helper::EnglishToArabic($request->input('price'));
        // }
        $add->save();
    
        return back()->with('status','Product create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getproduct()
    {
        $product_id=$_GET['product_id'];
        $users=Product::where('product_name',$product_id)->first();
        return json_encode($users);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row=Product::find($id);
        return view('admin.product.edit',compact('row'));
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
            'product_name' => 'required|max:200',
            'price' => 'required|max:30',
        ]);
        if(!$validated){

            return back()->with('status',$validation->errors());

        }
        $add= Product::find($id);
        $add->product_name=$request->input('product_name');
        $add->price=$request->input('price');
        // if(session('type')==0)
        // {
        //     $add->price=\Helper::ArabicToEnglish($request->input('price'));
        //     $add->arbic_price=$request->input('price');
        // }
        // else{
        //     $add->price=$request->input('price');
        //     $add->arbic_price=\Helper::EnglishToArabic($request->input('price'));
        // }
        $add->update();
        return redirect('admin/product')->with('delete','Product update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users=Product::findOrFail($id);
        $users->delete();
        return back()->with('delete','Product Delete successfully');
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
