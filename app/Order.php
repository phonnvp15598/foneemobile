<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $guarded = [];
    protected $fillable = ['customer_id','shipping_id','payment_id','order_total','order_status','order_code','created_at','day_handle','day_ship','updated_at'];
    protected $primaryKey = 'order_id';
    protected $table = 'tbl_order';
    public function Shipping(){
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }
    public function Customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function Payment(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }
    public function OrderStatus(){
        return $this->belongsTo(OrderStatus::class,'order_status');
    }
}
