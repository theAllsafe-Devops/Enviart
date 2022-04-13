<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvoiceOrderItemTable;
use App\Models\InvoiceOrderTable;
use Auth;
use Mail;
use DB;
class ReportController extends Controller
{
    public function index()
    {
       
        if($_GET)
        {
            $start_date=$_GET['start_date'];
            $end_date=$_GET['end_date'];
            // dd($start_date,$end_date);
            $row=InvoiceOrderTable::whereBetween('created_at',[$start_date, $end_date])->get();
        }else{
            $row=InvoiceOrderTable::where('user_id',Auth::user()->id)->get();
        }
        //  $email = array('email' => "dheerajkg8931@gmail.com");
        // $data = [
        // 'row' => $row,
        // 'password' => "dheerajkg8931@gmail.com"
        // ];
        // Mail::send('admin/mail',$data, function($message) use ($email){
        // $message->to("dheerajkg8931@gmail.com");
        // $message->from('dheeraj@bluebirdxb.com','Demo');
        // });
        
        return view('admin.vat_report',compact('row'));
    }
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $row=Product::where('status',1)->where('user_id',Auth::user()->id)->get();
        $tax=Tax::first();
        return view('admin.bill.create',compact('row','tax'));
    }

    public function report()
    {
       $row=InvoiceOrderTable::where('user_id',Auth::user()->id)->first();
        $data=DB::table('users')->first();
        if($data->print_type==1)
        {
            return view('admin.gstreport',compact('row'));
        }
        return view('admin.bill.invoice2',compact('row'));
    }
    
    public function gstreport()
    {
        $row=InvoiceOrderTable::where('user_id',Auth::user()->id)->first();
        return view('admin.gstreport',compact('row'));
    }

   
}
