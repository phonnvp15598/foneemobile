<?php

namespace App\Http\Controllers;

use App\Product;
use Tymon\JWTAuth\Facades\JWTAuth;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTFactory;


class APIController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $input = $request->only('name', 'password');
        $token = JWTAuth::attempt($input);
        if ($token) {
            return response()->json([
                'user' => JWTAuth::user()->id,
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => JWTFactory::getTTL() * 60
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

       
    }
    public function me(){
        return response()->json([
            'user' => JWTAuth::user(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        // $this->validate($request, [
        //     'token' => 'required'
        // ]);
        $token = $request->header('access_token');
        if(JWTAuth::invalidate($token)){
            return response()->json([
                'user' => JWTAuth::user()->id,
                'status' => true,
                'message' => 'User logged out successfully'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
    public function refresh()
    {
        return response()->json([
            'user' => JWTAuth::user()->id,
            'refresh_token' => JWTAuth::refresh(),
            'token_type' => 'bearer',
            'expires_in' => JWTFactory::getTTL() * 60
        ]);
    }
    public function listProduct(){
        $products = Product::all();
        return response()->json($products);
    }
    public function searchData($data){  
        $dataProduct = Product::join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.product_name','like','%'.$data.'%')
        ->orWhere('tbl_brand.brand_name','like','%'.$data.'%')->get();
        return  response()->json($dataProduct);
    }
}