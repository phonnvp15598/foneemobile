<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $guarded = [];
    protected $fillable = ['shipping_name','shipping_email','shipping_phone','shipping_address','shipping_note','city_id','district_id','ward_id'];
    protected $primaryKey = 'shipping_id';
    protected $table = 'tbl_shipping';
    public function cities(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function districts(){
        return $this->belongsTo(District::class,'district_id');
    }
    public function wards(){
        return $this->belongsTo(Ward::class,'ward_id');
    }
}
