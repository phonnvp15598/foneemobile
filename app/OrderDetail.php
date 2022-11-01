<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
   
    protected $guarded = [];
    protected $fillable = ['order_id','product_id','product_name','product_color','product_memory','product_price','product_sale_quantity'];
    protected $primaryKey = 'order_detail_id';
    protected $table = 'tbl_order_detail';
    public function Product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function Order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}
