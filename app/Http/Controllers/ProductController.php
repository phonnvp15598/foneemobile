<?php

namespace App\Http\Controllers;

use App\Brand;
use App\CategoryProduct;
use App\Color;
use App\Comment;
use App\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Requests\AddProductRequest;
use App\Memory;
use PhpParser\Node\Stmt\Foreach_;
use App\Product;
use App\ProductColor;
use App\ProductImage;
use App\ProductMemory;
use App\UploadImage\UploadImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    use UploadImage;
    private $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    public function index(Request $request){
        $all_product = Product::all();
        $brands = Brand::orderBy('brand_name','asc')->get();
        if($request->product_name){
            $all_product= Product::where('product_name','like','%'.$request->product_name.'%')->get();
        }    
        if($request->brand_id){
            $all_product= Product::where('brand_id', $request->brand_id)->get();
        }
        if($request->product_name && $request->brand_id){
            $all_product = Product::where('product_name','like','%'.$request->product_name.'%')->where('brand_id',$request->brand_id)->get();
        } 
        return view('admin.product.index', compact('all_product','brands'));
    }
    public function add(){
        $brand_product = Brand::orderBy('brand_name', 'asc')->get();
        $color = Color::orderby('color_id','asc')->get();
        $memory = Memory::orderby('memory_id','asc')->get();
        return view('admin.product.add', compact('brand_product','color','memory'));
    }
    public function save(AddProductRequest $request){
        // $data = array();
        // $data['product_name'] = $request->product_name;
        // $data['product_desc'] = $request->product_desc;
        // $data['product_price'] = $request->product_price;
        // $data['product_content'] = $request->product_content;
        // $data['product_status'] = $request->product_status;
        // $data['category_id'] = $request->category_id;
        // $data['brand_id'] = $request->brand_id;
        // $get_image = $request->file('product_image');
        // if($get_image){
        //     $get_name_image = $get_image->getClientOriginalName();
        //     $name_image = current(explode('.', $get_name_image));
        //     $new_image =  $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();
        //     $get_image->move('public/uploads/product', $new_image);
        //     $data['product_image'] = $new_image;
        //     DB::table('tbl_product')->insert($data);
        //     Session::put('message', 'Thêm sản phẩm thành công!');
        //     return Redirect::to('all-product');
        // }
        // $data['product_image'] = "";
        // DB::table('tbl_product')->insert($data);
        $dataProduct = [
            'product_name'=> $request->product_name,
            'product_desc'=> $request->product_desc,
            'product_price'=> $request->product_price,
            'product_content'=> $request->product_content,
            'product_status'=> $request->product_status,
            'product_available'=> $request->product_available,
            'brand_id'=> $request->brand_id,
            'product_slug' => Str::slug($request->product_name)

        ];
        $dataUploadImage = $this->uploadOne($request,'product_image');
        if(!empty($dataUploadImage)){
            $dataProduct['product_image'] = $dataUploadImage['file_name'];
        }else{
            $dataProduct['product_image'] = "";
        }
        $product = Product::create($dataProduct);
        //continue insert data to table product_iamges
        if($request->hasFile('image')){
            foreach($request->image as $fileItem){
                $dataImageDetail = $this->uploadMulti($fileItem);
                $product->images()->create([
                    'product_id' => $product->product_id,
                    'image' => $dataImageDetail['file_name'],
                ]);
            }
        }
        if($request->color_name){
            foreach($request->color_name as $key => $item){
                $product->productcolors()->create([
                    'product_id' => $product->product_id,
                    'color_id' => $item
                ]);
            }
                
        }
        if($request->memory_name){
            foreach($request->memory_name as $key => $item){
                $product->productmemories()->create([
                    'product_id' => $product->product_id,
                    'memory_id' => $item
                ]);
            }
        }
        return redirect()->route('admin.product.index')->with('message', 'Thêm sản phẩm thành công!');

    }
    public function activeProduct($product_id){
        Product::where('product_id', $product_id)->update(['product_status' => 1]);
        return redirect()->route('admin.product.index')->with('message', 'Kích hoạt sản phẩm thành công!');
    }
    public function unactiveProduct($product_id){
        Product::where('product_id', $product_id)->update(['product_status' => 0]);
        return redirect()->route('admin.product.index')->with('message', 'Hủy kích hoạt sản phẩm thành công!');
    }
    public function edit($product_id){     
        $brand_product = Brand::orderBy('brand_id', 'desc')->get();
        $color = Color::orderby('color_id','asc')->get();
        $memory = Memory::orderby('memory_id','asc')->get();
        $edit_product = Product::where('product_id',$product_id)->first();
        $product_color = ProductColor::where('product_id',$product_id)->get();
        $product_memory = ProductMemory::where('product_id',$product_id)->get();
        return view('admin.product.edit',compact('brand_product','edit_product','color','memory','product_color','product_memory'));
    }
    public function update(Request $request,  $product_id){
        // $data = array();
        // $data['product_name'] = $request->product_name;
        // $data['product_desc'] = $request->product_desc;
        // $data['product_content'] = $request->product_content;
        // $data['product_price'] = $request->product_price;
        // $data['product_status'] = $request->product_status;
        // $data['category_id'] = $request->category_id;
        // $data['brand_id'] = $request->brand_id;

        // $get_image = $request->file('product_image');
        // if($get_image){
        //     $get_name_image = $get_image->getClientOriginalName();//lấy tên ảnh (anh.jpg)
        //     $name_image = current(explode('.', $get_name_image)); // cắt tên ảnh (anh)
        //     $new_image =  $name_image.rand(0,999).'.'.$get_image->getClientOriginalExtension();//lấy tên ảnh+ random+ đuôi ảnh
        //     $get_image->move('public/uploads/product', $new_image);
        //     $data['product_image'] = $new_image;
        //     DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        //     Session::put('message', 'Đã cập nhật sản phẩm thành công!');
        //     return Redirect::to('all-product');
        // }
        // DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        $dataProduct = [
            'product_name'=> $request->product_name,
            'product_desc'=> $request->product_desc,
            'product_price'=> $request->product_price,
            'product_content'=> $request->product_content,
            'product_available'=> $request->product_available,
            'brand_id'=> $request->brand_id,
            'product_slug' => Str::slug($request->product_name)

        ];
        $dataUploadImage = $this->uploadOne($request,'product_image');
        if(!empty($dataUploadImage)){
            $dataProduct['product_image'] = $dataUploadImage['file_name'];
        }
        Product::find($product_id)->update($dataProduct);
        $product = Product::find($product_id);
        //continue insert data to table product_iamges
        if($request->hasFile('image')){
            ProductImage::where('product_id', $product_id)->delete();
            foreach($request->image as $fileItem){
                $dataImageDetail = $this->uploadMulti($fileItem);
                $product->images()->create([
                    'product_id' => $product->product_id,
                    'image' => $dataImageDetail['file_name'],
                ]);
            }
        }
        if($request->color_name){
            ProductColor::where('product_id',$product_id)->delete();
            foreach($request->color_name as $key => $item){
                $product->productcolors()->create([
                    'product_id' => $product->product_id,
                    'color_id' => $item
                ]);
            }
                
        }
        if($request->memory_name){
            ProductMemory::where('product_id', $product_id)->delete();
            foreach($request->memory_name as $key => $item){
                $product->productmemories()->create([
                    'product_id' => $product->product_id,
                    'memory_id' => $item
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('message', 'Cập nhật sản phẩm thành công!');
    }
    public function delete($product_id){
        Product::where('product_id', $product_id)->delete();
        return redirect()->route('admin.product.index')->with('message', 'Xóa sản phẩm thành công!');
    }
    public function deleteProductSelected(Request $request){
        $ids = $request->ids;
        if(isset($ids)){
            Product::whereIn('product_id', $ids)->delete();
            return redirect()->back()->with('message', 'Đã xóa những sản phẩm được chọn thành công!');
        }
        return redirect()->back()->with('danger', 'Bạn chưa chọn các mục để xóa!');
    }
    public function search(Request $request){
        $keyword = $request->keywords;
        if(isset($keyword)){
            $search_product = Product::join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.product_name','like','%'.$keyword.'%')
            ->orWhere('tbl_brand.brand_name','like','%'.$keyword.'%')->get();
            return view('admin.product.index',compact('keyword','search_product'));
        }else{
            return redirect()->back()->with('danger', 'Vui lòng nhập nội dung mà bạn muốn tìm kiếm!');
        }

    }
    //end admin
    public function showProductHome(Request $request){
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
        if($request->ajax()){
            $query = $request->query();
            $html = view('pages.product.productajax', compact('all_product','query'))->render();
            return response(['html' => $html]);
        }
        return view('pages.product.show_product',compact('brand_product','all_product','popular_product'));
    }

    public function detailProduct($product_slug){
        $popular_product = Product::where('product_status', 1)->get();
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        $details_product = Product::join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.product_slug', $product_slug)->get();
        foreach ($details_product as $key => $value) {
            $brand_id = $value->brand_id;
            $product_id = $value ->product_id;
        }
        $detail_image = Product::where('product_slug',$product_slug)->first();
        if(isset($brand_id)){
            $relative_product = Product::join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_brand.brand_id', $brand_id)
            ->whereNotIn('tbl_product.product_slug', [$product_slug])->get();
        }
        else{
            return view('pages.error.404');
        }

        $customer_id = Session::get('customer_id');
        $comment_id = Session::get('comment_id');
        // $comment_reply = CommentReply::where('comment_id',$comment_id)->first();
        
        $comment_count = Comment::where('product_id', $product_id)->get();
        $comment_rate = Comment::where('product_id', $product_id)->avg('comment_rate');

        $comments = Comment::where('product_id', $product_id)->orderBy('comment_id','desc')->paginate(5);
        $product_color = ProductColor::where('product_id',$product_id)->get();
        $product_memory = ProductMemory::where('product_id',$product_id)->get();
        return view('pages.product.show_details',compact('brand_product','details_product','relative_product','detail_image','customer_id','comments','comment_count','comment_rate','popular_product','product_color','product_memory'));
    }
}
