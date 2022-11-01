<?php

namespace App\Http\Controllers;

use App\Brand;
use App\CategoryProduct;
use App\City;
use App\Customer;
use App\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Requests\CheckoutCustomerRequest;
use App\Order;
use App\OrderDetail;
use App\Payment;
use App\Shipping;
use Cart;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\ShoppingMail;
use App\Product;
use App\Ward;

session_start();

class CheckoutController extends Controller
{
    
    public function checkout(){
        $popular_product = Product::where('product_status', 1)->get();
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $cities = City::orderBy('city_name', 'asc')->get();
        // $customer_id = Session::get('customer_id');
        // $customer = Customer::find($customer_id);
        $cart = Session::get('cart');
        if($cart){
            return view('pages.checkout.checkout',compact('brand_product','cities','popular_product'));
        }else{
            return redirect()->back()->with('message','Giỏ hàng đang trống!');
        }
       
    }
    public function checkoutSuccess(){
        $popular_product = Product::where('product_status', 1)->get();
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        return view('pages.checkout.checkout_success',compact('brand_product','popular_product'));
    }
    // public function payment(){
    //     $cate_product = CategoryProduct::where('category_status','1')->orderBy('category_id', 'desc')->get();
    //     $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
    //     $cities = City::orderBy('city_name', 'asc')->get();
    //     return view('pages.checkout.payment',compact('cate_product','brand_product','cities'));
    // }
    public function selectCity(Request $request){
        $data = $request->all();
        $output='';
        if($data['action'] == "city"){
            $select_district = District::where('city_id',$data['id'])->orderBy('district_name','asc')->get();
            $output .= '<option>---Chọn Quận/Huyện----</option>';
            foreach($select_district as $district){
                $output .= '<option value="'.$district->district_id.'">' .$district->district_name.'</option>';
            }
        }else{
            $select_ward = Ward::where('district_id',$data['id'])->orderBy('ward_name','asc')->get();
            $output .= '<option>---Chọn Phường/Xã----</option>';
            foreach($select_ward as $ward){
                $output .= '<option value="'.$ward->ward_id.'">' .$ward->ward_name.'</option>';
            }
        }
        echo $output;
    }

    
    public function order(CheckoutCustomerRequest $request){
        $cart = Session::get('cart');
        if($cart==null){
            return redirect()->back()->with('message', 'giỏ hàng đang trống!');
        }else{
            $datainfo = array();
            $datainfo['shipping_name'] = $request->shipping_name;
            $datainfo['shipping_email'] = $request->shipping_email;
            $datainfo['shipping_address'] = $request->shipping_address;
            $datainfo['shipping_phone'] = $request->shipping_phone;
            $datainfo['shipping_note'] = $request->shipping_note;
            $datainfo['city_id'] = $request->city;
            $datainfo['district_id'] = $request->district;
            $datainfo['ward_id'] = $request->ward;

            $shipping_id = Shipping::insertGetId($datainfo); //lấy luôn dữ liệu có id
            $request->session()->put('shipping_id',$shipping_id);
            //insert payment
            $data = array();
            $data['payment_method'] = $request->payment_method;
            $data['payment_status'] = 'Đang chờ xử lý';
            $payment_id = Payment::insertGetId($data); //lấy luôn dữ liệu có id
            //insert order
            $odata = array();
            $odata['customer_id'] = Session::get('customer_id');
            $odata['shipping_id'] = Session::get('shipping_id');
            $odata['payment_id'] = $payment_id;
            $odata['order_total'] = $request->total;
            $odata['order_status'] = 1;
            $odata['order_code'] = date('YmdHis').rand(0,9);
            $odata['created_at'] = date("Y-m-d H:i:s");
            $order_id = Order::insertGetId($odata); //lấy luôn dữ liệu có id
            //insert orderdetail
            foreach($cart as $value){
                $detail = array();
                $detail['order_id'] = $order_id;
                $detail['product_id'] = $value['product_id'];
                $detail['product_name'] = $value['product_name'];
                $detail['product_color'] = $value['product_color'];
                $detail['product_memory'] = $value['product_memory'];
                $detail['product_price'] =$value['product_price'];
                $detail['product_sale_quantity'] = $value['product_qty'];
                $result = OrderDetail::insert($detail); //lấy luôn dữ liệu có id
            }
            // $dataorder = Order::find($order_id);
            // $dataorderdetail = OrderDetail::where('order_id',$order_id)->get();
            // Mail::to($request->shipping_email)->send(new ShoppingMail($dataorder,$dataorderdetail));
            $request->session()->forget('cart');
            return redirect()->route('pages.checkout.checkout_success')->with('message','Đặt hàng thành công !');
        }
       
    }
}
