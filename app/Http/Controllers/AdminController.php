<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Blog;
use App\Brand;
use App\CategoryProduct;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Requests\RegisterUserRequest;
use App\Order;
use App\Product;
use App\Role;
use App\SessionUser;
use App\UploadImage\UploadImage;
use App\User;
use Carbon\Carbon;
use App\Helpers\Date ;
use Illuminate\Support\Facades\Session ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Profiler\Profile;

session_start();
class AdminController extends Controller
{
    use UploadImage;
    // public function authLogin(){
    //     $admin_id = Auth::id();
    //     if($admin_id){
    //         return Redirect::to('dashboard');
    //     }
    //     else{
    //         return Redirect::to('admin-login')->send();
    //     }
    // }
    public function index(){
        if(Auth::id()){
            return redirect()->route('admin.blank');
        }
        return view('admin_login');
    }
    public function errorNotFound(){
        return view('admin.error.404');
    }
    public function showBlank(){
        return view('admin.dashboard.blank');
    }
    public function showProfile(){
        $profile = Auth::user();
        // dd($profile);
        return view('admin.user.profile', compact('profile'));
    }
    public function updateProfile(Request $request){
        $dataUser = [
            'name' => $request->name,
            'email' => $request->email
        ];
        $dataUserAvatar = $this->uploadOne($request,'avatar');
        if(!empty($dataUserAvatar)){
            $dataUser['avatar'] = $dataUserAvatar['file_name'];
        }
        User::find(Auth::id())->update($dataUser);
        return redirect()->back()->with('message', 'Chỉnh sửa thông tin cá nhân thành công!');
    }
    public function changePassword(Request $request){
        
        if($request->password != $request->password_comfirm){
            return redirect()->back()->with('danger','Mật khẩu xác nhận không trùng nhau!');
        }else{
            $dataPassword = [
                'password'=> bcrypt($request->password)
            ];
            User::find(Auth::id())->update($dataPassword);
            return redirect()->back()->with('message', 'Đổi mật khẩu thành công!');
        }

    }
    public function showDashboard(Request $request){
        // $this-> authLogin();
        $count_product = Product::all()->count();
        $count_brand = Brand::all()->count();
        $count_order = Order::all()->count();
        $count_blog = Blog::all()->count();
        $all_order = Order::where('order_status', 1)->orderBy('order_id','desc')->paginate(5);
        //doanh thu ngay
        $moneyDay = Order::whereDay('updated_at', date('d'))->whereMonth('updated_at', date('m'))->whereYear('updated_at', date('Y'))->where('order_status',4)->sum('order_total');
        //doanh thu tuan
        $moneyWeek = Order::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('order_status',4)->sum('order_total');
        //doanh thu thang
        $moneyMonth = Order::whereMonth('updated_at', date('m'))->whereYear('updated_at', date('Y'))->where('order_status',4)->sum('order_total');
        //doanh thu nam
        $moneyYear = Order::whereYear('updated_at', date('Y'))->where('order_status',4)->sum('order_total');
        $listArrDay = Date::getListDayInMonth(date('m'));
        $revenueDayOfMonth = Order::where('order_status',4)->whereMonth('updated_at', date('m'))->whereYear('updated_at', date('Y'))
        ->select(DB::raw('sum(order_total) as totalMoney'),DB::raw('DATE(updated_at) day'))->groupBy('day')->get()->toArray();
        $arrRevenueDayOfMonth = [];
        $revenueDayOfMonthDefault = Order::where('order_status',2)->whereMonth('updated_at', date('m'))->whereYear('updated_at', date('Y'))
        ->select(DB::raw('sum(order_total) as totalMoney'),DB::raw('DATE(updated_at) day'))->groupBy('day')->get()->toArray();
        $arrRevenueDayOfMonthDefault = [];
       
        $orderWait = Order::where('order_status',1)->select('order_id')->count();
        $orderProcess = Order::where('order_status',2)->select('order_id')->count(); 
        $orderShip = Order::where('order_status',3)->select('order_id')->count(); 
        $orderSuccess = Order::where('order_status',4)->select('order_id')->count(); 
        $orderCancel = Order::where('order_status',5)->select('order_id')->count(); 
        $statusOrder =[
            ['name' => 'Đang chờ tiếp nhận','y' =>$orderWait],
            ['name' => 'Đã tiếp nhận','y' =>$orderProcess],
            ['name' => 'Đang giao hàng','y' =>$orderShip],
            ['name' => 'Đã nhận hàng','y' =>$orderSuccess],
            ['name' => 'Đã hủy','y' =>$orderCancel]
        ];
        if($request->revenuebymonth){
            $listArrDay = Date::getListDayInMonth($request->revenuebymonth);
            $revenueDayOfMonth = Order::where('order_status',4)->whereMonth('updated_at', $request->revenuebymonth)->whereYear('updated_at', date('Y'))
            ->select(DB::raw('sum(order_total) as totalMoney'),DB::raw('DATE(updated_at) day'))->groupBy('day')->get()->toArray();
            $revenueDayOfMonthDefault = Order::where('order_status',2)->whereMonth('updated_at',  $request->revenuebymonth)->whereYear('updated_at', date('Y'))
            ->select(DB::raw('sum(order_total) as totalMoney'),DB::raw('DATE(updated_at) day'))->groupBy('day')->get()->toArray();
            $arrRevenueDayOfMonthDefault = [];
        }
        foreach($listArrDay as $day){
            $total = 0;
            foreach($revenueDayOfMonth as $key => $revenue){
                if($revenue['day'] == $day){
                    $total = $revenue['totalMoney'];
                    break;
                }
            }
            $arrRevenueDayOfMonth[] = (int)$total;
        } 
        foreach($listArrDay as $day){
            $total = 0;
            foreach($revenueDayOfMonthDefault as $key => $revenue){
                if($revenue['day'] == $day){
                    $total = $revenue['totalMoney'];
                    break;
                }
            }
            $arrRevenueDayOfMonthDefault[] = (int)$total;
        }
        $viewData = [
            'count_brand' => $count_brand,
            'count_product' => $count_product,
            'count_order' => $count_order,
            'count_blog' => $count_blog,
            'all_order' => $all_order,
            'moneyDay' => $moneyDay,
            'moneyWeek' => $moneyWeek,
            'moneyMonth' => $moneyMonth,
            'moneyYear' => $moneyYear,
            'listDay' => json_encode($listArrDay),
            'revenueDay' => json_encode($arrRevenueDayOfMonth),
            'revenueDayDefault' => json_encode($arrRevenueDayOfMonthDefault),
            'statusOrder' => json_encode($statusOrder)
            
        ];
        // dd(json_encode($statusOrder));
        // dd($revenueDay);
        return view('admin.dashboard.index', $viewData);
    }
    public function showRevenue(Request $request){
        $revenue = 0;
        $moneyDay = Order::whereDay('updated_at', date('d'))->whereMonth('updated_at', date('m'))->whereYear('updated_at', date('Y'))->where('order_status',4)->sum('order_total');
        $moneyWeek = Order::whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('order_status',4)->sum('order_total');
        $moneyMonth = Order::whereMonth('updated_at', date('m'))->whereYear('updated_at', date('Y'))->where('order_status',4)->sum('order_total');
        $moneyYear = Order::whereYear('updated_at', date('Y'))->where('order_status',4)->sum('order_total');
        if($request->revenue_day){
            $revenue =Order::whereDay('updated_at', $request->revenue_day)->where('order_status',4)->sum('order_total');
        }
        if($request->revenue_month){
            $revenue =Order::whereMonth('updated_at', $request->revenue_month)->where('order_status',4)->sum('order_total');
        }
        if($request->revenue_year){
            $revenue =Order::whereYear('updated_at', $request->revenue_year)->where('order_status',4)->sum('order_total');
        }
        if($request->revenue_day && $request->revenue_month){
            $revenue =Order::whereDay('updated_at', $request->revenue_day)->whereMonth('updated_at', $request->revenue_month)->where('order_status',4)->sum('order_total');
        }
        if($request->revenue_day && $request->revenue_year){
            $revenue =Order::whereDay('updated_at', $request->revenue_day)->whereYear('updated_at', $request->revenue_year)->where('order_status',4)->sum('order_total');
        }
        if($request->revenue_month && $request->revenue_year){
            $revenue =Order::whereMonth('updated_at', $request->revenue_month)->whereYear('updated_at', $request->revenue_year)->where('order_status',4)->sum('order_total');
        }
        if($request->revenue_day && $request->revenue_month && $request->revenue_year){
            $revenue =Order::whereDay('updated_at',$request->revenue_day)->whereMonth('updated_at', $request->revenue_month)->whereYear('updated_at', $request->revenue_year)->where('order_status',4)->sum('order_total');
        }
        return view('admin.dashboard.revenue',compact('revenue','moneyDay','moneyWeek','moneyMonth','moneyYear'));
        
    }
    // public function login(Request $request){
    //     $admin_email= $request->admin_email;
    //     $admin_password = md5($request->admin_password);

