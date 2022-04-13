<?php

namespace App\Http\Controllers\Admin;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\InvoiceOrderItemTable;
use App\Models\InvoiceOrderTable;
use App\Models\Tax;
use Auth;
use DB;
class BillController extends Controller
{
    public function index()
    {
        $row=InvoiceOrderTable::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('admin.bill.index',compact('row'));
    }
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $row=Product::where('status',1)->where('user_id',Auth::user()->id)->get();
        $tax=Tax::where('user_id',Auth::user()->id)->sum('precentage');
        $customer_name=Customer::get();
        $customer_gstno=Customer::get();
        $customer_address=Customer::get();
        return view('admin.bill.create',compact('row','tax','customer_name','customer_gstno','customer_address'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add= new InvoiceOrderTable;
        $add->user_id=Auth::user()->id;
        $add->customer_name=$request->input('customer_name');
        $add->customer_gstno=$request->input('customer_gstno');
        $add->customer_address=$request->input('customer_address');
        $add->order_total_before_tax=$request->input('subTotal');
        $add->order_total_tax=$request->input('taxRate');
        $add->order_total_tax1=$request->input('taxRate1');
        $add->order_tax_per=$request->input('taxAmount');
        $add->order_tax_per1=$request->input('ctaxAmount');
        $add->order_tax_per2=$request->input('staxAmount');
        $add->order_total_after_tax=$request->input('totalAftertax');
        $add->order_amount_paid=$request->input('amountPaid');
        $add->dAmount=$request->input('dAmount');
        $add->order_total_amount_due=$request->input('amountDue');
        $add->payment_type=$request->input('payment_type');
        $add->save();
        
        $item_id=$request->input('productName');
        $price=$request->input('price');
        $order_item_quantity=$request->input('quantity');
        $order_item_final_amount=$request->input('total');
        $len = count($item_id);
        
        for($i=0;$len>$i;$i++)
        {
            $add1= new InvoiceOrderItemTable;
            $add1->order_id=$add->id;
            $add1->item_id=$item_id[$i];
            $add1->price=$price[$i];
            $add1->order_item_quantity=$order_item_quantity[$i];
            $add1->order_item_final_amount=$order_item_final_amount[$i];
            $add1->save();
            // $stock=DB::table('tbl_stocks')->where(['product_name'=>$item_id[$i]])->where('stock_out','!=',null)->orderby('id','desc')->first(); 
            // if(!empty($stock))
            // {
            //     $update = DB::table('tbl_stocks')->where(['product_name'=>$item_id[$i]])->limit(1)->update( [ 'stock_out' => $order_item_quantity[$i]+$stock->stock_out]); 
            // }else{
            //     $update = DB::table('tbl_stocks')->where(['product_name'=>$item_id[$i]])->limit(1)->update( [ 'stock_out' => $order_item_quantity[$i]]); 
            // }

        }
        return redirect()->to('admin/invoice/'.$add->id);
        // return back()->with('status','Bill create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoice($id)
    {
        $tax=Tax::where('user_id',Auth::user()->id)->get();
        $row=InvoiceOrderTable::where('id',$id)->first();
        $data=DB::table('users')->where('id',Auth::user()->id)->first();
        if($data->print_type==1)
        {
            return view('admin.bill.invoice',compact('row','tax'));
        }
        return view('admin.bill.invoice2',compact('row','tax'));
    }
    
    public function bill($id)
    {
        $row=InvoiceOrderTable::where('id',$id)->first();
        return view('admin.bill',compact('row'));
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
        $users=InvoiceOrderTable::findOrFail($id);
        $users->delete();
        return back()->with('delete','Invoice Delete successfully');
    }
    
    public function status(Request $request)
    {
        $id=$request->input('id');
        $add= User::find($id);
        $add->login_status=$request->input('status');
        $add->update();
        echo 0;
    }
    public function getDesignation(Request $request)
    {
        $id=$request->input('id');
        $customer_gstno=Customer::where('id',$id)->get();
        // dd($student);
        echo "<option value=''>Select gst no.</option>";
       foreach($customer_gstno as  $val)
       {
        echo "<option value=".$val->id.">".$val->customer_gstno."</option>"; 
        }
    }
    public function getDesignation1(Request $request)
    {
        $id=$request->input('id');
        $val=Customer::where('id',$id)->first();
        $data['address']=$val->customer_address;   
        $data['customer_gstno']=$val->customer_gstno;   
        echo json_encode($data);
       
    }
}
