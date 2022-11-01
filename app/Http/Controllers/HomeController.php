<?php

namespace App\Http\Controllers;

use App\Brand;
use App\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Product;
use PhpParser\Node\Expr\AssignOp\Pow;

class HomeController extends Controller
{
    public function index(Request $request){
        $popular_product = Product::where('product_status', 1)->get();
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_name', 'ASC')->get();
        $all_product = Product::orderBy('product_id', 'DESC')->paginate(8);
        if($request->orderby){
            $orderby = $request->orderby;
            switch ($orderby) {
                case 'new':
                    $all_product = Product::orderBy('product_id', 'DESC')->paginate(8);
                    break;
                case 'old':
                    $all_product = Product::orderBy('product_id', 'ASC')->paginate(8);
                    break;
                case 'price-asc':
                    $all_product = Product::orderBy('product_price', 'ASC')->paginate(8);
                    break;
                case 'price-desc':
                    $all_product = Product::orderBy('product_price', 'DESC')->paginate(8);
                    break;
                case 'name-asc':
                    $all_product = Product::orderBy('product_name', 'ASC')->paginate(8);
                    break;
                case 'name-desc':
                    $all_product = Product::orderBy('product_name', 'DESC')->paginate(8);
                    break;    
                default:
                    $all_product = Product::orderBy('product_id', 'DESC')->paginate(8);
                    break;
            }
        }
        if($request->price){
            $price = $request->price;
            switch($price){
                case '1' :
                    $all_product = Product::where('product_price','<',1000000)->paginate(8);
                    break; 
                case '2' :
                    $all_product = Product::whereBetween('product_price',[1000000,3000000])->paginate(8);
                    break;
                case '3' :
                    $all_product = Product::whereBetween('product_price',[3000000,5000000])->paginate(8);
                    break;
                case '4' :
                    $all_product = Product::whereBetween('product_price',[5000000,10000000])->paginate(8);
                    break;
                case '5' :
                    $all_product = Product::whereBetween('product_price',[10000000,20000000])->paginate(8);
                    break;
                case '6' :
                    $all_product = Product::where('product_price','>',20000000)->paginate(8);
                    break;
                default : 
                    return view('pages.error.404');                                
            }
        }
        return view('pages.home',compact('brand_product','all_product','popular_product'));
    }
    public function search(Request $request){
        $popular_product = Product::where('product_status', 1)->get();
        $keyword = $request->tu_khoa;
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_name', 'ASC')->get();
        if($keyword != ""){
            $search_product = Product::join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.product_name','like','%'.$keyword.'%')
            ->orWhere('tbl_brand.brand_name','like','%'.$keyword.'%')->paginate(5);
            return view('pages.product.search',compact('brand_product','keyword','search_product','popular_product'));
        }else{
            return redirect('/')->with('message_error', 'Bạn chưa nhập nội dung tìm kiếm!');
        }
        
    }
    public function autocompleteAjax(Request $request){
        $data = $request->all();
        if($data['query']){
            $product = Product::where('product_name','LIKE','%' .$data['query'].'%')->get();
            if(count($product)== 0){
                return $output = '<ul class="dropdown-menu"><li>Không tìm thấy sản phẩm nào</li></ul>';
            }  
            else{
                $output = '<ul class="dropdown-menu" >';
                foreach($product  as $value){
                    $output .= '<li><a href="/foneemobile/product/'.$value->product_slug.'"><img width="50px" src="/foneemobile/public/uploads/product/'.$value->product_image.'"/>'.$value->product_name.'<p>'.number_format($value->product_price, 0, '.','.').' Đ'.'</p></a></li>';
                }
                $output .= '</ul>';
                return $output;
            }   
        }  
    }
}
