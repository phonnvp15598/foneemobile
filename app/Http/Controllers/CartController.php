<?php

namespace App\Http\Controllers;

use App\Brand;
use App\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;


session_start();
class CartController extends Controller
{
    // public function save_cart(Request $request){
    //     $productId= $request->productid_hidden;
    //     $quantity = $request->qty;
    //     $product_info = DB::table('tbl_product')->where('tbl_product.product_id', $productId)->first();
    //     $data['id'] = $product_info->product_id;
    //     $data['qty'] = $quantity;
    //     $data['name'] = $product_info->product_name;
    //     $data['price'] = $product_info->product_price;
    //     $data['weight'] =  $product_info->product_price;
    //     $data['options']['image'] = $product_info->product_image;
    //     Cart::add($data);
    //     return Redirect::to('show-cart');
    //     // Cart::destroy();
    // }
    public function showCart(){
        // $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id', 'desc')->get();
        // $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();
        // return view('pages.cart.show_cart')->with('cate_product',$cate_product)->with('brand_product', $brand_product);
    }
    public function cart(){
        $popular_product = Product::where('product_status', 1)->get();
        $brand_product = Brand::where('brand_status', '1')->orderBy('brand_name', 'asc')->get();
        return view('pages.cart.show_cart_ajax', compact('brand_product','popular_product'));
    }
    public function deleteToCart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('show-cart');
    }
    public function updateCartQuantity(Request $request){
        $rowId= $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);
        return Redirect::to('show-cart');
    }

    //ajax
    public function addCartAjax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']
                 && $val['product_id_color']==$data['cart_product_id_color']
                 && $val['product_id_memory']==$data['cart_product_id_memory']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                'product_slug' => $data['cart_product_slug'],
                'product_color' => $data['cart_product_color'],
                'product_id_color'=> $data['cart_product_id_color'],
                'product_memory' => $data['cart_product_memory'],
                'product_id_memory'=> $data['cart_product_id_memory'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                'product_slug' => $data['cart_product_slug'],
                'product_color' => $data['cart_product_color'],
                'product_id_color'=> $data['cart_product_id_color'],
                'product_memory' => $data['cart_product_memory'],
                'product_id_memory'=> $data['cart_product_id_memory'],

            );
            Session::put('cart',$cart);
        }
        Session::save();
        $count = count(Session::get('cart'));
        return response()->json(['count' =>  $count ]);

    }
    public function deleteCart($session_id){
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $value){
                if($value['session_id']== $session_id){
                    unset($cart[$key]);// $key la vi tri cart[0.1.2...vv]
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'X??a s???n ph???m th??nh c??ng');
        }else{
            return redirect()->back()->with('message', 'X??a s???n ph???m th???t b???i');
        }
    }
    public function deleteCartAjax($session_id){
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $value){
                if($value['session_id']== $session_id){
                    unset($cart[$key]);// $key la vi tri cart[0.1.2...vv]         
                }
                Session::put('cart',$cart);         
            }
            Session::put('cartafter',$cart);
            $cart_after = Session::get('cartafter');
            $total = 0;
            $count = count($cart_after);
            foreach($cart_after as $value){
                $sub = $value['product_price']* $value['product_qty'];
                $total += $sub; 
            }
            // dd($total);
            return response()->json([
                'message' => 'X??a th??nh c??ng!',
                'total' => number_format($total, 0, '.','.') . ' ??',
                'count' =>  $count ,
                'code' => 200

            ]);
        }else{
            return response()->json([
                'message' => 'X??a th???t b???i!',
                'code' => 500

            ]);
        }
    }
    public function updateCart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            foreach($data['cart_qty'] as $key => $qty){ //key ??? ????y s??? l?? session_id
                foreach($cart as $session => $value){
                    if($value['session_id'] == $key){
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            $request->session()->put('cart', $cart);
            return redirect()->back()->with('message', 'C???p nh???t gi??? h??ng th??nh c??ng');
        }else{
            return redirect()->back()->with('message', 'C???p nh???t gi??? h??ng th???t b???i');
        }
    }
    public function updateCartProduct(Request $request){
        $session_id = $request->input('session_id');
        $quantity = $request->input('quantity');
        // dd($prod_id);
        $cart = Session::get('cart');
        if($cart == true){
            $total = 0;
            foreach($cart as $key => $value){
                
                if($value['session_id'] == $session_id){
                    $cart[$key]['product_qty'] = $quantity;       
                    // dd($money);
                    $money = $cart[$key]['product_price']* $quantity;        
                }
                $request->session()->put('cart', $cart);  
                $sub = $cart[$key]['product_price']* $cart[$key]['product_qty'];   
                $total += $sub;      
               
            }
            // dd($total);
            return response()->json(['status'=>'"'.$cart[$key]["product_name"].'" c???p nh???t th??nh c??ng!',
                                    'money' => number_format($money, 0, '.','.') . ' ??',
                                    'total' => number_format($total, 0, '.','.') . ' ??'
                                    ]);
        }   
    }
    public function deleteAllCart(){
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $value){
                    unset($cart[$key]);// $key la vi tri cart[0.1.2...vv]
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'X??a gi??? h??ng th??nh c??ng');
        }else{
            return redirect()->back()->with('message', 'X??a gi??? h??ng th???t b???i');
        }
    }
    public function deleteAllCartAjax(){
        $cart = Session::get('cart');
        if($cart==true){
            foreach($cart as $key => $value){
                    unset($cart[$key]);// $key la vi tri cart[0.1.2...vv]
            }
            Session::put('cart', $cart);
            return response()->json([
                'message' => 'X??a t???t c??? s???n ph???m trong gi??? h??ng th??nh c??ng!',
                'code' => 200

            ]);
        }else{
            return response()->json([
                'message' => 'X??a th???t b???i!',
                'code' => 500

            ]);
        }
    }
}
