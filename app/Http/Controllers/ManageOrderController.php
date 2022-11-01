<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Exports\OrderExport;
use App\Mail\OrderCancel;
use App\Mail\ShoppingMail;
use App\OrderDetail;
use App\OrderStatus;
use App\Shipping;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

session_start();

class ManageOrderController extends Controller
{
    public function index(Request $request)  
    {
        // $orders = Order::whereRaw(1);
        
        $orders = Order::orderBy('order_id','desc')->paginate(5);
        if($request->order_code){
            $orders= Order::where('order_code','like', '%'.$request->order_code.'%')->paginate(5);
        }    
        if($request->order_status){
            $orders = Order::where('order_status',$request->order_status)->paginate(5);
        }
        if($request->order_code && $request->order_status){
            $orders= Order::where('order_code','like', '%'.$request->order_code.'%')->where('order_status', $request->order_status)->paginate(5);
        } 
        return view('admin.order.index', compact('orders'));
    }
    public function viewOrder($order_id){
        // $order_detail= Order::join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        // ->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
        // ->join('tbl_order_detail','tbl_order_detail.order_id','=','tbl_order.order_id')->where('tbl_order_detail.order_id', $order_id)->select('tbl_order.*', 'tbl_customer.*','tbl_shipping.*','tbl_order_detail.*')
        // ->get();
        $dataorderdetail = OrderDetail::where('order_id',$order_id)->get();
        $order_date = Order::where('order_id', $order_id)->first();
        $order_info = Order::join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
        ->join('tbl_payment','tbl_payment.payment_id','=','tbl_order.payment_id')
        ->where('tbl_order.order_id', $order_id)->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_payment.*')->first();
        $shipping_id = $order_info->shipping_id;
        $order_address = Shipping::where('shipping_id', $shipping_id)->first();
        $order_status = OrderStatus::orderBy('order_status','asc')->get();
       return view('admin.order.view',compact('dataorderdetail','order_info','order_date','order_address','order_status'));
    }
    public function updateStatus(Request $request ,$order_id){
        Order::where('order_id', $order_id)->update(['order_status' => $request->order_status]);
        Session::put('message','Đã cập nhật trạng thái đơn hàng ' .$order_id. ' thành công!');
        $dataorder = Order::find($order_id);
        $dataorderdetail = OrderDetail::where('order_id',$order_id)->get();
        $order_info = Order::join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
        ->join('tbl_payment','tbl_payment.payment_id','=','tbl_order.payment_id')
        ->where('tbl_order.order_id', $order_id)->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_payment.*')->first(); 
        if($request->order_status == 2){
            Order::where('order_id', $order_id)->update(['day_handle' => date_create() ]);
            Mail::to($order_info->shipping_email)->send(new ShoppingMail($dataorder,$dataorderdetail));
        }
        if($request->order_status == 3){
            Order::where('order_id', $order_id)->update(['day_ship' => date_create() ]);
        }
        if($request->order_status == 5){
            Mail::to($order_info->shipping_email)->send(new OrderCancel($dataorder,$dataorderdetail));
        }
        return redirect()->back();
    }
    public function deleteOrderSelected(Request $request){
        $ids = $request->ids;
        if(isset($ids)){
            Order::whereIn('order_id', $ids)->delete();
            return redirect()->back()->with('message', 'Đã xóa những hoá đơn được chọn thành công!');
        }
        return redirect()->back()->with('danger', 'Bạn chưa chọn các mục để xóa!');
    }
    public function exportOrder(){
        return Excel::download(new OrderExport,'order.xlsx');
    }
}