    //     $result = Admin::where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
    //     if($result){
    //         Session::put('admin_name', $result->admin_name);
    //         Session::put('admin_id', $result->admin_id);
    //         $request->session()->put('admin_phone', $result->admin_phone);
    //         return Redirect::to('/dashboard');
    //     }
    //     else{
    //         Session::put('message', 'Tài khoản hoặc mật khẩu sai!');
    //         return Redirect::to('/admin-login');
    //     }

    // }
    public function adminLogout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function adminRegister(){
        return view('admin_register');
    }
    public function postAdminRegister(RegisterUserRequest $request){
        $dataUser = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];
        $dataUserAvatar = $this->uploadOne($request,'avatar');
        if(!empty($dataUserAvatar)){
            $dataUser['avatar'] = $dataUserAvatar['file_name'];
        }else{
            $dataUser['avatar'] = "";
        }
        User::create($dataUser);
        return redirect()->back()->with('message', 'Đăng ký thành công!');
    }
    public function postAdminLogin(Request $request){

        if(Auth::attempt($request->only('name','password'))){
            return redirect()->route('admin.blank');
        }
        else{
            return redirect()->back()->with('message', 'Tài khoản hoặc mật khẩu không đúng!');
        }

        // if(Auth::guard('admins')->attempt($request->only('name', 'password'))){
        //     return redirect()->intended('/dashboard');
        // }
        // else{
        //     return redirect()->back()->with('message', 'Tài khoản hoặc mật khẩu không đúng!');
        // }
    }
    public function loginAPI(Request $request){
        $dataCheckLogin = [
            'name' => $request->name,
            'password' =>$request->password
        ];
        //b1: xac thuc user co tai khoan
        if(Auth::attempt($dataCheckLogin)){
            $checkTokenExist = SessionUser::where('user_id', Auth::id())->first();
            if(empty($checkTokenExist)){
                $sessionUser = SessionUser::create([
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'expire_token' => date('Y-m-d H:i:s', strtotime('+30 day')),
                    'refresh_expire_token' => date('Y-m-d H:i:s', strtotime('+360 day')),
                    'user_id' => auth()->id()
                ]);
            }else{
                $sessionUser = $checkTokenExist;
            }
            return response()->json([
                'code' => 200,
                'data' => $sessionUser
            ], 200);
            
        }else{
            return response()->json([
                'code' => 401,
                'message' => 'Username hoac passowrd khong chinh xac'
            ], 200);
        }
        
    }
    public function productAPI(Request $request){
        $token = $request->header('token');
        $checkTokenValidate = SessionUser::where('token', $token)->first();
        if(empty($token)){
            return response()->json([
                'code' =>401,
                'message' => 'Token khong duoc gui qua header'
            ], 401);
        }elseif(empty($checkTokenValidate)){
            return response()->json([
                'code' =>401,
                'message' => 'Token khong hop le'
            ], 401);
        }else{
            $product = Product::all();
            return response()->json([
                'code' =>200,
                'data' => $product
            ], 200);
        }
    }
    
    public function refreshTokenAPI(Request $request){
        $token = $request->header('token');
        $checkTokenValidate = SessionUser::where('token', $token)->first();
        if(!empty($checkTokenValidate)){
            if($checkTokenValidate->expire_token < time()){
                $checkTokenValidate->update([
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'expire_token' => date('Y-m-d H:i:s', strtotime('+30 day')),
                    'refresh_expire_token' => date('Y-m-d H:i:s', strtotime('+360 day')),
                    // 'user_id' => auth()->id()
                ]);
            }
        }
        $dataSession = SessionUser::find($checkTokenValidate->id);
        return response()->json([
            'code' =>200,
            'data' => $dataSession,
            'message' => 'refresh token thanh cong'
        ], 200);
    }

}
