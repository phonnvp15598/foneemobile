<?php

namespace App\Http\Controllers;

use App\Brand;
use App\CategoryProduct;
use App\Customer;
use App\Http\Requests\RegisterCustomerRequest;
use App\Mail\OrderCancel;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::orderBy('customer_id', 'desc')->paginate(5);
        return view('admin.customer.index', compact('customers'));
    }
    public function delete($customer_id){
        Customer::where('customer_id', $customer_id)->delete();
        return redirect()->back()->with('message', 'Xóa khách hàng thành công !');
    }
    public function login(){
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $popular_product = Product::where('product_status', 1)->get();
        $customer_name = Session::get('customer_name');
        if($customer_name){
            return redirect()->back();
        }
        return view('pages.customer.login', compact('brand_product','popular_product'));
    }
    public function registerCustomer(RegisterCustomerRequest $request){
        // $check_email = Customer::where('customer_email', $request->customer_email)->first();
        // if(isset($check_email)){
        //      return redirect()->back()->with('message_error','Email này đã đăng ký!');
        // }
        $customer = new Customer();
        $customer->customer_name = $request->customer_name;
        $customer->customer_email = $request->customer_email;
        $customer->customer_password =md5($request->customer_password);
        $customer->customer_active = 1;
        $customer->save();

        if($customer->customer_id){
            $request->session()->put('customer_id', $customer->customer_id);
            $request->session()->put('customer_name',$customer->customer_name);
            $request->session()->put('customer_active',$customer->customer_active);
            $email = $customer->customer_email;
            $code = bcrypt(md5(time().$email));
            $customer->customer_code = $code;
            $customer->save();

            $url = route('customer.verify.account', ['customer_id' =>$customer->customer_id, 'customer_code' =>$code]);
            $data =[
                'route'=>$url
            ];
            Mail::send('mail.verify_customer', $data, function($message) use ($email){
                $message->to($email, 'Verify Password  by FoneeMobile')->subject('Xác nhận tài khoản tại FoneeMobile');
            });
            return redirect('/');
        }else{
            return redirect('/login');
        }

    }
    public function verifyCustomer(Request $request){
        $customer_id = $request->customer_id;
        $customer_code = $request->customer_code;
        $check_customer = Customer::where([
            'customer_id' => $customer_id,
            'customer_code' => $customer_code
        ])->first();
        if(!$check_customer){
            return redirect('/')->with('message_error', 'Xin lối! Đường dẫn xác nhận tài khoản không tồn tại!');
        }
        $check_customer->customer_active = 2;
        $check_customer->save();
        return redirect('/')->with('message', 'Tài khoản của bạn đã xác thực thành công!');
    }
    public function logout(){
        Session::flush();
        return redirect('/login');
 
     }
     public function postLogin(Request $request){
         $customer_email = $request->customer_email;
         $customer_password = md5($request->customer_password);
         $result = Customer::where('customer_email', $customer_email)->where('customer_password', $customer_password)->first();
 
         if($result){
             $request->session()->put('customer_id', $result->customer_id);
             $request->session()->put('customer_name', $result->customer_name);
             $request->session()->put('customer_active',$result->customer_active);
             return redirect('/');
         }else{
             return redirect()->back()->with('message_error', 'Tên đăng nhập hoặc mật khẩu sai');
         }
 
 
     }
     public function getFormReset(){
         $popular_product = Product::where('product_status', 1)->get();
         $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
         return view('pages.customer.reset',compact('brand_product','popular_product'));
     }
     public function sendEmailReset(Request $request){
         $email = $request->customer_email;
         $check_customer = Customer::where('customer_email', $email)->first();
         if(!$check_customer){
             return redirect()->back()->with('message_error','Email này chưa được đăng ký');
         }
         $code = bcrypt(md5(time().$email));
         $check_customer->customer_code = $code;
         $check_customer->save();
         $url = route('link.reset.password', ['customer_email' =>$email, 'customer_code' =>$code]);
         $data =[
             'route'=>$url
         ];
         Mail::send('mail.reset_password', $data, function($message) use ($email){
             $message->to($email, 'Lấy lại mật khẩu')->subject('Lấy lại mật khẩu by FoneeMobile');
         });
         return redirect()->back()->with('message','Link lấy lại mật khẩu đã được gửi vào email của bạn');
 
     }
     public function changePassword(Request $request){
        $popular_product = Product::where('product_status', 1)->get();
         $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
         $email = $request->customer_email;
         $code = $request->customer_code;
         $check_customer = Customer::where([
             'customer_email' =>$email,
             'customer_code' => $code
         ])->first();
         if(!$check_customer){
             return redirect('/')->with('message_error','Đường dẫn không đúng! Vui lòng thử lại sau.');
         }
         return view('pages.customer.change_password',compact('brand_product','popular_product'));
     }
     public function saveChangePassword(Request $request){
         if($request->customer_password != $request->customer_password_confirm){
             return redirect()->back()->with('message_error','Mật khẩu xác nhận không chính xác');
         }else{
             $email = $request->customer_email;
             $code = $request->customer_code;
             $check_customer = Customer::where([
                 'customer_email' =>$email,
                 'customer_code' => $code
             ])->first();
             if(!$check_customer){
                 return redirect()->back()->with('message_error','Đường dẫn không đúng! Vui lòng thử lại sau.');
             }
             $check_customer->customer_password = md5($request->customer_password);
             $check_customer->save();
             return redirect('/login')->with('message','Thay đổi mật khẩu thành công');
         }
     }
    public function history(){
        $popular_product = Product::where('product_status', 1)->get();
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $customer_id = Session::get('customer_id');
        $dataorder = Order::where('customer_id',$customer_id)->orderby('created_at', 'desc')->get();
        // $dataorderdetail = OrderDetail::where('customer_id',$customer_id)->get();
        if($customer_id){
            return view('pages.customer.history_checkout', compact('brand_product','dataorder','popular_product'));
        }else{
            return view('pages.error.404');
        }
        
    }
    public function historyDetail($order_id){
        $popular_product = Product::where('product_status', 1)->get();
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $dataorder = Order::where('order_id',$order_id)->first();
        $dataorderdetail = OrderDetail::where('order_id',$order_id)->get();
        $shipping_id = $dataorder->shipping_id;
        $order_address = Shipping::where('shipping_id', $shipping_id)->first();
        if(isset($dataorder)){
            return view('pages.customer.history_checkout_detail', compact('brand_product','dataorder','dataorderdetail','order_address','popular_product'));
        }
        return view('pages.error.404');
        
        
    }
    public function orderCancel($order_id){
        Order::where('order_id', $order_id)->update(['order_status'=> 5]);
        $dataorder = Order::find($order_id);
        $dataorderdetail = OrderDetail::where('order_id',$order_id)->get();
        $order_info = Order::join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')
        ->join('tbl_payment','tbl_payment.payment_id','=','tbl_order.payment_id')
        ->where('tbl_order.order_id', $order_id)->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_payment.*')->first(); 
        Mail::to($order_info->shipping_email)->send(new OrderCancel($dataorder,$dataorderdetail));
        return redirect()->back()->with('message', 'Đơn hàng #'. $order_info->order_code. 'đã được hủy bỏ vui lòng kiểm tra email!');
    }
}
