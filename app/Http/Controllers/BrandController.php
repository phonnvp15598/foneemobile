<?php

namespace App\Http\Controllers;

use App\Brand;
use App\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Requests\AddBrandRequest;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BrandController extends Controller
{


    public function index(){
        $all_brand = Brand::orderBy('brand_id', 'desc')->paginate(5);
        return view('admin.brand.index', compact('all_brand'));
    }
    public function add(){
        return view('admin.brand.add');
    }
    public function save(AddBrandRequest $request){
        Brand::create([
            'brand_name'=> $request->brand_name,
            'brand_desc' => $request->brand_desc,
            'brand_status' => $request->brand_status,
            'brand_slug' => Str::slug($request->brand_name)
        ]);

        return redirect()->route('admin.brand.index')->with('message', 'Thêm thương hiệu thành công!');

    }
    public function activeBrand($brand_id){
        Brand::where('brand_id', $brand_id)->update(['brand_status' => 1]);
        return redirect()->route('admin.brand.index')->with('message', 'Đã kích hoạt trình trạng thương hiệu thành HIỂN THỊ!');

    }
    public function unactiveBrand($brand_id){
        Brand::where('brand_id', $brand_id)->update(['brand_status' => 0]);
        return redirect()->route('admin.brand.index')->with('message', 'Đã kích hoạt trình trạng thương hiệu thành ẨN!');

    }
    public function edit($brand_id){
        $edit_brand = Brand::find($brand_id);
        return view('admin.brand.edit',compact('edit_brand'));
    }
    public function update(Request $request,  $brand_id){
        Brand::where('brand_id',$brand_id)->update([
            'brand_name'=> $request->brand_name,
            'brand_desc' => $request->brand_desc,
            'brand_slug' => Str::slug($request->brand_name)
        ]);
        return redirect()->route('admin.brand.index')->with('message', 'Cập nhật thương hiệu thành công!');

    }
    public function delete($brand_id){
        Brand::where('brand_id', $brand_id)->delete();
        return redirect()->route('admin.brand.index')->with('message', 'Xóa thương hiệu thành công!');

    }

    //page
    public function showBrandHome(Request $request, $brand_slug){
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_name', 'asc')->get();
        $popular_product = Product::where('product_status', 1)->get();
        $brand_name = Brand::where('brand_slug', $brand_slug)->get();
        if($request->orderby){
            $orderby = $request->orderby;
            switch ($orderby) {
                case 'new':
                    $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->orderBy('product_id', 'desc')->paginate(6);
                    break;
                case 'old':
                    $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->orderBy('product_id', 'asc')->paginate(6);
                    break;
                case 'price-asc':
                    $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->orderBy('product_price', 'asc')->paginate(6);
                    break;
                case 'price-desc':
                    $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->orderBy('product_price', 'desc')->paginate(6);
                    break;
                case 'name-asc':
                    $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->orderBy('product_name', 'asc')->paginate(6);
                    break;
                case 'name-desc':
                    $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->orderBy('product_name', 'desc')->paginate(6);
                    break;
                default:
                    $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->orderBy('product_id', 'desc')->paginate(6);
                    break;
            }
        }else{
            $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->orderBy('product_id', 'desc')->paginate(6);
        }
        if($request->price){
            $price= $request->price;
            switch($price){
                case '1' :
                    $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->where('product_price','<',1000000)->paginate(6);
                    break;
                case '2' :
                    $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->whereBetween('product_price',[1000000,3000000])->paginate(6);
                    break;
                case '3' :
                    $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->whereBetween('product_price',[3000000,5000000])->paginate(6);
                    break;
                case '4' :
                    $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->whereBetween('product_price',[5000000,10000000])->paginate(6);
                    break;
                case '5' :
                    $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->whereBetween('product_price',[10000000,20000000])->paginate(6);
                    break;
                case '6' :
                    $brand_by_id = Product::join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->where('product_price','>',20000000)->paginate(6);
                    break;
                default :
                    return view('pages.error.404');
            }
        }
        return view('pages.brand.show_brand',compact('brand_product','brand_by_id','brand_name','popular_product'));
    }
}
