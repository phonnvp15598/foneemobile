<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded = [];
    protected $fillable = ['product_id','image'];
    protected $primaryKey = 'id';
    protected $table = 'tbl_product_images';
}
