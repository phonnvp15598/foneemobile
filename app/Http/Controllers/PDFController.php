<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function exportOrderPDF($order_id){
        $order_detail= Order::join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
        ->join('tbl_order_detail','tbl_order_detail.order_id','=','tbl_order.order_id')->where('tbl_order_detail.order_id', $order_id)->select('tbl_order.*', 'tbl_customer.*','tbl_shipping.*','tbl_order_detail.*')
        ->get();
        $order_date = Order::where('order_id', $order_id)->first();
        $order_info = Order::join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
        ->join('tbl_payment','tbl_payment.payment_id','=','tbl_order.payment_id')
        ->where('tbl_order.order_id', $order_id)->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_payment.*')->first();
        $pdf = PDF::loadView('admin.order.orderpdf', compact('order_detail','order_info','order_date'));
        return $pdf->download('order'. $order_info->order_code .'.pdf');
    }
}
