<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $fillable = ['product_name','brand_id','product_desc','product_content','product_price','product_image','product_status','product_available','product_slug'];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
    public function brand(){
        //quan he nhieu -1 (product vs brand)
        return $this->belongsTo(Brand::class, 'brand_id');
    }
   
    public function images(){
        //quan he 1- nhieu
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function colors(){
        return $this->belongsToMany(Color::class, 'product_colors','product_id','color_id');
    }
    public function productcolors(){
        //quan he 1- nhieu
        return $this->hasMany(ProductColor::class, 'product_id');
    }
    public function memories(){
        return $this->belongsToMany(Memory::class, 'product_memories','product_id','memory_id');
    }
    public function productmemories(){
        //quan he 1- nhieu
        return $this->hasMany(ProductMemory::class, 'product_id');
    }
    
    
}
